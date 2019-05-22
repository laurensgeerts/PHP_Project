<?php

include_once 'bootstrap.php';


$user = new User();
$user_id = $_SESSION['user_id']; 
$profile = $user->getUserInfo($user_id);

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
    $user_edit->setFirstnamehtmlspecialchars(($_POST['firstname']));
    $user_edit->setLastname(htmlspecialchars($_POST['lastname']));
    if ($profile['email'] == $_POST['email']) {
        $user_edit->setEmail(htmlspecialchars($_POST['email']));
    } elseif ($user_edit->emailExists($_POST['email'])) {
        $user_edit->setEmail(htmlspecialchars($profile['email']));
    } else {
        $user_edit->setEmail(htmlspecialchars($_POST['email']));
    }
    $user_edit->setBio(htmlspecialchars($_POST['bio']));
    $user_edit->setImage($destination);
    if ($user_edit->update()) {
        $message = "Je profiel is geupdated.✅";

    } else {
        $error = "Er is iets fout gegaan probeer opnieuw.";
    }
}

if (!empty($_POST['passwordedit']) && !empty($_POST['password']) && !empty($_POST['repassword'])) {
    if (strcmp($_POST['password'], $_POST['repassword']) == 0) {
        $user_pass = new User();
        $user_pass->setUser_id($_SESSION['user_id']);
        $user_pass->setPassword($_POST['password']);
        if ($user_pass->updatePassword()) {
            $error = 'Wachtwoord geupdated.🔐';
        }
    } else {
        $error= 'Wachtwoord moet hetzelfde zijn.🔓 ';
    }
} else {
    $error = 'Je hebt nog niets ingvuld. ❌';
}

$profile = $user->getUserInfo($user_id);

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
<body class="whiteBody">
    
            <?php include_once 'nav.inc.php'; ?>
       


    <div class="uploadWindowProfile" >

    <div class="forceMiddle">
    <div class="grid-containerJ">


    <h1>PAS MIJN PROFIEL AAN</h1>
    <br>
    <br>
    <?php if(isset($error)): ?>
        <div ><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if(isset($message)): ?>
        <div><?php echo $message; ?></div>
        <?php endif; ?>

    <form method="post" action="" enctype="multipart/form-data" class="">
       
        <br>

        <p>Kies hier je profielfoto of verander hem:</p>
        <br>
        <img src="<?php echo $profile['picture'] ?>" alt="profiel" style="width:100px;">
        <br>
        <input type="file" name="profileImg"accept="image/gif, image/jpeg, image/png, image/jpg">

        <p>Verander hier je voornaam:</p>
        <input type="text" name="firstname"  value="<?php echo $profile['firstname']; ?>">

        <p>Verander hier je achternaam:</p>
        <input type="text" name="lastname"  value="<?php echo $profile['lastname'];?>" > 

        <p>Beschrijf jezelf kort in deze biografie of pas je biografie aan:</p>
        <textarea rows="3" cols="40" name="bio" ><?php echo $profile['bio'];?></textarea>

         <p>Verander hier je email:</p>
        <input type="email" name="email"   value="<?php echo $profile['email']; ?>">

        <input type="submit" name="edit" value="Veranderen">

         
   

        
    </form>

    </div>
        </div>


   
        <div class="forceMiddle">
    <div class="grid-containerJ">
<form method="post" action="" class="edit_profile">
    <h2>Wachtwoord aanpassen:</h2>
    <br>
    <p>Geef hier je nieuwe wachtwoord in:</p>
    <input type="password" name="password" placeholder="Geef hier je nieuwe wachtwoord in. ">

    <p>Bevestig hier je wachtwoord:</p>
    <input type="password" name="repassword"  placeholder="Hertyp dit wachtwoord. ">

        <input type="submit" name="passwordedit" value="Veranderen">
    </form>

</div>
</body>
</html>