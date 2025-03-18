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
        <?php echo $success; ?>
        <?php echo $error; ?>
        <p class="signin">Dont Have An Account ? <a href="/pages/signup.php">Sign Up</a> </p>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<!-- <script src="/assets/js/signup.js"></script> -->

</html>