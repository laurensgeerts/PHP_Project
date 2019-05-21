<?php

include_once 'bootstrap.php';

$id = $_GET['id'];
$user_id = $_SESSION['user_id']; 

$post = new Post();
$post->delete($id, $user_id);
header('Location: index.php');
?>