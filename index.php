<?php

session_start();

if( $_SESSION['loggedin'] == false){
  header('Location: login.php');
};

include_once("classes/user.class.php");
$user = new User();
$user->setUser_id($_SESSION["user_id"]);


$profile = $user->getUserInfo();




	
    
		



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