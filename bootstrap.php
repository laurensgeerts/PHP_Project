<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'classes/post.class.php';
include_once 'classes/user.class.php';
include_once 'classes/comment.class.php';
//include_once 'ajax/postlike.php';

session_start();

if ($_SESSION['loggedin'] == false) {
    header('Location: login.php');
}
