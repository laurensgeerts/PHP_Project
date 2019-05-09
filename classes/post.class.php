<?php

include_once 'db.class.php';

class Post
{
    public $userId;
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

    /**
     * Get the value of postId.
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set the value of postId.
     *
     * @return self
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    public function newPost()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('INSERT INTO posts (user_id, description, image, date_created) values (:userid, :description, :image, NOW())');
        $statement->bindValue(':userid', $this->getUserId());
        $statement->bindValue(':image', $this->getImage());
        $statement->bindValue(':description', $this->getDescription());

        return $statement->execute();
    }

    public static function getAll()
    {
        $conn = Db::getInstance();
        $result = $conn->query('SELECT posts.*,users.firstname,users.lastname, users.picture FROM posts,users WHERE posts.user_id=users.id ');

        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    // public static function getThisPost($id){
    //     $conn = Db::getInstance();
    //     $statement = $conn->query("SELECT posts.*,users.firstname,users.lastname,users.picture FROM posts,users WHERE posts.id=:id AND posts.user_id=users.id ");
    //     $statement->bindValue(":id",$id);
    //     return $result=$statement->fetch(PDO::FETCH_ASSOC);
    // }

    public static function getById($id)
    {
        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare('SELECT posts.*,users.firstname,users.lastname,users.picture FROM posts,users WHERE posts.id=:id AND posts.user_id=users.id ORDER BY id ASC ');
            $statement->bindValue(':id', $id);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_OBJ);
        } catch (Expection $e) {
            echo 'sorry, not working';
        }
    }

    public function searchPost($searchPost){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT posts.*,users.firstname,users.lastname, users.picture FROM posts,users WHERE posts.user_id=users.id AND (posts.description LIKE '%$searchPost%' OR CONCAT(users.firstname, ' ', users.lastname) LIKE '%$searchPost%' OR  users.firstname LIKE '%$searchPost%' OR users.lastname  LIKE '%$searchPost%')");
        $statement->bindValue(1, "%$searchPost%", PDO::PARAM_STR);
        $statement->execute();
        
        return  $statement->fetchAll(PDO::FETCH_CLASS, __CLASS__);
}
}