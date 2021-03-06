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
    public $filter;


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

    /**
     * Get the value of filter
     */ 
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * Set the value of filter
     *
     * @return  self
     */ 
    public function setFilter($filter)
    {
        $this->filter = $filter;

        return $this;
    }

    public function newPost(){
        $conn = Db::getInstance();
        $statement = $conn->prepare('INSERT INTO posts (`user_id`, `description`, `image`, `city`, `lng`, `lat`, `hashtag1`, `hashtag2`, `hashtag3`, `date_created`) 
        values (:userid, :description, :image, :city, :lng, :lat, :hashtag1, :hashtag2, :hashtag3, NOW())');
        $statement->bindValue(':userid', $this->getUserId());
        $statement->bindValue(':description', $this->getDescription());
        $statement->bindValue(':image', $this->getImage());
        $statement->bindValue(':city', $this->getCity());
        $statement->bindValue(':lng', floatval($this->getLng()));
        $statement->bindValue(':lat', floatval($this->getLat()));
        $statement->bindValue(':hashtag1', $this->getHashtag1());
        $statement->bindValue(':hashtag2', $this->getHashtag2());
        $statement->bindValue(':hashtag3', $this->getHashtag3());
        //$statement->bindValue(':filter', $this->getFilter());
        return $statement->execute();
    }

    
    public static function getAll($ids, $start, $end)
    {
        $conn = Db::getInstance();
        $result = $conn->prepare(
            'SELECT posts.*, users.firstname, users.lastname, users.picture
            FROM posts INNER JOIN users
            ON posts.user_id = users.id
            WHERE
            posts.user_id IN 
                (
                SELECT follow_to FROM followers WHERE follow_from = '.$ids.'
                )
            ORDER BY posts.date_created desc
            LIMIT '.$start.' OFFSET '.$end
    );
        $result->execute();

        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }
    // public static function getAll()
    // {
    //     $conn = Db::getInstance();
    //     $result = $conn->query('SELECT posts.*,users.firstname,users.lastname, users.picture FROM posts,users WHERE posts.user_id=users.id ');

    //     return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    // }

    // public static function getThisPost($id){
    //     $conn = Db::getInstance();
    //     $statement = $conn->query("SELECT posts.*,users.firstname,users.lastname,users.picture FROM posts,users WHERE posts.id=:id AND posts.user_id=users.id ");
    //     $statement->bindValue(":id",$id);
    //     return $result=$statement->fetch(PDO::FETCH_ASSOC);
    // }
   

    public static function timeConverter($timeCalc)
    {
        //Verschil huidig tijdstip en tijdstip post
        $calculated_time = time() - $timeCalc;

        if ($calculated_time < 1) {
            return 'Uploaded just now.';
        }

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

                return $roundC.' '.$str.($roundC > 1 ? 's' : '').' ago.';
            }
        }
    }

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

    public static function checkLike($postId, $userId){
        $conn = Db::getInstance();
        $state=$conn->prepare("SELECT count(*) As checkLike from likes where post_id=:postid and `user_id`=:userid");
        $state->bindParam(":postid", $postId);
        $state->bindParam(":userid", $userId);
        $state->execute();
        $stm = $state->fetch(PDO::FETCH_OBJ);

        if($stm->checkLike==1){
        $statement=$conn->prepare("SELECT * from likes where post_id=:postid and `user_id`=:userid");
        $statement->bindParam(":postid", $postId);
        $statement->bindParam(":userid", $userId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result->type;
        } else if($stm->checkLike==0){
            $type=0;
            return $type;
        }
    }

    public static function getLikes($postId){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT count(*) AS countLikes FROM likes WHERE post_id=:postid AND `type`=1");
        $statement->bindValue(":postid", $postId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['countLikes'];
    }

    public function getInappropriate(){
        $conn = Db::getInstance();
        $statement=$conn->prepare("SELECT count(*) AS countInapp from inappropriate where post_id=:postId");
        $statement->bindValue(":postId", $this->getPostId());
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['countInapp'];
    }

    public static function getallPostDetail($id, $user_id)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('SELECT posts.*,users.firstname,users.lastname, users.picture FROM posts,users WHERE posts.user_id = :user_id AND users.id=  :id ');
        $statement->bindValue(":id",$id);
        $statement->bindValue(":user_id",$user_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }


    public function delete($id, $user_id){

        $conn = Db::getInstance();
        $statement =$conn->prepare("DELETE FROM posts  WHERE user_id = :user_id AND  id =  :id ");
        $statement->bindValue(':id', $id);
        $statement->bindValue(":user_id",$user_id);
        $statement->execute();
}

public  function getPostInfoDetail($id)
{
   
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM posts WHERE id =:id");
        $statement->bindParam(":id",$id);
        $statement->execute();
        $result = $statement->fetch();
        return $result;

    
}

public function updatePosts($id, $user_id)



    {
       
        $conn = Db::getInstance();
       
        $statement = $conn->prepare("UPDATE posts SET description = :description ,hashtag1 = :hashtag1,hashtag2=:hashtag2, hashtag3=:hashtag3 WHERE user_id = :user_id AND  id=  :id ");
        $statement->bindValue(':description', $this->getDescription());
        $statement->bindValue(':hashtag1', $this->getHashtag2());
        $statement->bindValue(':hashtag2', $this->getHashtag2());
        $statement->bindValue(':hashtag3', $this->getHashtag3()  );
        $statement->bindValue(":id",$id);
        $statement->bindValue(":user_id",$user_id);

       
        $statement->execute();
        return $statement;
}

    
}
