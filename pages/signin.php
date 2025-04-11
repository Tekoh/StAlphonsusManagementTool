<?php
session_start(); // Start the session to manage user login state
include __DIR__ . "/../connection.php"; // Include the database connection file
include __DIR__ . "/../functions.php"; // Include additional helper functions

// Check if the form was submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username']; // Get the username from the form
    $password = $_POST['password']; // Get the password from the form

    // Ensure both username and password fields are filled
    if (!empty($username) && !empty($password)) {
        // Query the database to find the user with the provided username
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        // Check if a user with the given username exists
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result); // Fetch the user's data

            // Verify the provided password matches the hashed password in the database
            if (password_verify($password, $user['password'])) {
                // Store user information in the session to keep them logged in
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Redirect the user to the homepage
                header('Location: /index.php');
                die(); // Stop further script execution
            } else {
                // Set an error message if the password is incorrect
                $error_message = "Invalid Username or Password";
            }
        } else {
            // Set an error message if the username does not exist
            $error_message = "Invalid Username or Password";
        }
    } else {
        // Set an error message if any of the fields are empty
        $error_message = "Please fill all the fields";
    }
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus | Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/signin.css">
</head>

<body>
    <form class="form" method="POST">
        <p class="title">Login </p>
        <p class="message">Welcome to St Alphonsus Primary School Management! Please Sign In</p>
        <label>
            <input class="input" type="text" placeholder="" required="" name="username">
            <span>Username</span>
        </label>

        <label>
            <input class="input" type="password" placeholder="" required="" name="password">
            <span>Password</span>
        </label>
        <button class="submit">Submit</button>
        <!-- Displaying the error messages -->
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <p class="signin">Dont Have An Account ? <a href="/pages/signup.php">Sign Up</a> </p>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="/assets/js/login.js"></script>

</html>