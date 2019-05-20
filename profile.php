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
	<link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Profile</title>
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
    <img src="<?php echo $profile['picture'] ?>" alt="profiel" style="width:100px;">

     <?php echo $profile['firstname']; ?>
     <br>
      <?php echo $profile['lastname'];?>
      <br>
      <?php echo $profile['bio'];?>
      <br>
      
        <h1>hier zie je al jouw posts:</h1>
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
            <div>
              <a href="#" data-id="<?php echo $post->id ?>" class="like <?php echo $post->id ?>"><img src="data/images/Asset 6.svg"></a>  
              <a href="#" data-id="<?php echo $post->id ?>" class="dislike <?php echo $post->id ?>" style="display:none;"><img src="data/images/Asset 7.svg"></a>
              <span class='likes' data-id="<?php echo $post->id ?>"><?php echo $post->getLikes(); ?></span> people like this
            </div>
            <a href="detail.php?id=<?php echo $post->id; ?>">More</a>
          </article>
        </div>
      <?php endforeach; ?>
    </div> 
  </div>


    <a href="edit_profile.php" style="display:block;margin-top: 80px;">edit profile</a>
</body>
</html>