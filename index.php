<?php
session_start();
include __DIR__ . "/connection.php";
include __DIR__ . "/functions.php";
$_SESSION;
$user_data = signin_check($conn);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/index.php">St Alphonsus</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" href="/index.php">Home</a>
                    <a class="nav-link" href="/pages/records.php">View Records</a>
                    <a class="nav-link" href="/pages/registration.php">Registration</a>
                    <a class="nav-link" href="/pages/classinfo.php">Class Information</a>
                    <a class="nav-link" href="/pages/library.php">Library</a>
                    <a class="nav-link " href="/pages/attendance.php">Attendance</a>
                </div>
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="/pages/signout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center">Welcome to St Alphonsus</h1>
        <p class="text-center">
            Stay updated on records, registration, class info, and more. Manage everything in one place.
        </p>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
            <div class="col">
                <div class="card h-100">
                    <img src="https://cdn.prod.website-files.com/62045da4270c887c4de9c45f/62080090f9b2b85ec9298118_iStock-1303715147.jpg" class="card-img-top" alt="Records" style="width: 100%; height: 200px; object-fit: cover;">
                    <div class="card-header">Records</div>
                    <div class="card-body">
                        <p class="card-text">View and manage student records effortlessly.</p>
                        <a href="/pages/records.php" class="btn btn-primary">Go</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="https://www.nationalwillregister.co.uk/app/uploads/2021/07/Register-a-Will-Landscape-960x540-c-default.jpg" class="card-img-top" alt="Registration" style="width: 100%; height: 200px; object-fit: cover;">
                    <div class="card-header">Registration</div>
                    <div class="card-body">
                        <p class="card-text">Enroll students and edit registration details.</p>
                        <a href="/pages/registration.php" class="btn btn-primary">Go</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="https://www.thechecker.net/hubfs/images/information_at_fingertips.jpg" class="card-img-top" alt="Class Info" style="width: 100%; height: 200px; object-fit: cover;">
                    <div class="card-header">Class Info</div>
                    <div class="card-body">
                        <p class="card-text">Access information on schedules and teachers.</p>
                        <a href="/pages/classinfo.php" class="btn btn-primary">Go</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/SanDiegoCityCollegeLearningResource_-_bookshelf.jpg/1200px-SanDiegoCityCollegeLearningResource_-_bookshelf.jpg" class="card-img-top" alt="Library" style="width: 100%; height: 200px; object-fit: cover;">
                    <div class="card-header">Library</div>
                    <div class="card-body">
                        <p class="card-text">Access library information.</p>
                        <a href="/pages/library.php" class="btn btn-primary">Go</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="https://worldscholarshipforum.com/wp-content/uploads/2023/10/Does-Authorised-Absence-Affect-Attendance-Percentage.jpg" class="card-img-top" alt="Attendance" style="width: 100%; height: 200px; object-fit: cover;">
                    <div class="card-header">Attendance</div>
                    <div class="card-body">
                        <p class="card-text">Mark Student Attendance.</p>
                        <a href="/pages/attendance.php" class="btn btn-primary">Go</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <footer class="bg-dark text-white py-3 mt-4">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col">   
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="/index.php" class="text-white">Home</a></li>
                        <li><a href="/pages/records.php" class="text-white">Records</a></li>
                        <li><a href="/pages/registration.php" class="text-white">Registration</a></li>
                        <li><a href="/pages/classinfo.php" class="text-white">Class Information</a></li>
                        <li><a href="/pages/library.php" class="text-white">Library</a></li>
                    </ul>
                </div>
                <div class="col text-end align-self-center">
                    © St Alphonsus 2025
                </div>
            </div>
        </div>
    </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>

