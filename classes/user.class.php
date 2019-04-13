<?php

include_once('db.class.php');

class User{
    private $id;
    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $bio;
    private $image;

  
    public function getEmail()
    {
        return $this->email;
    }

    public function setFirstname($firstname)
    {   if(empty($firstname)){
        throw new Exception("firstname fout");
    }
    //todo valid emai? -> filter_var()
        $this->firstname = $firstname;
        return $this;
    }
    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }
        /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {   if(empty($lastname)){
        throw new Exception("lastname fout");
    }
    //todo valid emai? -> filter_var()
        $this->lastname = $lastname;
        return $this;
    }
    /**
     * Get the value of firstname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }


 
    public function setEmail($email) {     
        if(empty($email)){
            throw new Exception("Email cannot be empty");
        }

        
        $this->email = $email;
        return $this;
    }



    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        if(strlen($password) < 4){
            throw new Exception("Password must be at least 6 characters");
        }

        // PASSWORD_BCRYPT of PASSWORD_DEFAULT voor encryptie van password
        $hash = password_hash( $password, PASSWORD_DEFAULT);
        $this->password = $hash;
        return $this;
    }

  
    
    /*
        sign up a new user
        @return true if succesfull
        @return 
    */
    public function register(){
        //connectie
        $conn = Db::getInstance();
        
        // query (insert)
        $statement =$conn-> prepare("insert into users (email, password, firstname, lastname) values (:email, :password, :firstname, :lastname);");
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':password', $this->password);
        $statement->bindParam(":firstname",$this->firstname);
        $statement->bindParam(":lastname",$this->lastname);
        $result = $statement->execute();
     
        //return true/false
        return $result;
    }

     /* check if email and password occur in database
     * @return true if successful
     * @return false if not sucessful
     */
    function canILogin( $email, $password) {
        //connectie met database
        $conn = Db::getInstance();

        //zitten email en wachtwoord in de database 
        $statement = $conn->prepare("select * from users where email = :email");
        $statement->bindParam(':email', $email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        $passwordHash = $result->password;

        //controleren of password juist is
        if (password_verify($password, $passwordHash)) {
            return true;
        } else {
            return false;
        }

     }
   

  
    public function getUserId($email){
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from users where email = :email");
        $statement->bindParam(':email', $email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result->id;

   }

    public function fetchUserId($email){
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from users where email = :email");
        $statement->bindParam(':email', $email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result->id;
    }


    /**
     * Get the value of id
     */ 
   
    /**
     * Get the value of bio
     */ 
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set the value of bio
     *
     * @return  self
     */ 
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }
}