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
    public $hashtag1;
    public $hashtag2;
    public $hashtag3;


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
        $h1 = "#" . $this->getHashtag1();
        $h2 = "#" . $this->getHashtag2();
        $h3 = "#" . $this->getHashtag3();

        $conn = Db::getInstance();
        $statement = $conn->prepare('INSERT INTO posts (user_id, description, image, city, lng, lat, hashtag1, hashtag2, hashtag3, date_created) values (:userid, :description, :image, :city, :lng, :lat, :hashtag1, :hashtag2, :hashtag3, NOW())');
        $statement->bindValue(':userid', $this->getUserId());
        $statement->bindValue(':image', $this->getImage());
        $statement->bindValue(':city', $this->getCity());
        $statement->bindValue(':lng', $lng);
        $statement->bindValue(':lat', $lat);
        $statement->bindValue(':hashtag1', $h1);
        $statement->bindValue(':hashtag2', $h2);
        $statement->bindValue(':hashtag3', $h3);

        $statement->bindValue(':description', $this->getDescription());
      

        return $statement->execute();
    }

    public static function getAll()
    {
        $conn = Db::getInstance();
        $result = $conn->prepare(
            'SELECT posts.*, users.firstname, users.lastname, users.picture
            FROM posts INNER JOIN users
            ON posts.user_id = users.id
            WHERE
            posts.user_id IN 
                (
                SELECT follow_to FROM followers WHERE follow_from = :usId
                )
            ORDER BY posts.date_created desc
            LIMIT 5');
        $result->bindParam(':usId',$UsId);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    // public static function getThisPost($id){
    //     $conn = Db::getInstance();
    //     $statement = $conn->query("SELECT posts.*,users.firstname,users.lastname,users.picture FROM posts,users WHERE posts.id=:id AND posts.user_id=users.id ");
    //     $statement->bindValue(":id",$id);
    //     return $result=$statement->fetch(PDO::FETCH_ASSOC);
    // }
   

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

        $secondsTo = array(
                12 * 31 * 24 * 60 * 60 => 'year',
                31 * 24 * 60 * 60 => 'month',
                24 * 60 * 60 => 'day',
                60 * 60 => 'hour',
                60 => 'minute',
                1 => 'second',
        );

        foreach ($secondsTo as $secs => $str) {
            $c = $calculated_time / $secs;
            if ($c >= 1) {
                $roundC = round($c);

                return 'Uploaded about '.$roundC.' '.$str.($roundC > 1 ? 's' : '').' ago.';
            }
        }
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

    /**
     * Get the value of hashtag1
     */ 
    public function getHashtag1()
    {
        return $this->hashtag1;
    }

    /**
     * Set the value of hashtag1
     *
     * @return  self
     */ 
    public function setHashtag1($hashtag1)
    {
        $this->hashtag1 = $hashtag1;

        return $this;
    }

    /**
     * Get the value of hashtag2
     */ 
    public function getHashtag2()
    {
        return $this->hashtag2;
    }

    /**
     * Set the value of hashtag2
     *
     * @return  self
     */ 
    public function setHashtag2($hashtag2)
    {
        $this->hashtag2 = $hashtag2;

        return $this;
    }

    /**
     * Get the value of hashtag3
     */ 
    public function getHashtag3()
    {
        return $this->hashtag3;
    }

    /**
     * Set the value of hashtag3
     *
     * @return  self
     */ 
    public function setHashtag3($hashtag3)
    {
        $this->hashtag3 = $hashtag3;

        return $this;
    }

    public static function getById($id)
    {
        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare('SELECT posts.*,users.firstname,users.lastname,users.picture FROM posts,users WHERE posts.id=:id AND posts.user_id=users.id');
            $statement->bindValue(':id', $id);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_OBJ);
        } catch (Expection $e) {
            echo 'sorry, not working';
        }
    }

    public function getLikes(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT count(*) AS countLikes FROM likes WHERE post_id=:postid AND `type`=1");
        $statement->bindValue(":postid", $this->id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['countLikes'];
    }

    public function setInappropriate($userId){
        $conn = Db::getInstance();
        $statement=$conn->prepare("SELECT * from inappropriate where post_id=:postId AND `user_id`=:userId");
        $statement->bindValue(":postId", $this->getPostId());
        $statement->bindValue(":userId", $userId);
        $statement->execute();
        $stm=$statement->fetch(PDO::FETCH_BOUND);

        if($stm=false){
            $result = $conn->prepare("INSERT into inappropriate (post_id, `user_id`) VALUES (:postid, :userid)");
            $result->bindValue(":postid", $this->getPostId());
            $result->bindValue(":userid", $userId);
            return $result->execute();
        } else{
            $result = $conn->prepare("DELETE FROM `inappropriate` WHERE post_id=:postId AND `user_id`=:userId");
            $result->bindValue(":postid", $this->getPostId());
            $result->bindValue(":userid", $userId);
            return $result->execute();
        }
    }

    public function getInappropriate(){
        $conn = Db::getInstance();
        $statement=$conn->prepare("SELECT count(*) AS countInapp from inappropriate where post_id=:postId");
        $statement->bindValue(":postId", $this->getPostId());
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['countInapp'];
    }
}
