<?php 

// Function to check if the user is logged in
function signin_check($conn)
{
    //simple if statement to check if the username set in the session is present in the database
    if (isset($_SESSION['username'])){
        $id = $_SESSION['username'];
        //SQL query to select the user from the database
        $query = "SELECT * FROM users WHERE username = '$id' limit 1 ";
        //checking if the username exits in the database
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    //if the user is not logged in, redirect to the sign up page
    header("Location: /pages/signup.php");
    die;
}