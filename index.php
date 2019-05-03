<?php

include_once 'bootstrap.php';

$user = new User();
$user->setUser_id($_SESSION['user_id']);
$profile = $user->getUserInfo();

$target_dir = 'data/uploads/'; // zet in config

if (!empty($_POST)) {
    $target_file = $target_dir.basename($_FILES['fileToUpload']['name']);
    if (!empty($_POST['description'])) {
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
            $message = 'The file '.basename($_FILES['fileToUpload']['name']).' has been uploaded.';
            echo "<script type='text/javascript'>alert('$message');</script>";
            // zet potentieel in image classe bv Image::upload($file)

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
$posts = Post::getAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" media="screen" href="css/reset.css">
  <link rel="stylesheet" media="screen" href="css/style.css">
  <title>Inspiration Hunter</title>
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
  <div class="grid-container">
  
	  <?php foreach ($posts as $post): ?>
    <div class="post">
	      <article >
          <img src="<?php echo $post->picture; ?>" class="profilepic">
          <p> <?php echo $post->date_created; ?> </p>
          <p class="name"> <?php echo $post->firstname.' '.$post->lastname; ?> </p>
          <img src="<?php echo $post->image; ?>" alt="">
          <p> <?php echo $post->description; ?> </p>
          <div><a href="#" data-id="<?php echo $post->id ?>" class="like">Like</a> <span class='likes'><?php echo $post->getLikes(); ?></span> people like this </div>
          <a href="detail.php?id=<?php echo $post->id; ?>">More</a>
        </article>
        </div>
    <?php endforeach; ?>
    
  </div> 
  <script>
		$("a.like").on("click",function(e){
			//op welke post?
			var postId = $(this).data('id');
			var elLikes =$(this)parent().find(".likes");
			var likes=elLikes.html();
			
			$.ajax({
  				method: "POST",
  				url: "ajax/postlike.php",
  				data: {postId: postId},
				dataType: "json"

			})
  			.done(function( res ) {
    			if(res.status=="succes"){
					likes++;
					elLikes=html(likes);

				}
  			});

			e.preventDefault();
		});
	</script>

</body>
</html>