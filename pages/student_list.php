<?php
// Start session or resume existing one
session_start();

// Include database connection and helper functions
include __DIR__ . "/../connection.php";
include __DIR__ . "/../functions.php";

// Check session variables
$_SESSION;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags and page title -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus | Students</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom stylesheet for student page -->
    <link rel="stylesheet" href="../assets/css/student.css">
</head>

<body class="StudentMain">
    <!-- Navigation bar -->
    <?php require_once '../assets/partials/navigationbar.php'; ?>

    <div class="StudentMainContainer">
        <div class="NavBarStudent">
            <!-- Links for student list and adding new students -->
            <a href="../pages/student_list.php">Students List</a>
            <a href="../pages/student_add.php">Student Add</a>
        </div>
        <?php
        // Ensure $con is available
        if (!isset($con)) {
            include_once __DIR__ . '/../connection.php';
        }

        // Prepare SQL to fetch students and join with class for the level
        $sql = "
        SELECT s.student_id, s.first_name, s.last_name, s.email, s.student_contact,
               s.medical_history, s.address, s.class_id, c.level AS class_level,
               s.emergency_contact
        FROM students AS s
        JOIN class AS c ON s.class_id = c.class_id
        ";

        // Execute query and handle errors
        $result = $con->query($sql);
        if (!$result) {
            echo "<p>Error fetching students: " . $con->error . "</p>";
            return;
        }
        ?>
        <!-- Table to display the students -->
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Student Phone</th>
                    <th>Medical History</th>
                    <th>Address</th>
                    <th>Class</th>
                    <th>Emergency Contact</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the results and display the data in the table
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['student_contact']); ?></td>
                        <td><?php echo htmlspecialchars($row['medical_history']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['class_id']) . ' - ' . htmlspecialchars($row['class_level']); ?></td>
                        <td><?php echo htmlspecialchars($row['emergency_contact']); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Footer section -->
    <?php require_once '../assets/partials/footer.php'; ?>
</body>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</html>