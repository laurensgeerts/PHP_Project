<?php

session_start();

if( $_SESSION['loggedin'] == false){
  header('Location: login.php');
};



	
    
		



?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>index</title>
</head>
<body>
<?php include_once("nav.inc.php"); ?>

</body>
</html>