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
    <?php
    // Initialize variables
    $selectedType = $_GET['selectType'] ?? 'student';
    $attendanceDate = $_GET['attendanceDate'] ?? date('Y-m-d');
    $searchName = $_GET['searchName'] ?? '';
    $classOption = $_GET['classOption'] ?? 'CLR-00001';

    // Handle form submission to save attendance
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['attendance'])) {

        
        foreach ($_POST['attendance'] as $id => $data) {
            $status = $data['status'] ?? 'Absent';
            $remarks = $data['remarks'] ?? 'No remarks';

            if ($selectedType === 'student') {
                $query = "INSERT INTO attendance_student (student_id, attendance_date, attendance_status, remarks)
                          VALUES (?, ?, ?, ?)
                          ON DUPLICATE KEY UPDATE attendance_status = ?, remarks = ?";
            } elseif ($selectedType === 'teacher') {
                $query = "INSERT INTO attendance_teacher (teacher_id, attendance_date, attendance_status, remarks)
                          VALUES (?, ?, ?, ?)
                          ON DUPLICATE KEY UPDATE attendance_status = ?, remarks = ?";
            } else {
                $query = "INSERT INTO attendance_assistant (assistant_id, class_id, attendance_date, attendance_status, remarks)
                          VALUES (?, ?, ?, ?, ?)
                          ON DUPLICATE KEY UPDATE attendance_status = ?, remarks = ?";
            }

            if ($selectedType === 'student' || $selectedType === 'teacher') {
                $stmt = $conn->prepare($query);
                if ($stmt) {
                    if (!$stmt->bind_param('ssssss', $id, $attendanceDate, $status, $remarks, $status, $remarks)) {
                        error_log("Binding parameters failed: {$stmt->error}");
                    } elseif (!$stmt->execute()) {
                        echo $stmt->error;
                        error_log("Execution failed: {$stmt->error}");
                    }
                    $stmt->close();
                } else {
                    error_log("Failed to prepare statement: {$conn->error}");
                }
            } elseif ($selectedType === 'assistant') {
                $stmt = $conn->prepare($query);
                if ($stmt) {
                    if (!$stmt->bind_param('sssssss', $id, $classOption, $attendanceDate, $status, $remarks, $status, $remarks)) {
                        error_log("Binding parameters failed: {$stmt->error}");
                    } elseif (!$stmt->execute()) {
                        echo $stmt->error;
                        error_log("Execution failed: {$stmt->error}");
                    }
                    $stmt->close();
                } else {
                    error_log("Failed to prepare statement: {$conn->error}");
                }
            }
            
        }
    }

    // Fetch attendance records based on selected type and filters
    $records = [];
    if ($selectedType === 'student') {
        $query = "SELECT s.student_id AS id, CONCAT(p.first_name, ' ', p.last_name) AS name, 
                         COALESCE(a.attendance_status, 'Absent') AS status, a.remarks
                  FROM student s
                  JOIN persons p ON s.person_id = p.person_id
                  LEFT JOIN attendance_student a ON s.student_id = a.student_id AND a.attendance_date = ?
                  WHERE s.class_id = ? AND CONCAT(p.first_name, ' ', p.last_name) LIKE ?";
    } elseif ($selectedType === 'teacher') {
        $query = "SELECT t.teacher_id AS id, CONCAT(p.first_name, ' ', p.last_name) AS name, 
                         COALESCE(a.attendance_status, 'Absent') AS status, a.remarks
                  FROM teacher t
                  JOIN persons p ON t.person_id = p.person_id
                  LEFT JOIN attendance_teacher a ON t.teacher_id = a.teacher_id AND a.attendance_date = ?
                  WHERE CONCAT(p.first_name, ' ', p.last_name) LIKE ?";
    } else {
        $query = "SELECT DISTINCT a.assistant_id AS id, CONCAT(p.first_name, ' ', p.last_name) AS name, 
                         COALESCE(aa.attendance_status, 'Absent') AS status, aa.remarks
                  FROM assistant a
                  JOIN persons p ON a.person_id = p.person_id
                  JOIN class_assistant ca ON a.assistant_id = ca.assistant_id
                  LEFT JOIN attendance_assistant aa ON a.assistant_id = aa.assistant_id AND aa.attendance_date = ?
                  WHERE ca.class_id = ? AND CONCAT(p.first_name, ' ', p.last_name) LIKE ?";
    }

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    $searchNameLike = "%$searchName%";
    if ($selectedType === 'student') {
        $stmt->bind_param('sss', $attendanceDate, $classOption, $searchNameLike);
    } elseif ($selectedType === 'teacher') {
        $stmt->bind_param('ss', $attendanceDate, $searchNameLike);
    } else {
        $stmt->bind_param('sss', $attendanceDate, $classOption, $searchNameLike);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
    $stmt->close();
    ?>

    <!-- Class radio selection at the top -->
    <form class="row g-3 align-items-center m-3" method="GET" action="">
        <label class="form-label d-block">Select Class:</label>
        <div class="radio-inputs d-flex flex-wrap mb-2">
            <?php
            $classes = [
                'CLR-00001' => 'Reception Year',
                'CLR-00002' => 'Year One',
                'CLR-00003' => 'Year Two',
                'CLR-00004' => 'Year Three',
                'CLR-00005' => 'Year Four',
                'CLR-00006' => 'Year Five',
                'CLR-00007' => 'Year Six',
            ];
            foreach ($classes as $classId => $className) {
                echo '<label class="radio me-3">
                        <input type="radio" name="classOption" value="' . $classId . '" ' . ($classOption === $classId ? 'checked' : '') . '>
                        <span class="name">' . $className . '</span>
                      </label>';
            }
            ?>
        </div>

        <!-- Hidden inputs if needed to preserve other form fields -->
        <input type="hidden" name="selectType" value="<?php echo htmlspecialchars($selectedType); ?>">
        <input type="hidden" name="attendanceDate" value="<?php echo htmlspecialchars($attendanceDate); ?>">
        <input type="hidden" name="searchName" value="<?php echo htmlspecialchars($searchName); ?>">
        <button type="submit" class="btn btn-primary">Apply Class</button>
    </form>

    <div class="container mt-4">
        <h4>Attendance Records</h4>
        <form class="row g-3 align-items-center mb-3" method="GET" action="">
            <div class="col-auto">
                <label for="selectType" class="form-label">Select Type:</label>
                <select id="selectType" name="selectType" class="form-select">
                    <option value="student" <?php if ($selectedType === 'student') echo 'selected'; ?>>Student</option>
                    <option value="teacher" <?php if ($selectedType === 'teacher') echo 'selected'; ?>>Teacher</option>
                    <option value="assistant" <?php if ($selectedType === 'assistant') echo 'selected'; ?>>Assistant</option>
                </select>
            </div>
            <div class="col-auto">
                <label for="attendanceDate" class="form-label">Date:</label>
                <input
                    type="date"
                    id="attendanceDate"
                    name="attendanceDate"
                    class="form-control"
                    max="<?php echo date('Y-m-d'); ?>"
                    value="<?php echo htmlspecialchars($attendanceDate); ?>"
                >
            </div>
            <div class="col-auto">
                <label for="searchName" class="form-label">Search Name:</label>
                <input
                    type="text"
                    id="searchName"
                    name="searchName"
                    class="form-control"
                    placeholder="Enter Name"
                    value="<?php echo htmlspecialchars($searchName); ?>"
                >
            </div>
            <!-- Keep class option hidden so it remains selected -->
            <input type="hidden" name="classOption" value="<?php echo htmlspecialchars($classOption); ?>">
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <form method="POST" action="">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($records)): ?>
                        <tr>
                            <td colspan="5" class="text-center">No records found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($records as $record): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($record['name']); ?></td>
                                <td><?php echo ucfirst($selectedType); ?></td>
                                <td>
                                    <select name="attendance[<?php echo $record['id']; ?>][status]" class="form-select">
                                        <option value="Absent" <?php echo ($record['status'] === 'Absent') ? 'selected' : ''; ?>>Absent</option>
                                        <option value="Present" <?php echo ($record['status'] === 'Present') ? 'selected' : ''; ?>>Present</option>
                                        <option value="Leave" <?php echo ($record['status'] === 'Leave') ? 'selected' : ''; ?>>Leave</option>
                                    </select>
                                </td>
                                <td>
                                    <input
                                        type="text"
                                        name="attendance[<?php echo $record['id']; ?>][remarks]"
                                        class="form-control"
                                        placeholder="Add remarks"
                                        value="<?php echo htmlspecialchars($record['remarks'] ?? ''); ?>"
                                    >
                                </td>
                                <td><?php echo htmlspecialchars($attendanceDate); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Save Attendance</button>
        </form>
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