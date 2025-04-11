<?php
// Define the database host (usually 'localhost' for local development)
$dbhost = "localhost";

// Define the database username (default is 'root' for local development)
$dbuser = "root";

// Define the database password (empty string for local development by default)
$dbpass = "";

// Define the name of the database you want to connect to
$dbname = "stalphonsusdb";

// Create a new connection to the database using the mysqli object
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check if the connection was successful
if (!$conn) {
    // If the connection fails, display an error message and stop the script
    die("Connection To $dbname Failed!". mysqli_connect_error());
}