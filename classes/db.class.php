<?php

class Db {
    private static $conn;

<<<<<<< HEAD
<<<<<<< HEAD
        public static function getInstance(){
            if( self::$conn == null ){
                self::$conn = new PDO('mysql:host=localhost;dbname=PHPInspHunter', 'root', 'root', null);
                return self::$conn;
            } else {
                return self::$conn;
            }
=======
=======
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
    //@return PDO connection
    // ->if exists ->return existing 
    // ->if !exists ->return new PDO conn
    public static function getConnection(){

        include_once("settings/db.php");
        // self ipv $this
        if( self::$conn == null){
            self::$conn = new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'].''  , $db['username'], $db['password'] );
            //echo "yaaassss";
            return self::$conn;
            
        }else{
            return self::$conn;
            //echo "falsessss";
<<<<<<< HEAD
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
=======
>>>>>>> parent of 1d6c9b2... register en login zijn in orde
        }
    }
}