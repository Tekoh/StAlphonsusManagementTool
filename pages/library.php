<?php
session_start();
include __DIR__ . "/../connection.php";
include __DIR__ . "/../functions.php";
$_SESSION;
$user_data = signin_check($conn);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['transaction_id'])) {
        $transaction_id = $_POST['transaction_id'];
        $transaction_status = $_POST['transaction_status'];

        // Attempt to update the transaction_status in the library_transaction table
        updateField($conn, 'library_transaction', 'transaction_status', $transaction_status, 's', 'transaction_id', $transaction_id, 's');

        // Redirect to the same page with no status or feedback
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // Handle delete request
    if (isset($_POST['delete_transaction_id'])) {
        $delete_transaction_id = $_POST['delete_transaction_id'];
        $delete_query = "DELETE FROM library_transaction WHERE transaction_id = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param('s', $delete_transaction_id);
        $stmt->execute();
        $stmt->close();
        // Redirect to refresh the page
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/library.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/index.php">St Alphonsus</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="/index.php">Home</a>
                    <a class="nav-link" href="/pages/records.php">View Records</a>
                    <a class="nav-link" href="/pages/registration.php">Registration</a>
                    <a class="nav-link" href="/pages/classinfo.php">Class Information</a>
                    <a class="nav-link active" href="/pages/library.php">Library</a>
                    <a class="nav-link" href="/pages/attendance.php">Attendance</a>
                </div>
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="/pages/signout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="radio-inputs">
        <label class="radio">
            <input type="radio" name="tableOption" checked="" value="bb">
            <span class="name">Borrow Book</span>
        </label>
        <label class="radio">
            <input type="radio" name="tableOption" value="rb">
            <span class="name">Register Book</span>
        </label>
        <label class="radio">
            <input type="radio" name="tableOption" value="vb">
            <span class="name">View Books</span>
        </label>
    </div>
    <div class="borrowbook container mt-4">
        <form action="/forms/borrow_book.php" method="post" id="bb" class="notinuse">
            <div class="mb-3">
                <label for="book_id" class="form-label">Book</label>
                <select class="form-control" id="book_id" name="book_id" required>
                    <option value="">Select a book</option>
                    <?php
                    // Fetch book names from the library table in a loop to populate the dropdown
                    $query = "SELECT book_id, book_name FROM library";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['book_id']}'>{$row['book_id']} - {$row['book_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="student_id" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="student_id" name="student_id" required>
            </div>
            <div class="mb-3">
                <label for="borrow_date" class="form-label">Borrow Date</label>
                <input type="date" class="form-control" id="borrow_date" name="borrow_date" required>
            </div>
            <div class="mb-3">
                <label for="return_date" class="form-label">Return Date</label>
                <input type="date" class="form-control" id="return_date" name="return_date" required>
            </div>
            <input type="hidden" name="transaction_status" value="Pending">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="registerbook container mt-4">
        <form action="/forms/register_book.php" method="post" id="rb" class="notinuse">
            <div class="mb-3">
                <label for="book_name" class="form-label">Book Name</label>
                <input type="text" class="form-control" id="book_name" name="book_name" required>
            </div>
            <div class="mb-3">
                <label for="book_author" class="form-label">Book Author</label>
                <input type="text" class="form-control" id="book_author" name="book_author" required>
            </div>
            <div class="mb-3">
                <label for="published_date" class="form-label">Published Date</label>
                <input type="date" class="form-control" id="published_date" name="published_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="notinuse container mt-4" id="vb">
        <form method="GET" action="" class="d-flex justify-content-center my-3">
            <input type="text" name="search" class="form-control me-2" placeholder="Search by name"
                value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit" class="btn btn-primary me-2">Search</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='library.php'">Reset</button>
        </form>
        <div class="transaction d-flex justify-content-center">
            <table class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Student ID</th>
                        <th>Borrow Date</th>
                        <th>Return Date</th>
                        <th>Transaction Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetching transaction records from the library_transaction table
                    // and displaying them in a table format
                    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                    $query = "SELECT transaction_id, student_id, borrow_date, return_date, transaction_status 
                      FROM library_transaction 
                      WHERE student_id LIKE '%$search%'";
                    $result = $conn->query($query);
                    // also use the same functions to let the user update the transaction status in real time
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                        <td>{$row['transaction_id']}</td>
                        <td>{$row['student_id']}</td>
                        <td>{$row['borrow_date']}</td>
                        <td>{$row['return_date']}</td>
                        <td>
                        <form method='POST' action=''>
                            <input type='hidden' name='transaction_id' value='{$row['transaction_id']}'>
                            <select class='form-select' name='transaction_status' onchange='this.form.submit()'>
                                <option id='success' value='Returned' " . ($row['transaction_status'] == 'Returned' ? 'selected' : '') . ">Returned</option>
                                <option id='warning' value='Pending' " . ($row['transaction_status'] == 'Pending' ? 'selected' : '') . ">Pending</option>
                                <option id='fail' value='Overdue' " . ($row['transaction_status'] == 'Overdue' ? 'selected' : '') . ">Overdue</option>
                            </select>
                        </form>";
                            if ($row['transaction_status'] == 'Returned') {
                                echo "<form method='POST' action='' style='display:inline;'>
                                    <input type='hidden' name='delete_transaction_id' value='{$row['transaction_id']}'>
                                    <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                </form>";
                            }
                            echo "</td>
                      </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="bg-dark text-white py-3 mt-4">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="/index.php" class="text-white">Home</a></li>
                        <li><a href="/pages/records.php" class="text-white">Records</a></li>
                        <li><a href="/pages/registration.php" class="text-white">Registration</a></li>
                        <li><a href="/pages/classinfo.php" class="text-white">Class Information</a></li>
                        <li><a href="/pages/library.php" class="text-white">Library</a></li>
                    </ul>
                </div>
                <div class="col text-end align-self-center">
                    © St Alphonsus 2025
                </div>
            </div>
        </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="/assets/js/library.js"></script>

</html>