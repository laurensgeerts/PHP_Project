<?php

include_once 'bootstrap.php';
include_once 'ajax/postcomment.php';
require_once 'ColorExtractor/Color.php';
require_once 'ColorExtractor/ColorExtractor.php';
require_once 'ColorExtractor/Palette.php';


     use ColorExtractor\Color;
     use ColorExtractor\ColorExtractor;
     use ColorExtractor\Palette;

$id = htmlspecialchars($_GET['id']);

$user = new User();
$user->setUser_id($_SESSION['user_id']);
$profile = $user->getUserInfo();

//get post --> display image, description, date, name poster, image poster
$post = Post::getById($id);

$comments = Comment::getAll($id);

$picture = $post->image;

$palette = Palette::fromFilename($picture);

$extractor = new ColorExtractor($palette);

$colors = $extractor->extract(5);


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
    <div class="header">
        <div class="forceMiddle">
            <?php include_once 'nav.inc.php'; ?>
        </div>
    </div>
    <div class="forceMiddle">
        <div class="detail">
            <img src="<?php echo $post->image; ?>" alt="picture of this post" class="postImage">
            <div class="textOfPost">
                <img src="<?php echo $post->picture; ?>" class="profilepic">
                <p> <?php echo $post->firstname.' '.$post->lastname; ?> </p>
                <p> <?php echo $post->date_created; ?> </p>
                <p> <?php echo $post->description; ?> </p>
                <?php if(Post::checkLike($post->id, $_SESSION['user_id'])==0) { ?>
                    <?php echo '<a href="#" data-id="'.$post->id.'" class="like '.$post->id.'"><img src="data/images/Asset 6.svg"></a>'?>
                    <?php echo '<a href="#" data-id="'.$post->id.'" class="dislike '.$post->id.'" style="display:none;"><img src="data/images/Asset 7.svg"></a>'?>
                <?php } else if(Post::checkLike($post->id, $_SESSION['user_id'])==1){ ?>
                    <?php echo '<a href="#" data-id="'.$post->id.'" class="like '.$post->id.'" style="display:none;"><img src="data/images/Asset 6.svg"></a>'?>
                    <?php echo '<a href="#" data-id="'.$post->id.'" class="dislike '.$post->id.'" ><img src="data/images/Asset 7.svg"></a>' ?>
                <?php }?>
                <span class='likes' data-id="<?php echo $post->id ?>"><?php echo Post::getLikes($id); ?></span> people like this <br>
                <?php foreach($colors as $c):?>
                    <div style="width:40px;height:40px;background-color:<?php  echo Color::fromIntToHex($c); ?>;display:inline-block;border-radius:30px;"></div>
                <?php endforeach; ?> 
                <form method="post" enctype="">
                    <input type="checkbox" id="check" name="Inappropriate">Mark this post as inappropriate<br>
                </form>
            </div>
        </div>
        <div class="comments">
            <p>Comments</p>
            <form method="post" enctype="">
                <input type="text" name="comment" id="comment" placeholder="write something nice">
                <input id="btnSubmit" type="submit" value="Add comment" />
            </form>
            <div class="commentBox">
                <?php foreach ($comments as $comment): ?>
                    <div  data-comment=<?php echo $id ?>>
                        <p><?php echo $comment->firstname.' '.$comment->lastname; ?> </p> 
                        <p> <?php echo $comment->comment; ?> </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div> 
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
                    var user = res.data.user;
                    var u = "<p>"+user+"</p>";
                    var com = "<p>"+comment+"</p>";
                    $(".commentBox").append(u);
                    $(".commentBox").append(com);
                    $(".commentBox").last().slideDown();
                    $('#comment').val('').focus();
			    }
  		    });
            e.preventDefault();
	    });
    </script>

    <script>
        on
        $("#check").on("click",function(e){
            var checked = document.getElementById('isAgeSelected').checked;
            console.log(checked);
        });
    </script>
    <?php include_once 'likeScript.inc.php'; ?>
</body>
</html>