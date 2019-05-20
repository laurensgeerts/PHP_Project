<?php

include_once 'bootstrap.php';
include_once 'ajax/postcomment.php';
require_once 'ColorExtractor/Color.php';
require_once 'ColorExtractor/ColorExtractor.php';
require_once 'ColorExtractor/Palette.php';


     use ColorExtractor\Color;
     use ColorExtractor\ColorExtractor;
     use ColorExtractor\Palette;

$id = $_GET['id'];

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
    
<?php include_once("includes/nav.inc.php"); ?>
<?php include_once("includes/error.inc.php"); ?>
    <div class="detail">
        <img src="<?php echo $post->image; ?>" alt="picture of this post" class="postImage">
        <div class="textOfPost">
            <img src="<?php echo $post->picture; ?>" class="profilepic">
            <p> <?php echo $post->firstname.' '.$post->lastname; ?> </p>
            <p> <?php echo $post->date_created; ?> </p>
            <p> <?php echo $post->description; ?> </p>
           
            <?php foreach($colors as $c):?>
                    <div style="width:40px;height:40px;background-color:<?php  echo Color::fromIntToHex($c); ?>;display:inline-block;border-radius:30px;"></div>
                <?php endforeach; ?> 
               
        </div>
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