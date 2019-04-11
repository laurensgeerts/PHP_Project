<?php

class Db {
    private static $conn;

    //@return PDO connection
    // ->if exists ->return existing 
    // ->if !exists ->return new PDO conn
    public static function getInstance(){

        include_once("settings/db.php");
        // self ipv $this
        if( self::$conn == null){
            self::$conn = new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'].''  , $db['username'], $db['password'] );
            //echo "connectie";
            return self::$conn;
            
        }else{
            return self::$conn;
            //echo "geen connectie";
        }
    }
}