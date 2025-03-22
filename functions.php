<?php 

// Function to check if the user is logged in
function signin_check($conn)
{
    //simple if statement to check if the username set in the session is present in the database
    if (isset($_SESSION['username'])){
        $id = $_SESSION['username'];
        //SQL query to select the user from the database
        $query = "SELECT * FROM users WHERE username = '$id' limit 1 ";
        //checking if the username exits in the database
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    //if the user is not logged in, redirect to the sign up page
    header("Location: /pages/signin.php");
    die;
}
function updateField($conn, $table, $field, $value, $valueType, $conditionField, $conditionValue, $conditionType) {
    $sql = "UPDATE `$table` SET `$field` = ? WHERE `$conditionField` = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param($valueType . $conditionType, $value, $conditionValue);
        $stmt->execute();
        $stmt->close();
    }
}

function getNextId($conn, $prefix, $table, $column) {
    $sql = "SELECT $column FROM $table WHERE $column LIKE '$prefix%' ORDER BY $column DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastId = $row[$column];
        $number = intval(substr($lastId, strlen($prefix))) + 1;
        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    } else {
        return $prefix . '00001';
    }
}