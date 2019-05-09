<?php


include_once 'bootstrap.php';




if (!empty($_POST['searchPost'])){

  $post = new Post();
  $res_post = $post->searchPost($_POST['searchPost']);


}

else 
{
  echo "vul hier iets in";
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





    <form action="" method="post" id="form">
    <input type="text" name="searchPost" placeholder=" zoek hier naar een post " />
    <input type="submit" value="Search" name="submit_search" id="submit">
</form>

<?php foreach ($res_post as $post): ?>
    <div class="grid-container">
      <div class="post">
	      <article >
          <img src="<?php echo $post->picture; ?>" class="profilepic">
          <p> <?php echo $post->firstname.' '.$post->lastname; ?> </p>
          <p> <?php echo $post->date_created; ?> </p>
          <img src="<?php echo $post->image; ?>" alt="">
          <p> <?php echo $post->description; ?> </p>
          <a href="detail.php?id=<?php echo $post->id; ?>">More</a>
          
        </article>
      </div>
    </div>  
	<?php endforeach; ?>

    
</body>
</html>