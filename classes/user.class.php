<?php

class User{
<<<<<<< HEAD
<<<<<<< HEAD
   
=======
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
=======
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
    private $email;
    private $password;
    private $firstname;
    private $lastname;
<<<<<<< HEAD
<<<<<<< HEAD
    private $bio;
    private $image;
    private $user_id;
    private $password_update;
    private $ImageName;
    private $ImageSize;
    private $ImageTmpName;




  
=======

=======

>>>>>>> parent of 1d6c9b2... register en login zijn in orde
    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {   if(empty($email)){
        throw new Exception("email fout");
    }
    //todo valid emai? -> filter_var()
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {

        $this->password = $password;

        return $this;
    }

        /**
     * Set the value of firstname
     *
     * @return  self
     */ 
<<<<<<< HEAD
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
=======
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
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

<<<<<<< HEAD
<<<<<<< HEAD

 
  


    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        if(strlen($password) < 6){
            throw new Exception("Password must be at least 6 characters");
        }

        //  PASSWORD_DEFAULT
        $hash = password_hash( $password, PASSWORD_DEFAULT);
        $this->password = $hash;
        return $this;
    }

  
    
    /*
        sign up a new user
        @return true if succesfull
        @return 
    */
=======
    // registers user into database and @return true if successful, @return false if unsuccessful
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
=======
    // registers user into database and @return true if successful, @return false if unsuccessful
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
    public function register(){
        // connectie
        $conn = new PDO('mysql:host=localhost; dbname=netflix', 'root', 'root');
        // query (sql injectie)
        $statement =$conn-> prepare("insert into users (email, password, firstname, lastname) values (:email, :password, :firstname, :lastname);");
        $hash = password_hash($this->password, PASSWORD_BCRYPT);
        $statement->bindParam(":email",$this->email);
        $statement->bindParam(":firstname",$this->firstname);
        $statement->bindParam(":lastname",$this->lastname);

        
        $statement->bindParam(":password" , $hash);
        //execute
        $result = $statement->execute();
        return $result;

<<<<<<< HEAD
<<<<<<< HEAD
     /* check if email and password occur in database
     * @return true if successful
     * @return false if not sucessful
     */
    function canILogin( $email, $password) {
        
        $conn = Db::getInstance();

       
        $statement = $conn->prepare("select * from users where email = :email");
        $statement->bindParam(':email', $email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        
       
        $passwordHash = $result->password;

        
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
   

  
     public function getInfo() {
       
        $conn = Db::getInstance();

        
        $statement = $conn->prepare("SELECT * FROM users WHERE id = :user_id LIMIT 1");
        $statement->bindParam(":user_id", $this->user_id);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
}
=======
        // antwoord geven (true or false)
    }
>>>>>>> parent of 1d6c9b2... register en login zijn in orde

    //maakt een usersessie aan en redirects naar de index page
    public function login(){
        session_start();
        $_SESSION['username'] = $this->email;
        header('Location: index.php');
    }

<<<<<<< HEAD
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

    public function update() {
        
        $conn = Db::getInstance();

        
        

  
        $statement = $conn->prepare("UPDATE users SET email=:email,firstname = :firstname,lastname=:lastname,bio=:bio,image=:image WHERE id = :user_id");
        $statement->bindParam(":email", $this->email);
        $statement->bindParam(":user_id", $this->user_id);
        $statement->bindParam(":firstname", $this->firstname);
        $statement->bindParam(":lastname", $this->lastname);
       
        $statement->bindParam(":bio", $this->bio);
        $statement->bindParam(":image", $this->image);
        $statement->execute();
        return $statement;
}

public function updatePassword() {
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE users SET password = :password WHERE id = :user_id");
        $statement->bindParam(":user_id", $this->user_id);
        $statement->bindParam(":password", $this->password);
        $statement->execute();
        return $statement;    
}


    /**
     * Get the value of password_update
     */ 
    public function getPassword_update()
    {
        return $this->password_update;
    }

    /**
     * Set the value of password_update
     *
     * @return  self
     */ 
    public function setPassword_update($password_update)
    {
        $this->password_update = $password_update;

        return $this;
    }

    /**
     * Get the value of ImageName
     */ 
    public function getImageName()
    {
        return $this->ImageName;
    }

    /**
     * Set the value of ImageName
     *
     * @return  self
     */ 
    public function setImageName($ImageName)
    {
        $this->ImageName = $ImageName;

        return $this;
    }

    /**
     * Get the value of ImageSize
     */ 
    public function getImageSize()
    {
        return $this->ImageSize;
    }

    /**
     * Set the value of ImageSize
     *
     * @return  self
     */ 
    public function setImageSize($ImageSize)
    {
        $this->ImageSize = $ImageSize;

        return $this;
    }

    /**
     * Get the value of ImageTmpName
     */ 
    public function getImageTmpName()
    {
        return $this->ImageTmpName;
    }

    /**
     * Set the value of ImageTmpName
     *
     * @return  self
     */ 
    public function setImageTmpName($ImageTmpName)
    {
        $this->ImageTmpName = $ImageTmpName;

        return $this;
    }

    public function SaveProfileImg() {
        $file_name = $_SESSION['user_id'] . "-" . time() . "-" . $this->ImageName;
        $file_size = $this->ImageSize;
        $file_tmp = $this->ImageTmpName;
        $tmp = explode('.', $file_name);
        $file_ext = end($tmp);
        $expensions = array("jpeg", "jpg", "png", "gif");

        if (in_array($file_ext, $expensions) === false) {
                throw new Exception("kies uit jpeg jpg png gif.");
        }

        if ($file_size > 2097152) {
                throw new Exception('file mag niet meer zijn dan 2M');
        }

        if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "data/profiel/" . $file_name);
                return "data/profiel/" . $file_name;
        } else {
                echo "Error";
        }
}

    /**
     * Get the value of user_id
     */ 
  

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function emailExists($email)
    {
    $conn = Db::getInstance();
    $statement = $conn->prepare("select * from users where email = :email");
    $statement->bindParam(":email", $email);
    $statement->execute();
    $count = $statement->rowCount();
    if ($count > 0) {
       return true;
    }
    else {
        return false;
    }
}


    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
<<<<<<< HEAD

    public function searchProfile($searchProfile){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM users WHERE CONCAT(firstname, ' ', lastname) LIKE '%$searchProfile%' OR  firstname LIKE '%$searchProfile%' OR lastname  LIKE '%$searchProfile%' ");
        $statement->bindValue(1, "%$searchProfile%", PDO::PARAM_STR);
        $statement->execute();
        
        return  $statement->fetchAll(PDO::FETCH_CLASS, "User");
     }

=======
=======
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
=======
        // antwoord geven (true or false)
    }

    //maakt een usersessie aan en redirects naar de index page
    public function login(){
        session_start();
        $_SESSION['username'] = $this->email;
        header('Location: index.php');
    }

>>>>>>> parent of 1d6c9b2... register en login zijn in orde
>>>>>>> 4aa116691bcdfa4da10ba6a4806c5b5ee7a30712
}