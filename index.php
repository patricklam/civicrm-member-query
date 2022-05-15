<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CiviCRM member query tool</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
<h1>CiviCRM member query tool</h1>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label>Last Name<br><label>
      <input type="text" name="name" value="">
  <br><br>
  <label>Email<br><label>
      <input type="text" name="email" value="">
  <input type="submit" name="submit" value="Submit">  
</form>

 <?php 
          
     // define variables and set to empty values
    $surname = $email = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["surname"];
        $email = $_POST["email"];
    }
      
    echo '<p>Hello ' . $name . ' from ' . $email; 

 ?> 
</body>
</html>
