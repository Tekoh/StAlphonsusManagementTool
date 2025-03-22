<?php
include __DIR__ . "/../connection.php";
include __DIR__ . "/../functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $guardianId = $_POST['guardianId'];
    $studentId = $_POST['studentId'];
    $relation = $_POST['relation'];

    // Validate relation
    $valid_relations = ['Mother', 'Father', 'Family', 'Other'];
    if (!in_array($relation, $valid_relations)) {
        echo "<script>alert('Invalid relation'); window.history.back();</script>";
        exit();
    }

    // Validate guardianId exists in person table
    $sql_check_guardian = "SELECT person_id FROM person WHERE person_id = '$guardianId'";
    $result_guardian = $conn->query($sql_check_guardian);
    if ($result_guardian->num_rows == 0) {
        echo "<script>alert('Invalid guardian ID'); window.history.back();</script>";
        exit();
    }

    // Validate studentId exists in student table
    $sql_check_student = "SELECT student_id FROM student WHERE student_id = '$studentId'";
    $result_student = $conn->query($sql_check_student);
    if ($result_student->num_rows == 0) {
        echo "<script>alert('Invalid student ID'); window.history.back();</script>";
        exit();
    }

    // Insert into guardian table
    $sql_guardian = "INSERT INTO guardian (guardian_id, student_id, relation) 
                     VALUES ('$guardianId', '$studentId', '$relation')";

    if ($conn->query($sql_guardian) === TRUE) {
        echo "<script>alert('New guardian relation added successfully'); window.location.href='/pages/records.php';</script>";
    } else {
        echo "Error: " . $sql_guardian . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
