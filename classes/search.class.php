<?php

include_once 'db.class.php';

class Search
{
    public static function searchPost($searchPost){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT posts.*,users.firstname,users.lastname, users.picture 
        FROM posts,users WHERE posts.user_id=users.id AND (posts.description    LIKE '%$searchPost%' OR posts.hashtag1 LIKE
         '%$searchPost%' OR posts.hashtag2 LIKE
         '%$searchPost%' OR posts.hashtag3 LIKE
         '%$searchPost%' OR CONCAT(users.firstname, ' ', users.lastname) 
        LIKE '%$searchPost%' OR  users.firstname LIKE '%$searchPost%' OR users.lastname  LIKE '%$searchPost%')");
        $statement->bindValue(1, "%$searchPost%", PDO::PARAM_STR);
        $statement->execute();
        
        return  $statement->fetchAll(PDO::FETCH_CLASS, __CLASS__);


}


public static function searchLocation($lat, $lng) {

    $conn = Db::getInstance();
    $latt = floatval($lat);
    $long = floatval($lng);
    $statement = $conn->prepare("SELECT posts.*,users.firstname,users.lastname,users.picture, ( 6371 * acos( cos( radians(:lat) ) * cos( radians( lat ) ) *
     cos( radians( lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( lat ) ) ) ) 
    AS distance FROM posts,users WHERE posts.user_id=users.id HAVING distance < 5 ORDER BY distance");
    $statement->bindValue(':lat', $latt);
    $statement->bindValue(':lng', $long);
    $statement->execute();
    //$result = $statement->fetchAll();
return $statement->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    
}
}