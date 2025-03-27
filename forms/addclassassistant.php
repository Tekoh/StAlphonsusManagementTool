<?php
include __DIR__ . "/../connection.php";
include __DIR__ . "/../functions.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $assistantId = trim($_POST['assistantId']);
    $classId = trim($_POST['classId']);

    // Validate assistantId exists in assistant table
    $sql_check_assistant = "SELECT assistant_id FROM assistant WHERE assistant_id = ?";
    $stmt_assistant = $conn->prepare($sql_check_assistant);
    $stmt_assistant->bind_param("s", $assistantId);
    $stmt_assistant->execute();
    $result_assistant = $stmt_assistant->get_result();
    if ($result_assistant->num_rows == 0) {
        $errors[] = "Invalid assistant ID";
    }
    $stmt_assistant->close();

    // Validate classId exists in class table
    $sql_check_class = "SELECT class_id FROM class WHERE class_id = ?";
    $stmt_class = $conn->prepare($sql_check_class);
    $stmt_class->bind_param("s", $classId);
    $stmt_class->execute();
    $result_class = $stmt_class->get_result();
    if ($result_class->num_rows == 0) {
        $errors[] = "Invalid class ID";
    }
    $stmt_class->close();

    // Check for duplicates in class_assistant table
    $sql_check_duplicate = "SELECT * FROM class_assistant WHERE assistant_id = ? AND class_id = ?";
    $stmt_duplicate = $conn->prepare($sql_check_duplicate);
    $stmt_duplicate->bind_param("ss", $assistantId, $classId);
    $stmt_duplicate->execute();
    $result_duplicate = $stmt_duplicate->get_result();
    if ($result_duplicate->num_rows > 0) {
        $errors[] = "This assistant is already assigned to this class";
    }
    $stmt_duplicate->close();

    // If no errors, insert into class_assistant table
    if (empty($errors)) {
        $sql_class_assistant = "INSERT INTO class_assistant (assistant_id, class_id) VALUES (?, ?)";
        $stmt_class_assistant = $conn->prepare($sql_class_assistant);
        $stmt_class_assistant->bind_param("ss", $assistantId, $classId);

        if ($stmt_class_assistant->execute()) {
            echo "<script>alert('New class assistant added successfully'); window.location.href='/pages/classinfo.php';</script>";
        } else {
            echo "Error: " . $stmt_class_assistant->error;
        }
        $stmt_class_assistant->close();
    } else {
        foreach ($errors as $error) {
            echo "<script>alert('$error'); window.history.back();</script>";
        }
    }

    // Close connection
    $conn->close();
}
?>