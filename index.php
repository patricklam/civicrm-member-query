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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo '<p>Hello ' . $surname . ' from ' . $email; 
    }

 ?> 
</body>
</html>
