<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '-1');

include_once 'classes/post.class.php';
include_once 'classes/user.class.php';
include_once 'classes/comment.class.php';

session_start();

if ($_SESSION['loggedin'] == false) {
    header('Location: login.php');
}
