<?php
include __DIR__ . "/../connection.php";
include __DIR__ . "/../functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $bookName = trim($_POST['book_name']);
    $bookAuthor = trim($_POST['book_author']);
    $publishedDate = $_POST['published_date'];
    $currentDate = date('Y-m-d');

    // Validate book name (at least two words)
    if (str_word_count($bookName) < 2) {
        echo "<script>alert('Book name should be at least two words'); window.history.back();</script>";
        exit;
    }

    // Validate author name (2 to 5 words)
    $authorWordCount = str_word_count($bookAuthor);
    if ($authorWordCount < 2 || $authorWordCount > 5) {
        echo "<script>alert('Author name should be between 2 to 5 words'); window.history.back();</script>";
        exit;
    }

    // Validate published date (not more than the current date)
    if ($publishedDate > $currentDate) {
        echo "<script>alert('Published date should not be more than the current date'); window.history.back();</script>";
        exit;
    }

    // Get next book_id
    $book_id = getNextId($conn, 'BK-', 'library', 'book_id');

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO library (book_id, book_name, author_name, book_published) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $book_id, $bookName, $bookAuthor, $publishedDate);

    if ($stmt->execute()) {
        echo "<script>alert('New book registered successfully'); window.location.href='/pages/records.php';</script>";
    } else {
        echo "<script>alert('Error: Could not register the book'); window.history.back();</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>