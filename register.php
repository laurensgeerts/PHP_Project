<?php

    include_once("classes/user.class.php");
    include_once("helpers/security.class.php");

    if ( !empty($_POST) ){
        try{
            $security = new Security();
            $security->password = $_POST['password'];
            $security->passwordConfirmation = $_POST['password_confirmation'];

            if($security->passwordsAreSecure()){  
            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setFirstname($_POST['firstname']);
            $user->setLastname($_POST['lastname']);
            $user->setPassword($_POST['password']);
            if($user->register()){
                $user->login();
            }
            }
        }catch(Exception $e){
               
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Social - Register</title>
</head>
<body>
<h1>Register</h1>
<div>
    <div>
        <form action="" method="post">
            <h2 form__title>Sign up here</h2>

            <?php  if (isset($error)):?>
            <div class="form__error">
                <p>
                    Sign up failed
                </p>
            </div>
            <?php endif; ?>

            <div class="form__field">
                <label for="email">Email</label>
                <input type="text" id="email" name="email">

            <div class="form__field">
            <label for="firstname">First name</label>
            <input type="text" id="firstname" name="firstname">
            </div>

            <div class="form__field">
            <label for="lastname">Last name</label>
            <input type="text" id="lastname" name="lastname">
            </div>
            
            </div>
            <div class="form__field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>

            <div class="form__field">
                <label for="password_confirmation">Confirm your password</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="form__field">
                <input type="submit" value="Sign me up!" class="btn btn--primary">
            </div>
        </form>
    </div>
</div>
</body>
</html>