<?php
include_once 'classes/user.class.php';

session_start();
include_once 'classes/user.class.php';
$user = new User();
$user->setUser_id($_SESSION['user_id']);

$profile = $user->getInfo();

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
        $message = 'Your profile is updated.';
    } else {
        $error = "Something went wrong, profile isn't updated.";
    }
}

if (!empty($_POST['passwordedit']) && !empty($_POST['password']) && !empty($_POST['repassword'])) {
        $user_pass = new User();
        }
    } else {
    }
} else {
}

$profile = $user->getInfo();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>






    <form method="post" action="" enctype="multipart/form-data" class="edit_profile">
    <h2>Edit profile</h2>
    <label for="profileImg">Mijn profielfoto</label>
    <input type="file" name="profileImg" id="profileImg" accept="image/gif, image/jpeg, image/png, image/jpg">
     <br>
    <label for="firstname">firstname</label>
    <input type="text" name="firstname" id="firstname" value="<?php echo $profile['firstname']; ?>">
    <br>
    <label for="lastname">lastname</label>
    <br>
    <label for="bio">Bio</label>
  <br>
    <label for="email">E-mail</label>
    <input type="email" name="email" id="email" value="<?php echo $profile['email']; ?>">

    <input type="submit" name="edit" value="Edit">
</form>

<form method="post" action="" class="edit_profile">
    <h2>Wachtwoord aanpassen</h2>
    <label for="password">New password</label>
    <input type="password" name="password" id="password" placeholder="New password">

     <label for="repassword">Retype New password</label>
    <input type="password" name="repassword" id="repassword" placeholder="Retype New password">

    <input type="submit" name="passwordedit" value="Edit">
</form>
</body>
</html>