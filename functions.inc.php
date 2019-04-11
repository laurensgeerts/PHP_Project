<?php
    function canILogin( $email, $password) {
        include_once("settings/db.php");
       // zit email in de database
       // en uw wachtwoord
       $conn = @new mysqli("localhost", "root", "root", "social");
       $sql = "SELECT * FROM users WHERE email = '".$conn->real_escape_string($email)."'";
        
       $result = $conn ->query($sql);
       if($result ->num_rows == 1){
            $user = $result->fetch_assoc();
            if( password_verify($password, $user['password'])){
                return true;
            }
       }else{
           return false;
       }
       
    }
    
?>