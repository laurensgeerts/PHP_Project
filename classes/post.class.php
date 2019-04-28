<?php
include_once('db.class.php');

class Post
{   public $userId;
    public $image;
    public $description;
    public $postId;
    
    public function getUserId()
        {
                return $this->userId;
        }
    
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    public function getImage()
        {
                return $this->image;
        }
    
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription()
        {
                return $this->description;
        }
    
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    // /**
    //  * Get the value of postId
    //  */ 
    // public function getPostId()
    // {
    //     return $this->postId;
    // }

    // /**
    //  * Set the value of postId
    //  *
    //  * @return  self
    //  */ 
    // public function setPostId($postId)
    // {
    //     $this->postId = $postId;

    //     return $this;
    // }

    public function newPost(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO posts (user_id, description, image, date_created) values (:userid, :description, :image, NOW())");
        $statement->bindValue(":userid", $this->getUserId());
        $statement->bindValue(":image", $this->getImage());
        $statement->bindValue(":description", $this->getDescription());
        return $statement->execute();

    }

    public static function getAll(){
        $conn = Db::getInstance();
        $result = $conn->query("SELECT posts.*,users.firstname,users.lastname FROM posts,users WHERE posts.user_id=users.id ");
        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public static function getThisPost(){
        $conn = Db::getInstance();
        $statement = $conn->query("SELECT posts.*,users.firstname,users.lastname,users.picture FROM posts,users WHERE posts.id=:id AND posts.user_id=users.id ");
        $statement->bindParam(":id",$_GET['id']);
        return $result=$statement->fetch(PDO::FETCH_ASSOC);
    }

    
}
?>