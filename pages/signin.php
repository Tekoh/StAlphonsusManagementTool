<?php
session_start();
include __DIR__ . "/../connection.php";
include __DIR__ . "/../functions.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (!empty($username) && !empty($password)) {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: /index.php');
                die();
            } else {
                $error_message = "Invalid Username or Password";
            }
        } else {
            $error_message = "Invalid Username or Password";
        }
    } else {
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