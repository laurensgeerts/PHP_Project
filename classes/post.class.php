<?php

include_once 'db.class.php';

class Post
{
    public $userId;
    public $image;
    public $description;
    public $postId;
    public $city;
    public $lng;
    public $lat;

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

        $lng = floatval($this->getLng());
        $lat = floatval($this->getLat());
        $conn = Db::getInstance();
        $statement = $conn->prepare('INSERT INTO posts (user_id, description, image, city, lng, lat,  date_created) values (:userid, :description, :image, :city, :lng, :lat, NOW())');
        $statement->bindValue(':userid', $this->getUserId());
        $statement->bindValue(':image', $this->getImage());
        $statement->bindValue(':city', $this->getCity());
        $statement->bindValue(':lng', $lng);
        $statement->bindValue(':lat', $lat);
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

   

// function to get  the address



    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

   

    /**
     * Get the value of lat
     */ 
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set the value of lat
     *
     * @return  self
     */ 
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

   

    /**
     * Get the value of lng
     */ 
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set the value of lng
     *
     * @return  self
     */ 
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }
}