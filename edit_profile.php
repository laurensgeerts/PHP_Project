
session_start();
$user = new User();

$profile = $user->getInfo();

        $saveImage = new User();
        $saveImage->SetImageName($nameWithoutSpace);
        $saveImage->SetImageSize($nameWithoutSpaceSize);
        $saveImage->SetImageTmpName($nameWithoutSpaceTMP);
        $destination = $saveImage->SaveProfileImg();
    } else {
        $destination = $profile['image'];
    }

    $user_edit = new User();
    } else {
    }
    $user_edit->setImage($destination);
    } else {
        $error = "Something went wrong, profile isn't updated.";
    }
}

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