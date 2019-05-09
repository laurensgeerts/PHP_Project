<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include_once 'classes/post.class.php';
include_once 'classes/user.class.php';
include_once 'classes/comment.class.php';


if ($_SESSION['loggedin'] == false) {
    header('Location: login.php');
}
