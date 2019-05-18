<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if ($_SESSION['loggedin'] == false) {
    header('Location: login.php');
}

include_once 'classes/user.class.php';
$user = new User();
$user->setUser_id($_SESSION['user_id']);
$profile = $user->getInfo();

include_once 'classes/post.class.php';

$target_dir = 'data/uploads/';
if (!empty($_POST)) {
    if (!empty($_POST['description'])) {
        $target_file = $target_dir.basename($_FILES['fileToUpload']['name']);
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
            $message = 'The file '.basename($_FILES['fileToUpload']['name']).' has been uploaded.';
            echo "<script type='text/javascript'>alert('$message');</script>";

            $post = new Post();
            $post->setImage($target_dir.basename($_FILES['fileToUpload']['name']));
            $post->setDescription($_POST['description']);
            $post->setUserId($_SESSION['user_id']);
            $post->newPost();
        } else {
            echo 'Sorry, there was an error uploading your file.';
        }
    } else {
        echo 'Please write a description';
    }
}
$posts = Post::getAll($_SESSION['user_id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" media="screen" href="css/reset.css">
  <link rel="stylesheet" media="screen" href="css/style.css">
  <title>Inspiration Hunter</title>
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
</head>
<body>
  <?php include_once 'nav.inc.php'; ?>
  <!-- <form action="upload.php" method="post" enctype="multipart/form-data"> -->
  <form method="post" enctype="multipart/form-data">
    	Select image to upload:
    	<input type="file" name="fileToUpload" id="fileToUpload" value="upload picture">
		  <input type="text" name="description" id="description" placeholder="describe your picture">
    	<input type="submit" value="Upload Image" name="submit" value="submit">
	</form>
  <?php foreach ($posts as $post):
  //Om de tijd om te zetten voor de timeConverter functie
  $time_post = $post->date_created;
  $time_post_str = strtotime($time_post);
    ?>
    <div class="grid-container">
      <div class="post">
	      <article >
          <img src="<?php echo $post->picture; ?>">
			    <p> <?php echo $post->firstname.' '.$post->lastname; ?> </p>
          <p> <?php echo $convertedTime = Post::timeConverter($time_post_str); ?></p>
          <img src="<?php echo $post->image; ?>" alt="" href="detail.php?id=<?php echo $post->id; ?>">
		      <p> <?php echo $post->description; ?> </p>
        </article>
      </div>
    </div>
	<?php endforeach; ?>

  <button class="loadmorebutton"> Load more </button>

  <script>
    //e.preventDefault();er
  </script>
<script src="js/moreposts.js"></script>


</body>
</html>