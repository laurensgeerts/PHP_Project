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
<<<<<<< HEAD
<<<<<<< HEAD
            $user->setFirstname(htmlspecialchars( $_POST['firstname']));
            $user->setLastname(htmlspecialchars( $_POST['lastname']));
            $user->setEmail(htmlspecialchars( $_POST['email']));
            $user->setPassword(htmlspecialchars( $_POST['password']));
            $user->register();
            session_start();
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['loggedin'] = true;
            $_SESSION["user_id"] = $user->getUserId($email); 
                header('Location: index.php');
            }catch (Exception $e){
               echo "werkt niet";
=======
=======
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
            $user->setEmail($_POST['email']);
            $user->setFirstname($_POST['firstname']);
            $user->setLastname($_POST['lastname']);
            $user->setPassword($_POST['password']);
            if($user->register()){
                $user->login();
<<<<<<< HEAD
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
=======
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
            }
            }
        }catch(Exception $e){
               
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDFlix</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div>
    <div>
        <form action="" method="post">
            <h2 form__title>Sign up for an account</h2>

            <?php  if (isset($error)):?>
            <div class="form__error">
                <p>
                    🎣
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
            
<<<<<<< HEAD
<<<<<<< HEAD
            <form action="" method="post">
                <div class="form__field">
                    <label for="firstname">voornaam:</label>
                    <input type="text" id="firstname" name="firstname" <?php if (isset($user)):?> value="<?php echo $user->getFirstname()()?>" <?php endif;?>>
                    <label for="lastname">achternaam:</label>
                    <input type="text" id="lastname" name="lastname" <?php if (isset($user)):?> value="<?php echo $user->getLastname()()?>" <?php endif;?>>
                    </div>
                <div class="form__field">
                    <label for="email">email:</label>
                    <input type="text" id="email" name="email" <?php if (isset($user)):?> value="<?php echo $user->getEmail()?>" <?php endif;?>>
                </div>
                <div class="form__field">
                    <label for="password">wachtwoord:</label>
                    <input type="password" id="password" name="password">
                </div>
                <div class="form__field">
                    <label for="password_confirmation">bevestig je wachtwoord:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                </div>
                <div class="form__field">
                    <input type="submit" value="Sign me up!" class="btn btn--primary">
                </div>
            </form>
            <a href="login.php">heb je al een account? login hier!</a>
        </div>
=======
=======
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
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
<<<<<<< HEAD
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
=======
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
</body>
</html>