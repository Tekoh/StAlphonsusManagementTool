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
    <title>St Alphonsus | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/attendance.css">
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
                    <a class="nav-link" href="/pages/classinfo.php">Class Information</a>
                    <a class="nav-link" href="/pages/library.php">Library</a>
                    <a class="nav-link active" href="/pages/attendance.php">Attendance</a>
                </div>
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="/pages/signout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="radio-inputs">
        <label class="radio">
            <input type="radio" name="tableOption" checked="" value="t">
            <span class="name">Teachers</span>
        </label>
        <label class="radio">
            <input type="radio" name="tableOption" value="st">
            <span class="name">Students</span>
        </label>
        <label class="radio">
            <input type="radio" name="tableOption" value="ca">
            <span class="name">Class Assistant</span>
        </label>
    </div>
    <div class="container mt-4">
        <form method="GET" action="" class="d-flex justify-content-center my-3">
            <input type="date" name="searchDate" class="form-control me-2" placeholder="Search by date"
                value="<?php echo $_GET['searchDate'] ?? ''; ?>">
            <button type="submit" class="btn btn-primary me-2">Search</button>
            <button type="button" class="btn btn-secondary"
                onclick="window.location.href='attendance.php'">Reset</button>
        </form>
        <form method="GET" action="" class=" d-flex justify-content-center my-3">
            <input type="text" name="search" class="form-control me-2" placeholder="Search by name"
                value="<?php echo $_GET['search'] ?? ''; ?>">
            <button type="submit" class="btn btn-primary me-2">Search</button>
            <button type="button" class="btn btn-secondary"
                onclick="window.location.href='attendance.php'">Reset</button>
        </form>
        <?php
        if (isset($_GET['searchDate']) && $_GET['searchDate'] <= date('Y-m-d')) {
            $searchDate = $_GET['searchDate'];
            $query = "SELECT * FROM attendance_teacher WHERE attendance_date = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $searchDate);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 0) {
                // If no records found, create attendance records for all teachers
                $teacherQuery = "SELECT teacher_id FROM teacher";
                $teacherResult = $conn->query($teacherQuery);
                while ($teacherRow = $teacherResult->fetch_assoc()) {
                    $insertQuery = "INSERT INTO attendance_teacher (teacher_id, attendance_date, attendance_status, marks) VALUES (?, ?, 'Pending', '')";
                    $insertStmt = $conn->prepare($insertQuery);
                    $insertStmt->bind_param("is", $teacherRow['teacher_id'], $searchDate);
                    $insertStmt->execute();
                }
                // Re-execute the query to get the newly inserted records
                $stmt->execute();
                $result = $stmt->get_result();
            }
        } else {
            $query = "SELECT * FROM attendance_teacher";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        ?>

        <table class="table table-bordered table-striped" id="t">
            <thead>
                <tr>
                    <th>Attendance ID</th>
                    <th>Teacher ID</th>
                    <th>Attendance Date</th>
                    <th>Attendance Status</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['attendance_id']; ?></td>
                        <td><?php echo $row['teacher_id']; ?></td>
                        <td><?php echo $row['attendance_date']; ?></td>
                        <td>
                            <form method='POST' action=''>
                                <input type='hidden' name='attendance_id' value='<?php echo $row['attendance_id']; ?>'>
                                <select class='form-select' name='attendance_status' onchange='this.form.submit()'>
                                    <option value='Present' <?php echo $row['attendance_status'] == 'Present' ? 'selected' : ''; ?>>Present</option>
                                    <option value='Absent' <?php echo $row['attendance_status'] == 'Absent' ? 'selected' : ''; ?>>Absent</option>
                                    <option value='Leave' <?php echo $row['attendance_status'] == 'Leave' ? 'selected' : ''; ?>>Leave</option>
                                    <option value='Pending' <?php echo $row['attendance_status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form method='POST' action=''>
                                <input type='hidden' name='attendance_id' value='<?php echo $row['attendance_id']; ?>'>
                                <input type='text' class='form-control' name='marks' value='<?php echo $row['marks']; ?>' onchange='this.form.submit()'>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <table class="table table-bordered table-striped" id="st">

        </table>
        <table class="table table-bordered table-striped" id="ca">

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

</html>