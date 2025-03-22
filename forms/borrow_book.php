<?php
include __DIR__ . "/../connection.php";
include __DIR__ . "/../functions.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = $_POST['book_id'];
    $student_id = $_POST['student_id'];
    $borrow_date = $_POST['borrow_date'];
    $return_date = $_POST['return_date'];
    $transaction_status = 'Pending';

    // Check if student_id exists in student table
    $student_check_query = "SELECT * FROM student WHERE student_id = '$student_id'";
    $student_check_result = mysqli_query($conn, $student_check_query);

    if (mysqli_num_rows($student_check_result) == 0) {
        echo "<script>alert('Student ID does not exist.'); window.history.back();</script>";
        exit;
    }

    // Check if book_id exists in library table
    $book_check_query = "SELECT * FROM library WHERE book_id = '$book_id'";
    $book_check_result = mysqli_query($conn, $book_check_query);

    if (mysqli_num_rows($book_check_result) == 0) {
        echo "<script>alert('Book ID does not exist.'); window.history.back();</script>";
        exit;
    }

    // Check if borrow_date is before return_date
    if ($borrow_date >= $return_date) {
        echo "<script>alert('Borrow date must be before return date.'); window.history.back();</script>";
        exit;
    }

    // Insert data into library_transaction table
    $insert_query = "INSERT INTO library_transaction (book_id, student_id, borrow_date, return_date, transaction_status) VALUES ('$book_id', '$student_id', '$borrow_date', '$return_date', '$transaction_status')";
    if (mysqli_query($conn, $insert_query)) {
        echo "<script>alert('Success'); window.location.href = '/pages/library.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }
}
?>