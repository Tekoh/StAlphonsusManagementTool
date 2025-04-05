<?php
session_start();
include __DIR__ . "/../connection.php";
include __DIR__ . "/../functions.php";

$fname = $sname = $username = $person_id = ""; // initializing variables
$error_message = "";

// Signing up the teachers, takes the teacher's details and creates a user account for them
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve submitted values
    $fname = $_POST['fname'];
    $sname = $_POST['sname'];
    $username = $_POST['username'];
    $person_id = $_POST['person_id'];
    $password = $_POST['password'];
    $reppassword = $_POST['reppassword'];

    // Check if the fields are empty
    if (!empty($fname) && !empty($sname) && !empty($username) && !empty($person_id) && !empty($password) && !empty($reppassword)) {
        // Check if the password and confirm password match
        if ($password === $reppassword) {
            // Check if the person ID exists in persons and teacher table
            $person_check_query = "SELECT * FROM persons WHERE person_id = '$person_id' AND person_id IN (SELECT person_id FROM teacher) LIMIT 1";
            $result = mysqli_query($conn, $person_check_query);

            if (mysqli_num_rows($result) > 0) {
                // Hash the password and insert the user into the database
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO users (username, person_id, password) VALUES ('$username', '$person_id', '$hashed_password')";
                mysqli_query($conn, $query);

                // Redirect to sign-in page
                header('Location: /pages/signin.php');
                die();
            } else {
                $error_message = "Person ID does not exist or is not a teacher.";
            }
        } else {
            $error_message = "Passwords do not match.";
        }
    } else {
        $error_message = "Please fill all the fields.";
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
    <link rel="stylesheet" href="/assets/css/signup.css">
</head>

<body>
    <form class="form" method="POST">
        <p class="title">Register </p>
        <p class="message">Welcome to St Alphonsus Primary School Management! Please Sign Up</p>
        <div class="flex">
            <label>
                <input class="input" type="text" placeholder="" required="" name="fname" value="<?php echo htmlspecialchars($fname); ?>">
                <span>Firstname</span>
            </label>

            <label>
                <input class="input" type="text" placeholder="" required="" name="sname" value="<?php echo htmlspecialchars($sname); ?>">
                <span>Lastname</span>
            </label>
        </div>

        <label>
            <input class="input" type="text" placeholder="" required="" name="username" value="<?php echo htmlspecialchars($username); ?>">
            <span>Username</span>
        </label>
        <label>
            <input class="input" type="text" placeholder="" required="" name="person_id" value="<?php echo htmlspecialchars($person_id); ?>">
            <span>Person ID</span>
        </label>
        <label>
            <input class="input" type="password" placeholder="" required="" name="password">
            <span>Password</span>
        </label>
        <label>
            <input class="input" type="password" placeholder="" required="" name="reppassword">
            <span>Confirm password</span>
        </label>
        <button class="submit">Submit</button>
        <p class="signin">Already have an account? <a href="/pages/signin.php">Sign In</a> </p>
        <!-- Displaying the error messages -->
        <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
        <?php endif; ?>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="/assets/js/login.js"></script>

</html>