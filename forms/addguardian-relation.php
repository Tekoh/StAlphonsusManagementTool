<?php
include __DIR__ . "/../connection.php";
include __DIR__ . "/../functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $guardianId = $_POST['guardianId'];
    $studentId = $_POST['studentId'];
    $relation = $_POST['relation'];

    // Validate relation
    $valid_relations = ['mother', 'father', 'family', 'other'];
    if (!in_array($relation, $valid_relations)) {
        echo "<script>alert('Invalid relation'); window.history.back();</script>";
        exit();
    }

    // Validate guardianId exists in person table
    $sql_check_guardian = "SELECT guardian_id FROM guardian WHERE guardian_id = '$guardianId'";
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

    // Check if the relation already exists
    $sql_check_relation = "SELECT * FROM guardian WHERE guardian_id = '$guardianId' AND student_id = '$studentId' AND relation = '$relation'";
    $result_relation = $conn->query($sql_check_relation);
    if ($result_relation->num_rows > 0) {
        echo "<script>alert('This relation already exists'); window.history.back();</script>";
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
