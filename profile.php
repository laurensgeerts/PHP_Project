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
<body>
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


  <a href="edit_profile.php" style="">Pas hier je profiel aan!</a>
</div>
      <?php //echo $profile['lastname'];?>
   <br>
   <br>
        <h1>HIER ZIE JE AL JOUW POSTS:</h1>
      
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
            <?php if(Post::checkLike($post->id, $_SESSION['user_id'])==0) { ?>
                <?php echo '<a href="#" data-id="'.$post->id.'" class="like '.$post->id.'"><img src="data/images/Asset 6.svg"></a>'?>
                <?php echo '<a href="#" data-id="'.$post->id.'" class="dislike '.$post->id.'" style="display:none;"><img src="data/images/Asset 7.svg"></a>'?>
              <?php } else if(Post::checkLike($post->id, $_SESSION['user_id'])==1) {?>
                <?php echo '<a href="#" data-id="'.$post->id.'" class="like '.$post->id.'" style="display:none;"><img src="data/images/Asset 6.svg"></a>'?>
                <?php echo '<a href="#" data-id="'.$post->id.'" class="dislike '.$post->id.'" ><img src="data/images/Asset 7.svg"></a>' ?>
              <?php }?>
              <span class='likes' data-id="<?php echo $post->id ?>"><?php echo Post::getLikes($post->id); ?></span> people like this
            </div>
            <a href="detail.php?id=<?php echo $post->id; ?>">More</a>
            <a href="delete.php?id=<?php echo $post->id; ?>">Verwijder je post</a>
            <a href="edit_post.php?post_id=<?php echo $post->id; ?>&user_id=<?php echo $_SESSION['user_id']; ?>">Pas je post aan</a>
          </article>
        </div>
      <?php endforeach; ?>
  


</body>
</html>