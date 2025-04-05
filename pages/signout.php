<?php
session_start();
// check if the username is set / logged in
if(isset($_SESSION['username'])){
    // Unset the session username
    unset($_SESSION['username']);
}
// return to index
header('Location: /index.php');
die;