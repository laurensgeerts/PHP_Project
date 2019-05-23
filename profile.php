<?php


include_once 'bootstrap.php';

$user_id = $_GET['id'];

var_dump($id);

$user = new User();

$profile = $user->getUserInfoDetail($user_id);

$id = $profile['id'];

$posts = Post::getallPostDetail($id, $user_id);


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
<body class="whiteBody">
    <div class="header">
       
            <?php include_once 'nav.inc.php'; ?>
        </div>
    </div>
<br>
<br>
<br>
<br>
<div class="forceMiddle">
    <h1> MIJN PROFIEL </h1>

   <p>Hier is jouw profielfoto:</p> 
   <br>
    <img src="<?php echo $profile['picture'] ?>" alt="profiel" style="width:100px;">
    
    <br>
    <p>Jouw naam :   <?php echo $profile['firstname']. " " .$profile['lastname']; ?>  </p> 
    <br>
    
  <p>  Vind hier jou biografie terug (als je er eentje hebt): <br><br>  <?php echo $profile['bio'];?></p>


  <a href="edit_profile.php" style="color:red;">Pas hier je profiel aan!</a>
</div>
     
   <br>
   <br>
        <h1>HIER ZIE JE AL JOUW POSTS:</h1>
        <div class="forceMiddle">
    <div class="grid-container">
	    <?php foreach ($posts as $post): ?>
        <div class="post">
	        <article >
            <img src="<?php echo $post->picture; ?>" class="profilepic">
            <p> <?php echo $post->date_created; ?> </p>
            <p class="name"><?php echo $post->firstname.' '.$post->lastname; ?></p>
            <img src="<?php echo $post->image; ?>" alt="">
            <p> <?php echo $post->description; ?> </p>
            <p> <?php echo $post->city; ?> </p>
            <p> <?php echo $post->hashtag1. '  ' .$post->hashtag2. '  ' .$post->hashtag3;?> </p>
      
            <a href="detail.php?id=<?php echo $post->id; ?>">More</a>
            <a href="delete.php?id=<?php echo $post->id; ?>">Verwijder je post</a>
            <a href="edit_post.php?post_id=<?php echo $post->id; ?>&user_id=<?php echo $_SESSION['user_id']; ?>">Pas je post aan</a>
          </article>
        </div>
      <?php endforeach; ?>
  
</div>
</div>

</body>
</html>