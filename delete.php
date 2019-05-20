<?php

include_once 'bootstrap.php';

$id = $_GET['id'];

$post = new Post();
$post->delete($id);
header('Location: index.php');
?>