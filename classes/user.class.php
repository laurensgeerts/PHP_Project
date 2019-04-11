<?php

class User{
    private $email;
    private $password;
    private $firstname;
    private $lastname;

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

    // registers user into database and @return true if successful, @return false if unsuccessful
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

        // antwoord geven (true or false)
    }

    //maakt een usersessie aan en redirects naar de index page
    public function login(){
        session_start();
        $_SESSION['username'] = $this->email;
        header('Location: index.php');
    }

}