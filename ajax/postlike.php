<?php
    //post?
    include_once("./classes/db.class.php");
    include_once("./classes/like.class.php");

    if(!empty($_POST)){
        $postId=$_POST['postId'];
        $userId=$_SESSION['user_id'];
        

        $l = new Like();
        $l->setPostId($postId);
        $l->setUserId($userId);
        $l->save();

        //JSON 
        $result = [
            "status" => "success",
            "message" => "Like has been saved."
        ];
        echo json_encode($result);
    }

?>