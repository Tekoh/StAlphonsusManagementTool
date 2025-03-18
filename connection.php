<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "stalphonsusdb";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("Connection To $dbname Failed!". mysqli_connect_error());
}