<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CiviCRM member query tool</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
<h1>CiviCRM member query tool</h1>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<form>
<div class="rendered-form">
    <div class="">
        <h1 access="false" id="control-8055192">Member Information<br></h1></div>
    <div class="formbuilder-text form-group field-text-1652631804163">
        <label for="text-1652631804163" class="formbuilder-text-label">Last name
            <br>
        </label>
        <input type="text" class="form-control" name="text-1652631804163" access="false" id="text-1652631804163">
    </div>
    <div class="formbuilder-text form-group field-text-1652631820544">
        <label for="text-1652631820544" class="formbuilder-text-label">Email address
            <br>
        </label>
        <input type="text" class="form-control" name="text-1652631820544" access="false" id="text-1652631820544">
    </div>
    <div class="formbuilder-button form-group field-button-1652631837931">
        <button type="button" class="btn-default btn" name="button-1652631837931" access="false" style="default" id="button-1652631837931">Validate</button>
    </div>
</div>
</form>

<ul>
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

$url = 'https://' . SITE . '/wp-json/civicrm/v3/rest?entity=contact&action=get&key=' . SERVER_API_KEY . '&api_key=' . USER_API_KEY . '&last_name=Lam';
$contents = get_xml_from_url($url);

$contactxml = simplexml_load_string($contents);

foreach ($contactxml->children() as $contact) {
    echo "<li>" . $contact->display_name . "</li>";
}
?>
</ul>
</body>
</html>
