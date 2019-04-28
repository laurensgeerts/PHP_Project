<?php
include_once('db.class.php');

class Comment{
    public $userId;
    public $comment;
    public $postId;


    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of postId
     */ 
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set the value of postId
     *
     * @return  self
     */ 
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    public function newComment(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO comments (user_id, post_id, comment, date_created) values (:userid, :postid, :comment, NOW())");
        $statement->bindValue(":userid", $this->getUserId());
        $statement->bindValue(":postid", $this->getPostId());
        $statement->bindValue(":comment", $this->getComment());
        return $statement->execute();
    }

    public static function getAll(){
        $conn = Db::getInstance();
        //$result = $conn->query("SELECT comments.*,users.firstname,users.lastname FROM posts,users WHERE posts.user_id=users.id ");
        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }
}
?>