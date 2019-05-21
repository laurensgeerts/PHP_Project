<?php
include_once 'classes/user.class.php';

session_start();
include_once 'classes/user.class.php';
$user = new User();
$user->setUser_id($_SESSION['user_id']);

$profile = $user->getUserInfo();

if (!empty($_POST['edit'])) {
    if (!empty($_FILES['profileImg']['name'])) {
        $saveImage = new User();
        $nameWithoutSpace = preg_replace('/\s+/', '', $_FILES['profileImg']['name']);
        $nameWithoutSpaceTMP = preg_replace('/\s+/', '', $_FILES['profileImg']['tmp_name']);
        $nameWithoutSpaceSize = preg_replace('/\s+/', '', $_FILES['profileImg']['size']);
        $saveImage->SetImageName($nameWithoutSpace);
        $saveImage->SetImageSize($nameWithoutSpaceSize);
        $saveImage->SetImageTmpName($nameWithoutSpaceTMP);
        $destination = $saveImage->SaveProfileImg();
    } else {
        $destination = $profile['image'];
    }

    $user_edit = new User();
    $user_edit->setUser_id($_SESSION['user_id']);
    $user_edit->setFirstname($_POST['firstname']);
    $user_edit->setLastname($_POST['lastname']);
    if ($profile['email'] == $_POST['email']) {
        $user_edit->setEmail($_POST['email']);
    } elseif ($user_edit->emailExists($_POST['email'])) {
        $user_edit->setEmail($profile['email']);
    } else {
        $user_edit->setEmail($_POST['email']);
    }
    $user_edit->setBio($_POST['bio']);
    $user_edit->setImage($destination);
    if ($user_edit->update()) {
        $message = "jouw profiel is geupdate!";

    } else {
        $error = "Er is iets fout gegaan probeer opnieuw";
    }
}

if (!empty($_POST['passwordedit']) && !empty($_POST['password']) && !empty($_POST['repassword'])) {
    if (strcmp($_POST['password'], $_POST['repassword']) == 0) {
        $user_pass = new User();
        $user_pass->setUser_id($_SESSION['user_id']);
        $user_pass->setPassword($_POST['password']);
        if ($user_pass->updatePassword()) {
            $message_pass = 'Password geupdated';
        }
    } else {
        $error_pass = 'password moet hetzelfde zijn';
    }
} else {
    $error = '‼️ je hebt nog niets ingvuld ‼️ ';
}

$profile = $user->getUserInfo();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="screen" href="css/reset.css">
  <link rel="stylesheet" media="screen" href="css/style.css">
  <link rel="stylesheet" media="screen" href="css/CSSgram.css">
  <title>Inspiration Hunter</title>
</head>
<body>
    
            <?php include_once 'nav.inc.php'; ?>
       


    <div class="uploadWindowProfile" >

    <div class="forceMiddle">
    <div class="grid-containerJ">

    <?php if(isset($error)): ?>
        <div class="message"><?php echo $error; ?></div>
        <?php endif; ?>

    <form method="post" action="" enctype="multipart/form-data" class="">
        <h1>PAS MIJN PROFIEL AAN</h1>
        <br>

        <p>Kies hier je profielfoto of verander hem:</p>
        <br>
        <img src="<?php echo $profile['picture'] ?>" alt="profiel" style="width:100px;">
        <input type="file" name="profileImg" id="profileImg" accept="image/gif, image/jpeg, image/png, image/jpg">

        <p>Verander hier je voornaam:</p>
        <input type="text" name="firstname" id="firstname" value="<?php echo $profile['firstname']; ?>">

        <p>Verander hier je achternaam:</p>
        <input type="text" name="lastname" id="lastname" value="<?php echo $profile['lastname'];?>" > 

        <p>Beschrijf jezelf kort in deze biografie of pas je biografie aan:</p>
        <textarea rows="4" cols="50" name="bio" id="bio"><?php echo $profile['bio'];?></textarea>

         <p>Verander hier je email:</p>
        <input type="email" name="email" id="email"  value="<?php echo $profile['email']; ?>">

        <input type="submit" name="edit" value="Edit">

         
    <?php if(isset($message)): ?>
        <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        

        
    </form>

    </div>
        </div>


   
    <?php if(isset($error_pass)): ?>
        <div class="message"><?php echo $error_pass; ?></div>
        <?php endif; ?>
        <div class="forceMiddle">
    <div class="grid-container">
<form method="post" action="" class="edit_profile">
    <h2>Wachtwoord aanpassen:</h2>
    <br>
    <p>Geef hier je nieuwe wachtwoord in:</p>
    <input type="password" name="password" id="password" placeholder="New password">

    <p>Bevestig hier je wachtwoord:</p>
    <input type="password" name="repassword" id="repassword" placeholder="Retype New password">

        <input type="submit" name="passwordedit" value="Edit">
    </form>

    <?php if(isset($message_pass)): ?>
        <div class="message"><?php echo $message_pass; ?></div>
        <?php endif; ?>
        </div>
        </div>
</div>
</body>
</html>