<?php
include __DIR__ . "/../connection.php";
include __DIR__ . "/../functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $medicalHistory = $_POST['medicalHistory'];
    $contact = $_POST['contact'];
    $qualifications = $_POST['qualifications'];
    $enrollDate = $_POST['enrollDate'];
    $salary = $_POST['salary'];
    $hours = $_POST['hours'];

    // Validation
    $errors = [];

    if (!preg_match("/^[a-zA-Z]{4,}$/", $firstName)) {
        $errors[] = "First name must be at least 4 characters and contain only alphabets.";
    }

    if (!preg_match("/^[a-zA-Z]{4,}$/", $lastName)) {
        $errors[] = "Last name must be at least 4 characters and contain only alphabets.";
    }

    if (!in_array($gender, ['Male', 'Female', 'Other'])) {
        $errors[] = "Gender must be Male, Female, or Other.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } else {
        $emailCheck = $conn->prepare("SELECT * FROM persons WHERE email = ?");
        $emailCheck->bind_param("s", $email);
        $emailCheck->execute();
        $result = $emailCheck->get_result();
        if ($result->num_rows > 0) {
            $errors[] = "Email already exists.";
        }
        $emailCheck->close();
    }

    if (!preg_match("/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/", $contact)) {
        $errors[] = "Invalid UK contact number.";
    }

    if (strtotime($enrollDate) > time()) {
        $errors[] = "Enroll date cannot be after the date of submission.";
    }

    if ($salary < 40 || $salary > 5000) {
        $errors[] = "Salary must be between 40 and 5000.";
    }

    if ($hours > 99) {
        $errors[] = "Hours must be no more than 99.";
    }

    if (count($errors) > 0) {
        echo "<script>alert('Invalid form: " . implode(", ", $errors) . "'); window.history.back();</script>";
    } else {
        // Get next person_id
        $person_id = getNextId($conn, 'P-', 'persons', 'person_id');
        $sql_person = "INSERT INTO persons (person_id, first_name, last_name, date_of_birth, gender, email, address, medical_history, contact, qualifications) 
                       VALUES ('$person_id', '$firstName', '$lastName', '$dob', '$gender', '$email', '$address', '$medicalHistory', '$contact', '$qualifications')";

        if ($conn->query($sql_person) === TRUE) {
            // Get next teacher_id
            $teacher_id = getNextId($conn, 'TC-', 'teacher', 'teacher_id');
            $sql_teacher = "INSERT INTO teacher (teacher_id, person_id, enroll_date, salary, hours) 
                            VALUES ('$teacher_id', '$person_id', '$enrollDate', '$salary', '$hours')";

            if ($conn->query($sql_teacher) === TRUE) {
                echo "<script>alert('New teacher registered successfully'); window.location.href='/pages/records.php';</script>";
            } else {
                echo "Error: " . $sql_teacher . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql_person . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();
    }
}
?>