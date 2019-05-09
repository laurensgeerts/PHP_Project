<?php

include_once 'bootstrap.php';
include_once 'ajax/postcomment.php';

$id = $_GET['id'];

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
    <div class="detail">
        <img src="<?php echo $post->image; ?>" alt="picture of this post" class="postImage">
        <div class="textOfPost">
            <img src="<?php echo $post->picture; ?>" class="profilepic">
            <p> <?php echo $post->firstname.' '.$post->lastname; ?> </p>
            <p> <?php echo $post->date_created; ?> </p>
            <p> <?php echo $post->description; ?> </p>
        </div>
    </div>
    <form method="post" enctype="">
        <input type="checkbox" name="Inappropriate">Mark this post as inappropriate<br>
        <input type="text" name="comment" id="comment" placeholder="write something nice">
        <input id="btnSubmit" type="submit" value="Add comment" />
    </form>
    <?php foreach ($comments as $comment): ?>
        <div class="commentBox" data-comment=<?php echo $id ?>>
            <p><?php echo $comment->firstname.' '.$comment->lastname; ?> </p> 
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
		    var comment = $("#comment").val(); //waarde van de text input
            var postId = <?php echo $id ?>;
		    //console.log(postId);

		    $.ajax({
  			    method: "POST",
  			    url: "ajax/postcomment.php",
 			    data: {comment:comment,postId:postId}, 
			    dataType: 'json'
		    })
  		    .done(function( res ) {
                console.log(res);
			    if(res.status == 'succes'){
                    var comment = res.data.comment;
                    var li = "<p>"+ comment+"<p>";
                    $(this).data("comment").append(p);
                    $(this).data("comment").last().slideDown();
                    $('#comment').val('').focus();
			    }
  		    });
              
		    e.preventDefault();
	    });
    </script>
</body>
</html>