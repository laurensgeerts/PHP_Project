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
            $post->setDescription(htmlspecialchars($_POST['description']));
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
  <div class="header">
    <div class="forceMiddle">
      <?php include_once 'nav.inc.php'; ?>
    </div>
  </div>
  <div class="overlay" id="overlay">
    <div class="uploadWindow" id="uploadWindow">
      <a href="javascript:void(0)" class="closebtn" onclick="closeOverlay()"><img src="data/images/Asset 9.svg"></a>
      <form method="post" enctype="multipart/form-data">
        <p>Select image to upload:</p>
  	    <input type="file" name="fileToUpload" id="fileToUpload" value="upload picture"><br>
	      <input type="text" name="description" id="description" placeholder="describe your picture"><br>    	  <input type="submit" value="Upload Image" name="submit" value="submit">
      </form>
    </div>
  </div>
  <a class="openbtn" onclick="openOverlay()"><img src="data/images/Asset 3.svg"></a>
  <div class="forceMiddle">
    <div class="grid-container">
	    <?php foreach ($posts as $post): ?>
        <div class="post">
	        <article >
            <img src="<?php echo $post->picture; ?>" class="profilepic">
            <p> <?php echo $post->date_created; ?> </p>
            <p class="name"> <?php echo $post->firstname.' '.$post->lastname; ?> </p>
            <img src="<?php echo $post->image; ?>" alt="">
            <p> <?php echo $post->description; ?> </p>
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

  <script
		src="http://code.jquery.com/jquery-3.4.1.min.js"
		integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
		crossorigin="anonymous">
  </script>

  <script>
    function openOverlay() {
      document.getElementById("overlay").style.height = "100%";
    }

    function closeOverlay() {
      document.getElementById("overlay").style.height = "0%";
    }
  </script>

  <script>
		$("a.like").on("click",function(e){
      var postId = $(this).data("id");
      var type = 1;
			var elLikes = $(this).siblings(".likes");
      var likes=elLikes.html();

			$.ajax({
  				method: "POST",
  				url: "ajax/postlike.php",
  				data: {postId: postId, type:type},
			})
  		
      .done(function (res) {
        try {
          var json_obj = JSON.parse(res);
          if(json_obj.status=="success"){
            console.log('test1');
            likes++;
					  elLikes.text(likes);
            $("a.like."+postId).css("display","none");
            $("a.dislike."+postId).css("display","inline-block");
    
          }
        } catch (e) {
          console.log('failed to parse');
        }
      })    
      .fail(function (jqXHR, textStatus) { 
        console.log('failed') 
      });
      e.preventDefault();
			
    });
  </script>

  <script>
    $("a.dislike").on("click",function(e){
      var postId = $(this).data("id");
      var type = 0;
			var elLikes = $(this).siblings(".likes");
      var likes=elLikes.html();

			$.ajax({
  				method: "POST",
  				url: "ajax/postlike.php",
  				data: {postId: postId, type:type},
      })
      .done(function(res) {
        try {
          var json_obj = JSON.parse(res);
          if(json_obj.status=="success"){
            console.log('test2');
            likes--;
					  elLikes.text(likes);
            $("a.dislike."+postId).css("display","none");
            $("a.like."+postId).css("display","inline-block");

          } 
        }catch (e) {
          console.log('failed to parse 2');
        }
      })    
      .fail(function (jqXHR, textStatus) { 
        console.log('failed 2') 
      });
      e.preventDefault();
      });
	</script>

</body>
</html>