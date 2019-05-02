<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once './classes/comment.class.php';

if (!empty($_POST)) {
    try {
        $comment = new Comment();
        $comment->setUserId($_SESSION['user_id']);
        $comment->setPostId($id);
        $comment->setComment($_POST['comment']);
        $comment->newComment();

        $result = [
            'status' => 'succes',
            'message' => 'ya did it',
        ];
    } catch (trowable $t) {
        $result = [
            'status' => 'failed',
            'message' => "ya didn't it",
        ];
    }
    echo json_encode($result);
    //connectie
    //query (insert)
    //antwoord geven aan JS frontend (json)
}
