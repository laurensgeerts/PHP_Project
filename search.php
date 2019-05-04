<?php

include_once("classes/user.class.php");

include_once("classes/post.class.php");


if(!empty($_POST['searchProfile'])){
    $user = new User();
    $res_profile = $user->searchProfile($_POST['searchProfile']);

}

if (!empty($_POST['searchPost'])){
$post = new Post();

$res_post = $post->searchPost($_POST['searchPost']);


}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="screen" href="css/reset.css">
  <link rel="stylesheet" media="screen" href="css/style.css">  
    <title>search </title>
</head>
<body>

<?php include_once("nav.inc.php"); ?>

profielen:
<form action="" method="post" id="form">
    <input type="text" name="searchProfile" placeholder=" zoek hier naar een profiel " />
    <input type="submit" value="Search" name="submit_search" id="submit">
</form>


<?php foreach($res_profile as $res_profile): ?>
	    <article class="post" >
			  <p> <?php echo $res_profile->getFirstname()." ".$res_profile->getLastname();?> </p>
       
        <img src= " <?php echo $res_profile->getImage(); ?> " alt="">
		    <p> <?php echo $res_profile->getBio(); ?> </p>
	    </article>
    <?php endforeach; ?>

    <form action="" method="post" id="form">
    <input type="text" name="searchPost" placeholder=" zoek hier naar een post " />
    <input type="submit" value="Search" name="submit_search" id="submit">
</form>


<?php foreach($res_post as $post): ?>
	    <article class="post" >
			  
        <p> <?php echo $post->date_created; ?> </p>
        <img src= " <?php echo $post->image; ?> " alt="">
		    <p> <?php echo $post->description; ?> </p>
	    </article>
	<?php endforeach; ?>

    
</body>
</html>