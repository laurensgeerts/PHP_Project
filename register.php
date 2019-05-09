<?php
session_start();
include_once 'classes/user.class.php';

    if (!empty($_POST)) {
        if ($_POST['password'] == $_POST['password_confirmation']) {
            try {
                $user = new User();
                $user->setFirstname(htmlspecialchars($_POST['firstname']));
                $user->setLastname(htmlspecialchars($_POST['lastname']));
                $user->setEmail(htmlspecialchars($_POST['email']));
                $user->setPassword(htmlspecialchars($_POST['password']));
                $user->register();

                $_SESSION['email'] = $user->getEmail();
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user->getUserId($email);
                /*  header('Location: index.php');*/
                echo 'gelukt';
            } catch (Exception $e) {
                echo "<script type='text/javascript'>alert('registration failed');</script>";
                /*header('Location: register.php');     */
            }
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>registration</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
                <?php
                    if (isset($_SESSION['error'])) {
                        $error = $_SESSION['error'];
                        echo "<span>$error</span>";
                    }
                ?>
        <div id="registerform">
            
            <form action="" method="post">
                <div class="form__field">
                    <label for="firstname">voornaam:</label>
                    <input type="text" id="firstname" name="firstname" <?php if (isset($user)):?> value="<?php echo $user->getFirstname()(); ?>" <?php endif; ?>>
                    <label for="lastname">achternaam:</label>
                    <input type="text" id="lastname" name="lastname" <?php if (isset($user)):?> value="<?php echo $user->getLastname()(); ?>" <?php endif; ?>>
                    </div>
                <div class="form__field">
                    <label for="email">email:</label>
                    <input type="text" id="email" name="email" <?php if (isset($user)):?> value="<?php echo $user->getEmail(); ?>" <?php endif; ?>>
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
</body>
</html>

<?php
    unset($_SESSION['error']);
?>