<?php 
	include_once("classes/user.class.php");

	
	if(!empty($_POST)){
		// username and password from $_POST
		$email = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars($_POST['password']);
		//echo $username; --> om te testen als deze stap werkt
		$user = new User();
		// check if user can login (functie)
		if($user->canILogin($email, $password)){
			//remember login(cookie)
            session_start(); //altijd boven html
            $_SESSION['email'] = $email;
			$_SESSION['loggedin'] = true;
			$_SESSION['userID'] = $user->fetchUserId($email);          
            header('Location: index.php');
		}else {
            // if no -> $error tonen
            $error = true;
        }
	}
	
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
   
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto+Mono" rel="stylesheet">
    <title> | Login</title>
</head>
<style>
    

</style>
<body>
	<div id="loginform">
		<div class="form">



		<form action="" method="post" >
			<h2 class="si">Sign In</h2>

			
    </div>

	 <div class="container">

			<div class="container1">
	
				
				<input type="text" id="Email" name="email">
			</div>
			<div class="container2">
				<label for="Password">Password</label>
				<input type="password" id="Password" name="password">
			</div>

			<div class="container3">
				<input type="submit" value="Sign in" class="btn">	
			</div>


		
		<a href="register.php" class="link">register ></a>

		

		</div>
		</form>
		</div>

		</div>


	
	</div>
</body>
</html>