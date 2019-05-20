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

    public static function getAll($UsId)
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

    /*  public function searchPost($searchPost)
      {
          $conn = Db::getInstance();
          $statement = $conn->prepare("SELECT * FROM posts WHERE description LIKE '%$searchPost%'  ");
          $statement->bindValue(1, "%$searchPost%", PDO::PARAM_STR);
          $statement->execute();

          return  $statement->fetchAll(PDO::FETCH_CLASS, __CLASS__);
      }
    */

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

                return 'Uploaded about '.$roundC.' '.$str.($roundC > 1 ? 's' : '').' ago.';
            }
        }
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
