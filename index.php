<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CiviCRM member query tool</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        /* Rounded border */
        hr.rounded {
            border-top: 8px solid #bbb;
            border-radius: 5px;
        }
    </style>
</head>
    
 <?php   
     // define variables and set to empty values
    $surname = $email = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $surname = $_POST["surname"];
        $email = $_POST["email"];
    }
 ?> 
    
<body>
    <h1>CiviCRM member query tool</h1>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>Last Name<br><label>
        <input type="text" name="surname" value="<?php echo $surname;?>">
            
        <br><br>
            
        <label>Email<br><label>
        <input type="text" name="email" value="<?php echo $email;?>">
        
        <input type="submit" name="submit" value="Submit">  
    </form>
      
    <hr class="rounded">

 <?php 
    include 'secrets.php';

    function get_xml_from_url($url){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        $xmlstr = curl_exec($ch);
        curl_close($ch);

        return $xmlstr;
    }
            
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $url = 'https://' . SITE . '/wp-json/civicrm/v3/rest?entity=contact&action=get&key=' . SERVER_API_KEY . '&api_key=' . USER_API_KEY . '&last_name=' . $surname;
        $contents = get_xml_from_url($url);

        $contactxml = simplexml_load_string($contents);
        
        echo $contactxml;
        
        $contactID = 0;

        // TODO: Remove all trailing whitespace, ignore case (currently names will match with mismatched cases, but email won't). 
        // Also double check punctuation for names with hyphens and/or accents.
        foreach ($contactxml->children() as $contact) {          
            if ($contact->email == $email){
                // Match Found!
                echo  "<h2>" . $contact->display_name . "</h2>";                
                echo $contact->email . "<p>";
                
                $contactID = $contact->id;
                break;
            }
        }
            
        if ($contactID != 0){ 
            // Find memberships associated with contact and their expiry dates
               
            $url = 'https://' . SITE . '/wp-json/civicrm/v3/rest?entity=membership&action=get&key=' . SERVER_API_KEY . '&api_key=' . USER_API_KEY . '&contact_id=' . $contactID;
            $contents = get_xml_from_url($url);
            $membershipxml = simplexml_load_string($contents);
                
            // Allowing the possibility of showing multiple memberships
            foreach ($membershipxml->children() as $membership) {
                if ($membership->membership_type_id == 1) {
                    echo "<li>Regular $5 lifetime membership </li>";
                } else {
                    echo "<li>" . $membership->membership_name . " Membership, expires on " . $membership->end_date . "</li>";
                }
            }
        } else {
            echo "Error: No match found for " . $surname . " with email " . $email . "<p>";
        }
        
    }


 ?> 
</body>
</html>
