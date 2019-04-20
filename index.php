<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if( $_SESSION['loggedin'] == false){
  header('Location: login.php');
};

include_once("classes/user.class.php");
$user = new User();
$user->setUser_id($_SESSION["user_id"]);

$profile = $user->getUserInfo();

include_once("classes/post.class.php");

$target_dir = "data/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

if(!empty($_POST)){
  if(!empty($_POST["description"])){
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	    
      $post = new Post();
      $post->setImage($target_dir . basename($_FILES["fileToUpload"]["name"]));
      $post->setDescription($_POST["description"]);
      $post->setUserId($_SESSION["user_id"]);
      $post->newPost();
	    
    } else {
      echo "Sorry, there was an error uploading your file.";
    }

    
      
  }else{
    echo "Please write a description";
  }

}

$posts = Post::getAll();
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>index</title>
</head>
<body>
  <?php include_once("nav.inc.php"); ?>
  <!-- <form action="upload.php" method="post" enctype="multipart/form-data"> -->
  <form method="post" enctype="multipart/form-data">
    	Select image to upload:
    	<input type="file" name="fileToUpload" id="fileToUpload" value="upload picture">
		  <input type="text" name="description" id="description" placeholder="describe your picture">
    	<input type="submit" value="Upload Image" name="submit" value="submit">
	</form>
	<?php foreach($posts as $post): ?>
	    <article class="post" href="details.php?id=<?php echo $post->id;?>">
			  <p> <?php echo $post->userId;?> </p>
		    <p> <?php echo $post->description; ?> </p>
		    <img src= " <?php echo $post->image; ?> " alt="">
	    </article>
	<?php endforeach; ?>
  <script>
    //e.preventDefault();er
  </script>
</body>
</html>
