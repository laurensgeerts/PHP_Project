<?php
    class Inapproprate{
        private $postId;
        private $userId;
        private $type;
        

        /**
         * Get the value of type
         */ 
        public function getType()
        {
                return $this->type;
        }

        /**
         * Set the value of type
         *
         * @return  self
         */ 
        public function setType($type)
        {
                $this->type = $type;

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

        public function setInappropriate(){
            $conn = Db::getInstance();
            $statement=$conn->prepare("SELECT count(*) as countInapp from inappropriate where post_id=:postId AND `user_id`=:userId");
            $statement->bindValue(":postId", $this->getPostId());
            $statement->bindValue(":userId", $this->getUserId());
            $statement->execute();
            $stm=$statement->fetch(PDO::FETCH_OBJ);
            return $stm->countInapp;
    
            if($stm->countInapp==0){
                $result = $conn->prepare("INSERT into inappropriate (post_id, `user_id`, `type`, date_created) VALUES (:postid, :userid, :type ,NOW())");
                $result->bindValue(":postid", $this->getPostId());
                $result->bindValue(":userid", $this->getUserId());
                $result->bindValue(":type", $this->getType());
                return $result->execute();
            } else{
                $result=$conn->prepare("UPDATE inappropriate set `type`=:type where post_id=:postId AND `user_id`=:userId");
                $result->bindValue(":postId", $this->getPostId());
                $result->bindValue(":userId", $this->getUserId());
                $result->bindValue(":type", $this->getType());
                return $result->execute();
            }
            var_dump($result);
                
        }
    }
?>