<?php
include __DIR__ . "/../connection.php";
include __DIR__ . "/../functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $paymentId = $_POST['paymentId'];
    $studentId = $_POST['studentId'];
    $transactionDate = $_POST['transactionDate'];
    $totalAmount = $_POST['totalAmount'];
    $amountPaid = $_POST['amountPaid'];
    $transactionStatus = $_POST['transactionStatus'];

    // Validate form data
    $errors = [];

    // Check if student_id exists in student table
    $studentCheck = $conn->query("SELECT * FROM student WHERE student_id = '$studentId'");
    if ($studentCheck->num_rows == 0) {
        $errors[] = "Invalid student ID.";
    }

    // Check if transaction date is not in the future
    if (strtotime($transactionDate) > time()) {
        $errors[] = "Transaction date cannot be in the future.";
    }

    // Check if total amount is not more than 1000
    if ($totalAmount > 1000) {
        $errors[] = "Total amount cannot be more than 1000.";
    }

    // Check if amount paid is not more than total amount
    if ($amountPaid > $totalAmount) {
        $errors[] = "Amount paid cannot be more than total amount.";
    }

    // Calculate amount due
    $amountDue = $totalAmount - $amountPaid;

    // Check if transaction status is valid
    $validStatuses = ['Paid', 'Pending', 'Overdue'];
    if (!in_array($transactionStatus, $validStatuses)) {
        $errors[] = "Invalid transaction status.";
    }

    // If there are errors, display them and do not submit the form
    if (!empty($errors)) {
        echo "<script>alert('Invalid form: " . implode(", ", $errors) . "'); window.history.back();</script>";
    } else {
        // Get next payment_id
        $payment_id = getNextId($conn, '', 'dinner_money', 'payment_id');
        $sql_dinner = "INSERT INTO dinner_money (payment_id, student_id, transaction_date, total_amount, amount_paid, amount_due, transaction_status) 
                       VALUES ('$payment_id', '$studentId', '$transactionDate', '$totalAmount', '$amountPaid', '$amountDue', '$transactionStatus')";

        if ($conn->query($sql_dinner) === TRUE) {
            echo "<script>alert('Dinner money record added successfully'); window.location.href='/pages/records.php';</script>";
        } else {
            echo "Error: " . $sql_dinner . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();
    }
}
?>
