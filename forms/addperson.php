<?php
// Include the database connection file
include __DIR__ . "/../connection.php";

// Include the file with helper functions
include __DIR__ . "/../functions.php";

// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from the form fields
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $medicalHistory = $_POST['medicalHistory'];
    $contact = $_POST['contact'];
    $qualifications = $_POST['qualifications'];
    $studentId = $_POST['studentId'];
    $relation = $_POST['relation'];

    // Initialize an array to store error messages
    $errors = [];

    // Validate the first name, it must be at least 4 characters long and contain only letters
    if (strlen($firstName) < 4 || !ctype_alpha($firstName)) {
        $errors[] = "First name must be at least 4 characters long and contain only alphabets.";
    }

    // Validate the last name, it must be at least 4 characters long and contain only letters
    if (strlen($lastName) < 4 || !ctype_alpha($lastName)) {
        $errors[] = "Last name must be at least 4 characters long and contain only alphabets.";
    }

    // Validate the date of birth, it must be a date before today
    if (strtotime($dob) >= strtotime(date('Y-m-d'))) {
        $errors[] = "Date of birth must be before today's date.";
    }

    // Validate the gender, it must be one of the allowed options
    if (!in_array($gender, ['male', 'female', 'other'])) {
        $errors[] = "Gender must be either Male, Female, or Other.";
    }

    // Check if the email already exists in the database
    $emailCheckQuery = "SELECT * FROM persons WHERE email = '$email'";
    $emailCheckResult = $conn->query($emailCheckQuery);
    if ($emailCheckResult->num_rows > 0) {
        $errors[] = "Email already exists.";
    }

    // Validate the contact number: it must be numeric and no longer than 14 digits
    if (!is_numeric($contact) || strlen($contact) > 14) {
        $errors[] = "Contact number must be numeric and no more than 14 digits.";
    }

    // Check if a student ID was selected
    if (empty($studentId)) {
        $errors[] = "You must select a student.";
    }

    // Validate the relationship: it must be one of the allowed options
    if (!in_array($relation, ['Mother', 'Father', 'Family', 'Other'])) {
        $errors[] = "Invalid relationship.";
    }

    // If there are no validation errors, proceed to save the data
    if (empty($errors)) {
        // Generate a unique ID for the new person
        $person_id = getNextId($conn, 'P-', 'persons', 'person_id');

        // SQL query to insert the person's details into the "persons" table
        $sql_person = "INSERT INTO persons (person_id, first_name, last_name, date_of_birth, gender, email, address, medical_history, contact, qualifications) 
                       VALUES ('$person_id', '$firstName', '$lastName', '$dob', '$gender', '$email', '$address', '$medicalHistory', '$contact', '$qualifications')";

        // Execute the query to insert the person's details
        if ($conn->query($sql_person) === TRUE) {
            // If the person was added successfully, insert their guardian details
            $sql_guardian = "INSERT INTO guardian (guardian_id, student_id, relation) 
                             VALUES ('$person_id', '$studentId', '$relation')";

            // Execute the query to insert the guardian details
            if ($conn->query($sql_guardian) === TRUE) {
                // If both inserts were successful, show a success message and redirect
                echo "<script>alert('New guardian registered successfully'); window.location.href='/pages/records.php';</script>";
            } else {
                // If the guardian insert fails, delete the person record to maintain consistency
                $conn->query("DELETE FROM persons WHERE person_id = '$person_id'");
                echo "Error: " . $sql_guardian . "<br>" . $conn->error;
            }
        } else {
            // If the person insert fails, show an error message
            echo "Error: " . $sql_person . "<br>" . $conn->error;
        }
    } else {
        // If there are validation errors, show them in an alert and go back to the form
        echo "<script>alert('Invalid form: " . implode("\\n", $errors) . "'); window.history.back();</script>";
    }

    // Close the database connection
    $conn->close();
}
?>
