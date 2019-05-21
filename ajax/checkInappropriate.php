<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once '../classes/post.class.php';
    session_start();

    if (!empty($_POST)) {
        try {
            $postId=$_POST['postId'];
            $type=htmlspecialchars($_POST['type']);
            $userId=$_SESSION['user_id'];
        
            $inp = new Inapproprate();
            $inp->setPostId($postId);
            $inp->setUserId($userId);
            $inp->setType($type);
            $inp->setInappropriate();

            $res = [
                "status" => "success",
                "message" => "Like has been saved.",
                "data" =>[
                    "type" => $type
                ]
            ];

        } catch (trowable $t) {
            $res = [
                'status' => 'failed',
                'message' => "ya didn't it",
            ];
        }
    }
    echo json_encode($res);