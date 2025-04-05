<?php
// Include the database connection file
include __DIR__ . "/../connection.php";

// Include the functions file (assumed to have helper functions)
include __DIR__ . "/../functions.php";

// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data from the user
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
    $classId = $_POST['classId']; 

    // Initialize an array to store any errors
    $errors = [];

    // Validate the first name (at least 4 characters, only alphabets)
    if (!preg_match("/^[a-zA-Z]{4,}$/", $firstName)) {
        $errors[] = "First name must be at least 4 characters and contain only alphabets.";
    }

    // Validate the last name (at least 4 characters, only alphabets)
    if (!preg_match("/^[a-zA-Z]{4,}$/", $lastName)) {
        $errors[] = "Last name must be at least 4 characters and contain only alphabets.";
    }

    // Validate the gender (must be Male, Female, or Other)
    if (!in_array($gender, ['Male', 'Female', 'Other'])) {
        $errors[] = "Gender must be Male, Female, or Other.";
    }

    // Validate the email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } else {
        // Check if the email already exists in the database
        $emailCheckQuery = "SELECT * FROM persons WHERE email='$email'";
        $result = $conn->query($emailCheckQuery);
        if ($result->num_rows > 0) {
            $errors[] = "Email already exists.";
        }
    }

    // Validate the contact number (must contain only numbers)
    if (!preg_match("/^\d+$/", $contact)) {
        $errors[] = "Contact number must contain only numbers.";
    }

    // Ensure the enrollment date is not in the future
    if (strtotime($enrollDate) > strtotime(date('Y-m-d'))) {
        $errors[] = "Enroll date cannot be after the date of submission.";
    }

    // Validate the salary (must be between 40 and 5000)
    if ($salary < 40 || $salary > 5000) {
        $errors[] = "Salary must be between 40 and 5000.";
    }

    // Validate the working hours (must not exceed 99)
    if ($hours > 99) {
        $errors[] = "Hours must be no more than 99.";
    }

    // Ensure a class is selected
    if (empty($classId)) {
        $errors[] = "A class must be selected.";
    }

    // If there are validation errors, show an alert and go back to the form
    if (count($errors) > 0) {
        echo "<script>alert('Invalid form: " . implode(", ", $errors) . "'); window.history.back();</script>";
    } else {
        // Start a database transaction (to ensure all queries succeed or fail together)
        $conn->begin_transaction();

        try {
            // Generate a unique ID for the person
            $person_id = getNextId($conn, 'P-', 'persons', 'person_id');

            // Insert the person's details into the "persons" table
            $sql_person = "INSERT INTO persons (person_id, first_name, last_name, date_of_birth, gender, email, address, medical_history, contact, qualifications) 
                           VALUES ('$person_id', '$firstName', '$lastName', '$dob', '$gender', '$email', '$address', '$medicalHistory', '$contact', '$qualifications')";

            // Check if the person was added successfully
            if ($conn->query($sql_person) === TRUE) {
                // Generate a unique ID for the assistant
                $assistant_id = getNextId($conn, 'A-', 'assistant', 'assistant_id');

                // Insert the assistant's details into the "assistant" table
                $sql_assistant = "INSERT INTO assistant (assistant_id, person_id, enroll_date, salary, hours) 
                                  VALUES ('$assistant_id', '$person_id', '$enrollDate', '$salary', '$hours')";

                // Check if the assistant was added successfully
                if ($conn->query($sql_assistant) === TRUE) {
                    // Assign the assistant to the selected class
                    $sql_class_assistant = "INSERT INTO class_assistant (assistant_id, class_id) 
                                            VALUES ('$assistant_id', '$classId')";

                    // Check if the class assignment was successful
                    if ($conn->query($sql_class_assistant) === TRUE) {
                        // Commit the transaction (save all changes)
                        $conn->commit();
                        echo "<script>alert('New teaching assistant registered successfully'); window.location.href='/pages/records.php';</script>";
                    } else {
                        // If class assignment fails, throw an error
                        throw new Exception("Error: " . $sql_class_assistant . "<br>" . $conn->error);
                    }
                } else {
                    // If assistant insertion fails, throw an error
                    throw new Exception("Error: " . $sql_assistant . "<br>" . $conn->error);
                }
            } else {
                // If person insertion fails, throw an error
                throw new Exception("Error: " . $sql_person . "<br>" . $conn->error);
            }
        } catch (Exception $e) {
            // If any error occurs! roll back the transaction
            $conn->rollback();
            echo "<script>alert('Transaction failed: " . $e->getMessage() . "'); window.history.back();</script>";
        }

        // Close the database connection
        $conn->close();
    }
}
?>
