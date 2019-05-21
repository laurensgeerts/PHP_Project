<?php


include_once 'bootstrap.php';

$user_id = $_GET['user_id'];
$post_id = $_GET['post_id'];

$post = new Post();
$getInfo = $post->getPostInfoDetail($post_id);






//$user = new User();
if (!empty($_POST)) {
    if (!empty($_POST['description'])) {

        $post = new Post();
$post->setHashtag1($_POST['hashtag1']);
$post->setHashtag2($_POST['hashtag2']);
$post->setHashtag3($_POST['hashtag3']);
$post->setDescription($_POST['description']);
$post->updatePosts($post_id, $user_id);

header('Location: index.php');


    }

    else

    {
      $message = "please write a descrition";
    }



}



?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" media="screen" href="css/reset.css">
  <link rel="stylesheet" media="screen" href="css/style.css">
  <link rel="stylesheet" media="screen" href="css/CSSgram.css">
  <title>Inspiration Hunter</title>
</head>
<body>
    <div class="header">
        <div class="forceMiddle">
            <?php include_once 'nav.inc.php'; ?>
        </div>
    </div>
<br>
<br>
<br>
<br>


<div class="uploadWindow" id="uploadWindow">

 <h1> !let op! Je kan alleen maar posts aanpassen van jij hebt geplaatst!</h1>
<p>your photo:</p>
  <img src="<?php  echo $getInfo['image'];  ?>"  alt="edit_post" style="width:200px;">
  <form method="post" enctype="multipart/form-data">
        <p>change description;</p>
        <input type="text" name="description" id="description" placeholder="<?php  echo $getInfo['description'];  ?>"><br>    	  
        <p>change your hashtags:</p>
         <input type="text" name="hashtag1" id="hashtag1" value="# <?php  echo $getInfo['hashtag1'];  ?>">
        <input type="text" name="hashtag2" id="hashtag2"value="# <?php  echo $getInfo['hashtag2'];  ?>" >
        <input type="text" name="hashtag3" id="hashtag3"value="# <?php  echo $getInfo['hashtag3'];  ?>">

        <input type="submit" value="update your post" name="submit" value="submit">
      </form>
    </div>





</body>
</html>