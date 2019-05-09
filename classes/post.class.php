<?php

include_once 'db.class.php';

class Post
{
    public $userId;
    public $image;
    public $description;

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

    public function newPost()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('INSERT INTO posts (user_id, description, image, date_created) values (:userid, :description, :image, NOW())');
        $statement->bindValue(':userid', $this->getUserId());
        $statement->bindValue(':image', $this->getImage());
        $statement->bindValue(':description', $this->getDescription());

        return $statement->execute();
    }

    /*
        public static function getAll(){
            $conn = Db::getInstance();
            $result = $conn->query("SELECT posts.*,users.firstname,users.lastname FROM posts,users WHERE posts.user_id=users.id order by posts.date_created desc");
            return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
        }
    */
    /*
        public static function getPosts(){
        SELECT posts.*, users.firstname
        FROM posts INNER JOIN users
        ON posts.user_id = users.id
        WHERE
        posts.user_id IN
            (
            SELECT follow_to FROM followers WHERE follow_from = 5
            )
        ORDER BY posts.date_created desc
    var_dump($_SESSION['user_id']);
    exit();
        }
    */
   /* public static function getPosts($UsId)
    {
        $conn = Db::getInstance();
        $result = $conn->query(
        'SELECT posts.*, users.firstname, users.lastname
        FROM posts INNER JOIN users
        ON posts.user_id = users.id
        WHERE
        posts.user_id IN 
            (
            SELECT follow_to FROM followers WHERE follow_from = '.$UsId.'
            /* Fetchen met $UsId werkt nog niet 
            )
        ORDER BY posts.date_created desc
        LIMIT 20
');*/
      //    $result->execute();

      //  return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
   // }

    public function searchPost($searchPost)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM posts WHERE description LIKE '%$searchPost%'  ");
        $statement->bindValue(1, "%$searchPost%", PDO::PARAM_STR);
        $statement->execute();

        return  $statement->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    /* public static function getThisPost($id){
         $conn = Db::getInstance();
         $result = $conn->query("SELECT posts.*,users.firstname,users.lastname,users.picture FROM posts,users WHERE post.id=$id AND posts.user_id=users.id ");
         return $result->fetch(PDO::FETCH_CLASS, __CLASS__);
     }
*/
}
