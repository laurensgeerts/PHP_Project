<<<<<<< HEAD
<?php 
	include_once("classes/user.class.php");



	
	if(!empty($_POST)){
		
		$email = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars($_POST['password']);
	
		$user = new User();
	
		if($user->canILogin($email, $password)){
		
            session_start(); 
			$_SESSION['email'] = $email;
			$_SESSION['loggedin'] = true;
			$_SESSION["user_id"] = $user->getUserId($email);  
			
			
			
		
			
			
			
			    
            header('Location: index.php');
		}else {
           
		   
		  echo "het werkt niet";
=======
<?php
    include ('functions.inc.php');

    if ( !empty($_POST) ){
        // get username and PASSWORD from $_POST
        $username = $_POST['email'];
        $password = $_POST['password'];
        // check if a user can login (function)
        if (canILogin($username, $password) /*!= false */){
            // remember login (cookie)

            /* $salt = "zlkvboerbpùregmogma'e'";
            $cookieVal = $username . "," . md5($username.$salt);
            setcookie("login", $cookieVal, time() + 60*60*24*7 ); //1 week */

            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;

            // if yes --> index.php
            /* ZEER BELANGRIJK */
            header('Location: index.php');

        } else {
            // if no --> $error tonen
            $error = true;
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
        }
    }
?><!DOCTYPE html>
<html lang="en">
<head>
<<<<<<< HEAD
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
   

    <title>login </title>
</head>

<body>


	<div id="loginform">
		<div class="form">



		<form action="" method="post" >
			<h2>login </h2>

			
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


		
		<a href="register.php" class="link">geen account? registreer hier!</a>

		

		</div>
		</form>
=======
  <meta charset="UTF-8">
  <title>Social</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="socialLogin">
		<div class="form form--login">
			<form action="" method="post">
				<h2 form__title>Sign In</h2>

                <?php if (isset($error) ): ?>
				<div class="form__error">
					<p>
						Sorry, we can't log you in with that email address and password. Can you try again?
					</p>
				</div>
                <?php endif; ?>

				<div class="form__field">
					<label for="email">Email</label>
					<input type="text" id="email" name="email">
				</div>
				<div class="form__field">
					<label for="password">Password</label>
					<input type="password" id="password" name="password">
				</div>

				<div class="form__field">
					<input type="submit" value="Sign in" class="btn btn--primary">
					<input type="checkbox" id="rememberMe"><label for="rememberMe" class="label__inline">Remember me</label>
				</div>
			</form>
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
		</div>
	</div>
</body>
</html>