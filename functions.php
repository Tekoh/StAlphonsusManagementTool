<?php 

// Function to check if the user is logged in
function signin_check($conn)
{
    // Check if the username is set in the session
    if (isset($_SESSION['username'])){
        $id = $_SESSION['username']; // Retrieve the username from the session
        
        // SQL query to select the user from the database based on the username
        $query = "SELECT * FROM users WHERE username = '$id' limit 1 ";
        
        // Execute the query and check if the username exists in the database
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch user data as an associative array and return it
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    // If the user is not logged in, redirect to the sign-in page and terminate the script
    header("Location: /pages/signin.php");
    die;
}

// Function to update a specific field in a database table
function updateField($conn, $table, $field, $value, $valueType, $conditionField, $conditionValue, $conditionType) {
    // Prepare the SQL query to update the specified field in the table
    $sql = "UPDATE `$table` SET `$field` = ? WHERE `$conditionField` = ?";
    $stmt = $conn->prepare($sql); // Prepare the SQL statement
    
    if ($stmt) {
        // Bind parameters to the prepared statement
        // $valueType and $conditionType determine the data types of the parameters
        $stmt->bind_param($valueType . $conditionType, $value, $conditionValue);
        
        // Execute the prepared statement
        $stmt->execute();
        
        // Close the statement to free resources
        $stmt->close();
    }
}

// Function to generate the next ID with a specific prefix so my ADHD doesnt get triggered by random ids
function getNextId($conn, $prefix, $table, $column) {
    // Query to get the last ID from the table that matches the given prefix
    $sql = "SELECT $column FROM $table WHERE $column LIKE '$prefix%' ORDER BY $column DESC LIMIT 1";
    $result = $conn->query($sql); // Execute the query
    
    if ($result->num_rows > 0) {
        // Fetch the last ID from the result set
        $row = $result->fetch_assoc();
        $lastId = $row[$column];
        
        // Extract the numeric part of the ID, increment it, and generate the new ID
        $number = intval(substr($lastId, strlen($prefix))) + 1;
        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT); // Pad the number with leading zeros
    } else {
        // If no matching ID is found, return the first ID with the prefix
        return $prefix . '00001';
    }
}