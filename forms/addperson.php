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

    // Validation
    $errors = [];

    if (strlen($firstName) < 4 || !ctype_alpha($firstName)) {
        $errors[] = "First name must be at least 4 characters long and contain only alphabets.";
    }

    if (strlen($lastName) < 4 || !ctype_alpha($lastName)) {
        $errors[] = "Last name must be at least 4 characters long and contain only alphabets.";
    }

    if (strtotime($dob) >= strtotime(date('Y-m-d'))) {
        $errors[] = "Date of birth must be before today's date.";
    }

    if (!in_array($gender, ['Male', 'Female', 'Other'])) {
        $errors[] = "Gender must be either Male, Female, or Other.";
    }

    $emailCheckQuery = "SELECT * FROM persons WHERE email = '$email'";
    $emailCheckResult = $conn->query($emailCheckQuery);
    if ($emailCheckResult->num_rows > 0) {
        $errors[] = "Email already exists.";
    }

    if (!is_numeric($contact) || strlen($contact) > 14) {
        $errors[] = "Contact number must be numeric and no more than 14 digits.";
    }

    if (empty($errors)) {
        // Get next person_id
        $person_id = getNextId($conn, 'P-', 'persons', 'person_id');
        $sql_person = "INSERT INTO persons (person_id, first_name, last_name, date_of_birth, gender, email, address, medical_history, contact, qualifications) 
                       VALUES ('$person_id', '$firstName', '$lastName', '$dob', '$gender', '$email', '$address', '$medicalHistory', '$contact', '$qualifications')";

        if ($conn->query($sql_person) === TRUE) {
            echo "<script>alert('New person registered successfully'); window.location.href='/pages/records.php';</script>";
        } else {
            echo "Error: " . $sql_person . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Invalid form: " . implode("\\n", $errors) . "'); window.history.back();</script>";
    }

    // Close connection
    $conn->close();
}
?>
