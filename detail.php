<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id=$_GET['id'];

session_start();
if( $_SESSION['loggedin'] == false){
  header('Location: login.php');
};

include_once("classes/user.class.php");
$user = new User();
$user->setUser_id($_SESSION["user_id"]);
$profile = $user->getUserInfo();

//get post --> display image, description, date, name poster, image poster 
include_once("classes/post.class.php");
$post=Post::getThisPost();
include_once("classes/comment.class.php");
if(!empty($_POST)){
    $comment=new Comment;
    $comment->setUserId($_SESSION["user_id"]);
    $comment->setPostId($id);
    $comment->setComment($_POST['comment']);
    $comment->newComment();

/**
 * Get the value of id
 */ 

}
// $comments=Comment::getAll();

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
    <?php include_once("nav.inc.php"); ?>
    <?php foreach($post as $post): ?>
        <img src="<?php echo $post->image; ?>" alt="">
        <div class="textOfPost">
            <img src="<?php echo $post->picture; ?>" class="profilepic">
            <p> <?php echo $post->firstname." ".$post->lastname;?> </p>
            <p> <?php echo $post->date_created; ?> </p>
            <p> <?php echo $post->description; ?> </p>
        </div>
    <?php endforeach;?>
    <form>
        <input type="text" name="comment" id="comment" placeholder="write something nice">
    </form>
    <?php foreach($comments as $comment): ?>
        <img src="<?php echo $post->image; ?>" alt="">
        <div class="textOfPost">
            <p> <?php echo $comment->firstname." ".$comment->lastname;?> </p>
            <p> <?php echo $comment->date_created; ?> </p>
            <p> <?php echo $comment->comment; ?> </p>
        </div>
    <?php endforeach;?>
</body>
</html>