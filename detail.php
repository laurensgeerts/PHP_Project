<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'classes/user.class.php';
include_once 'classes/post.class.php';
include_once 'ajax/postcomment.php';
include_once 'classes/comment.class.php';

$id = $_GET['id'];

session_start();
if ($_SESSION['loggedin'] == false) {
    header('Location: login.php');
}

$user = new User();
$user->setUser_id($_SESSION['user_id']);
$profile = $user->getUserInfo();

//get post --> display image, description, date, name poster, image poster
$post = Post::getById($id);

$comments = Comment::getAll($id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="screen" href="css/reset.css">
    <link rel="stylesheet" media="screen" href="css/style.css">
    <title>post <?php echo $id; ?></title>
</head>
<body>
    <?php include_once 'nav.inc.php'; ?>
        <img src="<?php echo $post->image; ?>" alt="">
        <div class="textOfPost">
            <img src="<?php echo $post->picture; ?>" class="profilepic">
            <p> <?php echo $post->firstname.' '.$post->lastname; ?> </p>
            <p> <?php echo $post->date_created; ?> </p>
            <p> <?php echo $post->description; ?> </p>
        </div>
    <form method="post" enctype="">
        <input type="text" name="comment" id="comment" placeholder="write something nice">
        <input id="btnSubmit" type="submit" value="Add comment" />
    </form>
    <?php foreach ($comments as $comment): ?>
        <div class="comment">
            <p> <?php echo $comment->firstname.' '.$comment->lastname; ?> </p>
            <p> <?php echo $comment->date_created; ?> </p>
            <p> <?php echo $comment->comment; ?> </p>
        </div>
    <?php endforeach; ?>
    <script
	    src="https://code.jquery.com/jquery-3.3.1.min.js"
	    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	    crossorigin="anonymous">
    </script>
    <script>
	    $("#btnSubmit").on("click",function(e){
		    var text = $("#comment").val(); //waarde van de text input
		    //console.log(text);

		    $.ajax({
  			    method: "POST",
  			    url: "ajax/postcomment.php",
 			    data: { comment: comment },
			    dataType: 'json'
		    })
  		    .done(function( res ) {
    		    //alert( "Data Saved: " + msg );
			    if(res.status == 'succes'){
				
			}
  		    });
		    e.preventDefault();
	    });
    </script>
</body>
</html>