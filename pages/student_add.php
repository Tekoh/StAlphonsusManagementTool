<?php
// Start session to manage logged-in user data
session_start();

// Include database connection
include __DIR__ . "/../connection.php";

// Include helper functions
include __DIR__ . "/../functions.php";

// Access session variables
$_SESSION;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set character encoding -->
    <meta charset="UTF-8">
    <!-- Responsive design for all devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus | Students</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom Student CSS -->
    <link rel="stylesheet" href="../assets/css/student.css">
</head>

<body class="StudentMain">
    <!-- Navigation bar partial -->
    <?php require_once '../assets/partials/navigationbar.php'; ?>
    <div class="StudentMainContainer">
        <div class="NavBarStudent">
            <!-- Links to different student pages -->
            <a href="../pages/student_list.php">Students List</a>
            <a href="../pages/student_add.php">Student Add</a>
        </div>
        <?php
        // Check if form has been submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Generate random student ID
            $student_id = 'st-' . str_pad(mt_rand(0, 99999999), 7, '0', STR_PAD_LEFT);
            // Prepare SQL statement to insert new student
            $stmt = $con->prepare("INSERT INTO students (student_id, first_name, last_name, email, student_contact, medical_history, address, class_id, emergency_contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            // Bind parameters
            $stmt->bind_param(
                "sssssssss",
                $student_id,
                $_POST['first_name'],
                $_POST['last_name'],
                $_POST['email'],
                $_POST['student_contact'],
                $_POST['medical_history'],
                $_POST['address'],
                $_POST['class_id'],
                $_POST['emergency_contact']
            );
            // Execute query and check for success
            if ($stmt->execute()) {
                $success_message = "Student added successfully. The student ID is: " . htmlspecialchars($student_id);
            } else {
                $error_message = "Error adding student: " . $stmt->error;
            }
            // Close the statement
            $stmt->close();
        }
        ?>
        <!-- Form to add a new student -->
        <form method="post" class="mb-3">
            <div class="row mb-1">
                <div class="col">
                    <!-- First Name -->
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
                <div class="col">
                    <!-- Last Name -->
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col">
                    <!-- Email -->
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="col">
                    <!-- Student Phone -->
                    <label>Student Phone</label>
                    <input type="text" name="student_contact" class="form-control" required>
                </div>
            </div>
            <div class="mb-1">
                <!-- Medical History -->
                <label>Medical History</label>
                <input type="text" name="medical_history" class="form-control">
            </div>
            <div class="mb-1">
                <!-- Address -->
                <label>Address</label>
                <input type="text" name="address" class="form-control">
            </div>
            <div class="mb-1">
                <!-- Class ID -->
                <label>Class ID</label>
                <input type="text" name="class_id" class="form-control" required>
            </div>
            <div class="mb-1">
                <!-- Emergency Contact -->
                <label>Emergency Contact</label>
                <input type="text" name="emergency_contact" class="form-control">
            </div>
            <!-- Display success message -->
            <?php if (!empty($success_message)): ?>
                <p style="color: green;"><?php echo $success_message; ?></p>
            <?php endif; ?>

            <!-- Display error message -->
            <?php if (!empty($error_message)): ?>
                <p style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>
    </div>
    <!-- Footer partial -->
    <?php require_once '../assets/partials/footer.php'; ?>
</body>
<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</html>