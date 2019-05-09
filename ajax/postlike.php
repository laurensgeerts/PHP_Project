<?php
    //post?
    include_once("./classes/db.class.php");
    include_once("./classes/like.class.php");

    session_start();

    if(!empty($_POST)){
        try {
            $postId=$_POST['postId'];
            $type=$_POST['type'];
            $userId=$_SESSION['user_id'];
        
            $l = new Like();
            $l->setPostId($postId);
            $l->setUserId($userId);
            $l->setType($type);
            $l->save();

            //JSON 
            $result = [
                "status" => "success",
                "message" => "Like has been saved."
            ];
        }catch (trowable $t) {
            $res = [
                'status' => 'failed',
                'message' => "something went wrong."
            ];
        }
        echo json_encode($result);
    }

?>