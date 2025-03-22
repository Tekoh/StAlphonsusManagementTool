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
    $subject = $_POST['subject'];
    $fee = $_POST['fee'];
    $feeStatus = $_POST['feeStatus'];
    $studentStatus = $_POST['studentStatus'];
    $enrollDate = $_POST['enrollDate'];

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
        $emailCheck = $conn->prepare("SELECT email FROM persons WHERE email = ?");
        $emailCheck->bind_param("s", $email);
        $emailCheck->execute();
        $emailCheck->store_result();
        if ($emailCheck->num_rows > 0) {
            $errors[] = "Email already exists.";
        }
        $emailCheck->close();
    }

    if (!preg_match("/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/", $contact)) {
        $errors[] = "Contact must be a valid UK number.";
    }

    if (!preg_match("/^[a-zA-Z]+$/", $subject)) {
        $errors[] = "Subject must contain only alphabets.";
    }

    if ($fee < 50 || $fee > 50000) {
        $errors[] = "Fee must be between 50 and 50000.";
    }

    if (!in_array($feeStatus, ['Paid', 'Pending', 'Overdue'])) {
        $errors[] = "Fee status must be Paid, Pending, or Overdue.";
    }

    if (!in_array($studentStatus, ['Active', 'Inactive', 'Suspended'])) {
        $errors[] = "Student status must be Active, Inactive, or Suspended.";
    }

    if (strtotime($enrollDate) > strtotime(date("Y-m-d"))) {
        $errors[] = "Enroll date cannot be in the future.";
    }

    if (empty($errors)) {
        // Get next person_id
        $person_id = getNextId($conn, 'P-', 'persons', 'person_id');
        $sql_person = "INSERT INTO persons (person_id, first_name, last_name, date_of_birth, gender, email, address, medical_history, contact, qualifications) 
                       VALUES ('$person_id', '$firstName', '$lastName', '$dob', '$gender', '$email', '$address', '$medicalHistory', '$contact', '$qualifications')";

        if ($conn->query($sql_person) === TRUE) {
            // Get next student_id
            $student_id = getNextId($conn, 'ST-', 'students', 'student_id');
            $sql_student = "INSERT INTO students (student_id, person_id, subject, fee, fee_status, student_status, enroll_date) 
                            VALUES ('$student_id', '$person_id', '$subject', '$fee', '$feeStatus', '$studentStatus', '$enrollDate')";

            if ($conn->query($sql_student) === TRUE) {
                echo "<script>alert('New student registered successfully'); window.location.href='/pages/records.php';</script>";
            } else {
                echo "Error: " . $sql_student . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql_person . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Invalid form: " . implode(", ", $errors) . "'); window.history.back();</script>";
    }

    // Close connection
    $conn->close();
}
?>
