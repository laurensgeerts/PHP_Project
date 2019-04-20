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
		</div>

		</div>


	
	</div>
</body>
</html>