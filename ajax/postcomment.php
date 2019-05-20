<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../classes/comment.class.php';
session_start();

if (!empty($_POST)) {
    try {
        $comment = new Comment();
        $comment->setUserId($_SESSION['user_id']);
        $comment->setPostId($_POST['postId']);
        $comment->setComment(htmlspecialchars($_POST['comment']));
        $comment->newComment();

        $res = [
            'status' => 'succes',
            'message' => 'ya did it',
            'data'=>[
                'comment' => htmlspecialchars($_POST['comment'], ENT_QUOTES),
                'user' => $_SESSION["firstname"]." ".$_SESSION["lastname"]
            ],
        ];
    } catch (trowable $t) {
        $res = [
            'status' => 'failed',
            'message' => "ya didn't it",
        ];
    }
    echo json_encode($res);
    //connectie
    //query (insert)
    //antwoord geven aan JS frontend (json)
}
