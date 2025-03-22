<?php
include __DIR__ . "/../connection.php";
include __DIR__ . "/../functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $gradeLevel = $_POST['gradeLevel'];
    $roomNumber = $_POST['roomNumber'];
    $capacity = $_POST['capacity'];
    $teacherId = $_POST['teacherId'];

    // Validation checks
    $errors = [];

    // Check if grade level is at least 2 words
    if (str_word_count($gradeLevel) < 2) {
        $errors[] = "Grade level should be at least 2 words.";
    }

    // Check if room number is between 101 and 500
    if (!is_numeric($roomNumber) || $roomNumber < 101 || $roomNumber > 500) {
        $errors[] = "Room number should be a number between 101 and 500.";
    }

    // Check if capacity is between 50 and 200
    if (!is_numeric($capacity) || $capacity < 50 || $capacity > 200) {
        $errors[] = "Capacity should be a number between 50 and 200.";
    }

    // Check if teacher ID exists in the teacher table
    $sql_teacher = "SELECT teacher_id FROM teacher WHERE teacher_id = '$teacherId'";
    $result_teacher = $conn->query($sql_teacher);
    if ($result_teacher->num_rows == 0) {
        $errors[] = "Teacher ID does not exist.";
    }

    // If there are errors, display them and do not proceed
    if (!empty($errors)) {
        echo "<script>alert('Invalid form: " . implode(", ", $errors) . "'); window.history.back();</script>";
    } else {
        // Get next class_id
        $class_id = getNextId($conn, 'CLR-', 'class', 'class_id');
        $sql_class = "INSERT INTO class (class_id, grade_level, room_number, capacity, teacher_id) 
                      VALUES ('$class_id', '$gradeLevel', '$roomNumber', '$capacity', '$teacherId')";

        if ($conn->query($sql_class) === TRUE) {
            echo "<script>alert('New class registered successfully'); window.location.href='/pages/records.php';</script>";
        } else {
            echo "Error: " . $sql_class . "<br>" . $conn->error;
        }
    }

    // Close connection
    $conn->close();
}
?>