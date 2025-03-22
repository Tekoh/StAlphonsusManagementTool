<?php
session_start();
include __DIR__ . "/../connection.php";
include __DIR__ . "/../functions.php";
$_SESSION;
$user_data = signin_check($conn);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus | Class Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/classinfo.css">
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
                    <a class="nav-link" href="/index.php">Home</a>
                    <a class="nav-link" href="/pages/records.php">View Records</a>
                    <a class="nav-link" href="/pages/registration.php">Registration</a>
                    <a class="nav-link active" href="/pages/classinfo.php">Class Information</a>
                    <a class="nav-link" href="/pages/library.php">Library</a>
                </div>
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="/pages/signout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="radio-inputs">
        <label class="radio">
            <input type="radio" name="tableOption" checked="" value="teacher">
            <span class="name">Teachers</span>
        </label>
        <label class="radio">
            <input type="radio" name="tableOption" value="student">
            <span class="name">Students</span>
        </label>
        <label class="radio">
            <input type="radio" name="tableOption" value="ca">
            <span class="name">Class Assistant</span>
        </label>

    </div>
    
    <form method="GET" action="" class="d-flex justify-content-center my-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by name"
            value="<?php echo $_GET['search'] ?? ''; ?>">
        <button type="submit" class="btn btn-primary me-2">Search</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='classinfo.php'">Reset</button>
    </form>
    <div class="teacher d-flex justify-content-center">
        <table class="table table-bordered table-striped " id="teacher">
            <thead>
                <tr>
                    <th>Teacher ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Hours</th>
                    <th>Class</th>
                </tr>
                <?php
                $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                $query = "SELECT t.teacher_id, p.first_name, p.last_name, t.hours, c.grade_level 
                          FROM teacher t 
                          JOIN persons p ON t.person_id = p.person_id
                          JOIN class c ON t.teacher_id = c.teacher_id
                          WHERE p.first_name LIKE '%$search%' 
                          OR p.last_name LIKE '%$search%' 
                          OR t.hours LIKE '%$search%' 
                          OR c.grade_level LIKE '%$search%'";
                $result = $conn->query($query);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['teacher_id']}</td>
                                <td>{$row['first_name']}</td>
                                <td>{$row['last_name']}</td>
                                <td>{$row['hours']}</td>
                                <td>{$row['grade_level']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }
                ?>
        </table>
    </div>
    <div class="student d-flex justify-content-center">
        <table class="table table-bordered table-striped" id="student">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Subject</th>
                    <th>Class</th>
                    <th>Teacher</th>
                </tr>
                <?php
                $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                $query = "SELECT s.student_id, p.first_name, p.last_name, s.subject, c.grade_level, t.teacher_id 
                          FROM student s 
                          JOIN persons p ON s.person_id = p.person_id
                          JOIN class c ON s.class_id = c.class_id
                          JOIN teacher t ON c.teacher_id = t.teacher_id
                          WHERE p.first_name LIKE '%$search%' 
                          OR p.last_name LIKE '%$search%' 
                          OR s.subject LIKE '%$search%' 
                          OR c.grade_level LIKE '%$search%' 
                          OR t.teacher_id LIKE '%$search%'";
                $result = $conn->query($query);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['student_id']}</td>
                                <td>{$row['first_name']}</td>
                                <td>{$row['last_name']}</td>
                                <td>{$row['subject']}</td>
                                <td>{$row['grade_level']}</td>
                                <td>{$row['teacher_id']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }
                ?>
        </table>
    </div>
    <div class="ca d-flex justify-content-center">
        <table class="table table-bordered table-striped" id="ca">
            <thead>
                <tr>
                    <th>Assistant ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Class</th>
                </tr>
                <?php
                $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                $query = "SELECT a.assistant_id, p.first_name, p.last_name, c.grade_level 
                          FROM class_assistant ca 
                          JOIN assistant a ON ca.assistant_id = a.assistant_id
                          JOIN persons p ON a.person_id = p.person_id
                          JOIN class c ON ca.class_id = c.class_id
                          WHERE p.first_name LIKE '%$search%' 
                          OR p.last_name LIKE '%$search%' 
                          OR c.grade_level LIKE '%$search%'";
                $result = $conn->query($query);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['assistant_id']}</td>
                                <td>{$row['first_name']}</td>
                                <td>{$row['last_name']}</td>
                                <td>{$row['grade_level']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
                }
                ?>
        </table>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="/assets/js/classinfo.js"></script>
</html>