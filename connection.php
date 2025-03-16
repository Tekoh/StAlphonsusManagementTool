<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "stalphonsusdb";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("". mysqli_connect_error());
}