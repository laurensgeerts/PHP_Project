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
        }
    }
?><!DOCTYPE html>
<html lang="en">
<head>
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
		</div>
	</div>
</body>
</html>