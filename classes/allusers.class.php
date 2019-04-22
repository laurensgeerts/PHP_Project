<?php
include_once('db.class.php');

if($_POST['action'] == 'fetch_user')
{
    $query = "
    SELECT * FROM users
    WHERE id != '".$_SESSION["user_id"]."' 
    ORDER BY id DESC 
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    $output .= '
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-8">
            <h4><b>@'.$row["email"].'</b></h4>

            <span class="label label-succes">
                Followers</span>
        </div>
    </div>
    <hr/>
    ';
}
?>