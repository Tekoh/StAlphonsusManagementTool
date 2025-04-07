<?php
session_start();
include __DIR__ . "/../connection.php";
include __DIR__ . "/../functions.php";
$_SESSION;
$user_data = signin_check($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['payment_id'])) {
        $payment_id = $_POST['payment_id'];
        $transaction_status = $_POST['transaction_status'];

        // Attempt to update the transaction_status in the dinner_money table
        updateField($conn, 'dinner_money', 'transaction_status', $transaction_status, 's', 'payment_id', $payment_id, 's');

        // Redirect to the same page with no status or feedback
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } elseif (isset($_POST['student_id'])) {
        $student_id = $_POST['student_id'];

        if (isset($_POST['fee_status'])) {
            $fee_status = $_POST['fee_status'];
            // Attempt to update the fee_status in the student table
            updateField($conn, 'student', 'fee_status', $fee_status, 's', 'student_id', $student_id, 's');
        }

        if (isset($_POST['student_status'])) {
            $student_status = $_POST['student_status'];
            // Attempt to update the student_status in the student table
            updateField($conn, 'student', 'student_status', $student_status, 's', 'student_id', $student_id, 's');
        }

        // Redirect to the same page with no status or feedback
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } elseif (isset($_POST['delete_payment_id'])) {
        $delete_payment_id = $_POST['delete_payment_id'];
        $delete_query = "DELETE FROM dinner_money WHERE payment_id = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param('s', $delete_payment_id);
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
    <title>St Alphonsus | Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/records.css">
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
                    <a class="nav-link active" href="/pages/records.php">View Records</a>
                    <a class="nav-link" href="/pages/registration.php">Registration</a>
                    <a class="nav-link" href="/pages/classinfo.php">Class Information</a>
                    <a class="nav-link" href="/pages/library.php">Library</a>
                    <a class="nav-link " href="/pages/attendance.php">Attendance</a>
                </div>
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="/pages/signout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="radio-inputs">
        <label class="radio">
            <input type="radio" name="tableOption" checked="" value="teacher">
            <span class="name">Teachers</span>
        </label>
        <label class="radio">
            <input type="radio" name="tableOption" value="student">
            <span class="name">Students</span>
        </label>
        <label class="radio">
            <input type="radio" name="tableOption" value="ta">
            <span class="name">Teaching Assistant</span>
        </label>
        <label class="radio">
            <input type="radio" name="tableOption" value="guardian">
            <span class="name">Guardians</span>
        </label>
        <label class="radio">
            <input type="radio" name="tableOption" value="dinner">
            <span class="name">Dinner Money Transactions</span>
        </label>
    </div>
    <div class="container mt-4">
        <form method="GET" action="" class="d-flex justify-content-center my-3">
            <input type="text" name="search" class="form-control me-2" placeholder="Search by name"
                value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit" class="btn btn-primary me-2">Search</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='records.php'">Reset</button>
        </form>
        <div class="teacher d-flex justify-content-center">
            <table class="table table-bordered table-striped" id="teacher">
                <thead>
                    <tr>
                        <th>Teacher ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date Of Birth</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Medical History</th>
                        <th>Contact</th>
                        <th>Qualifications</th>
                        <th>Enroll Date</th>
                        <th>Salary</th>
                        <th>Hours</th>
                    </tr>
                    <?php
                    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                    $query = "SELECT t.teacher_id, p.first_name, p.last_name, p.date_of_birth, p.gender, p.email, p.address, p.medical_history, p.contact, p.qualifications, t.enroll_date, t.salary, t.hours 
                          -- Getting teacher info from persons table as well as teacher table by joinging them from person_id
                          FROM teacher t 
                          JOIN persons p ON t.person_id = p.person_id
                          -- and filtering the data based on the search input and going through all the columns
                          WHERE p.first_name LIKE '%$search%' 
                          OR p.last_name LIKE '%$search%' 
                          OR p.date_of_birth LIKE '%$search%' 
                          OR p.gender LIKE '%$search%' 
                          OR p.email LIKE '%$search%' 
                          OR p.address LIKE '%$search%' 
                          OR p.medical_history LIKE '%$search%' 
                          OR p.contact LIKE '%$search%' 
                          OR p.qualifications LIKE '%$search%' 
                          OR t.enroll_date LIKE '%$search%' 
                          OR t.salary LIKE '%$search%' 
                          OR t.hours LIKE '%$search%'";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['teacher_id']}</td>
                                <td>{$row['first_name']}</td>
                                <td>{$row['last_name']}</td>
                                <td>{$row['date_of_birth']}</td>
                                <td>{$row['gender']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['medical_history']}</td>
                                <td>{$row['contact']}</td>
                                <td>{$row['qualifications']}</td>
                                <td>{$row['enroll_date']}</td>
                                <td>{$row['salary']}</td>
                                <td>{$row['hours']}</td>
                              </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='13'>No records found</td></tr>";
                    }
                    ?>
            </table>
        </div>
        <div class="student d-flex justify-content-center">
            <table class="table table-bordered table-striped" id="student">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date Of Birth</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Medical History</th>
                        <th>Contact</th>
                        <th>Qualifications</th>
                        <th>Subject</th>
                        <th>Fee</th>
                        <th>Fee Status</th>
                        <th>Student Status</th>
                        <th>Enroll Date</th>
                    </tr>
                    <?php
                    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                    $query = "SELECT s.student_id, p.first_name, p.last_name, p.date_of_birth, p.gender, p.email, p.address, p.medical_history, p.contact, p.qualifications, s.subject, s.fee, s.fee_status, s.student_status, s.enroll_date 
                          FROM student s 
                            -- Getting student info from persons table as well as student table by joinging them from person_id
                          JOIN persons p ON s.person_id = p.person_id
                            -- and filtering the data based on the search input and going through all the columns
                          WHERE p.first_name LIKE '%$search%' 
                          OR p.last_name LIKE '%$search%' 
                          OR p.date_of_birth LIKE '%$search%' 
                          OR p.gender LIKE '%$search%' 
                          OR p.email LIKE '%$search%' 
                          OR p.address LIKE '%$search%' 
                          OR p.medical_history LIKE '%$search%' 
                          OR p.contact LIKE '%$search%' 
                          OR p.qualifications LIKE '%$search%' 
                          OR s.subject LIKE '%$search%' 
                          OR s.fee LIKE '%$search%' 
                          OR s.fee_status LIKE '%$search%' 
                          OR s.student_status LIKE '%$search%' 
                          OR s.enroll_date LIKE '%$search%'";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // update form feature where the user can update the fee and student status on the go in real time using update statements in the function
                            echo "<tr>
                                <td>{$row['student_id']}</td>
                                <td>{$row['first_name']}</td>
                                <td>{$row['last_name']}</td>
                                <td>{$row['date_of_birth']}</td>
                                <td>{$row['gender']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['medical_history']}</td>
                                <td>{$row['contact']}</td>
                                <td>{$row['qualifications']}</td>
                                <td>{$row['subject']}</td>
                                <td>{$row['fee']}</td> 
                                <td>
                                    <form method='POST' action=''>
                                        <input type='hidden' name='student_id' value='{$row['student_id']}'>
                                        <select class='' name='fee_status' onchange='this.form.submit()'>
                                            <option value='Paid' " . ($row['fee_status'] == 'Paid' ? 'selected' : '') . ">Paid</option>
                                            <option value='Pending' " . ($row['fee_status'] == 'Pending' ? 'selected' : '') . ">Pending</option>
                                            <option value='Overdue' " . ($row['fee_status'] == 'Overdue' ? 'selected' : '') . ">Overdue</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <form method='POST' action=''>
                                        <input type='hidden' name='student_id' value='{$row['student_id']}'>
                                        <select class='' name='student_status' onchange='this.form.submit()'>
                                            <option value='Active' " . ($row['student_status'] == 'Active' ? 'selected' : '') . ">Active</option>
                                            <option value='Inactive' " . ($row['student_status'] == 'Inactive' ? 'selected' : '') . ">Inactive</option>
                                            <option value='Suspended' " . ($row['student_status'] == 'Suspended' ? 'selected' : '') . ">Suspended</option>
                                        </select>
                                    </form>
                                </td>
                                <td>{$row['enroll_date']}</td>
                              </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='15'>No records found</td></tr>";
                    }
                    ?>
            </table>
        </div>
        <div class="assistant d-flex justify-content-center">
            <table class="table table-bordered table-striped" id="ta">
                <thead>
                    <tr>
                        <th>Assistant ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date Of Birth</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Medical History</th>
                        <th>Contact</th>
                        <th>Qualifications</th>
                        <th>Enroll Date</th>
                        <th>Salary</th>
                        <th>Hours</th>
                    </tr>
                    <?php
                    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                    // Getting assistant info from persons table as well as assistant table by joinging them from person_id
                    $query = "SELECT ta.assistant_id, p.first_name, p.last_name, p.date_of_birth, p.gender, p.email, p.address, p.medical_history, p.contact, p.qualifications, ta.enroll_date, ta.salary, ta.hours 
                          FROM assistant ta 
                          JOIN persons p ON ta.person_id = p.person_id
                    -- and filtering the data based on the search input and going through all the columns
                          WHERE p.first_name LIKE '%$search%' 
                          OR p.last_name LIKE '%$search%' 
                          OR p.date_of_birth LIKE '%$search%' 
                          OR p.gender LIKE '%$search%' 
                          OR p.email LIKE '%$search%' 
                          OR p.address LIKE '%$search%' 
                          OR p.medical_history LIKE '%$search%' 
                          OR p.contact LIKE '%$search%' 
                          OR p.qualifications LIKE '%$search%' 
                          OR ta.enroll_date LIKE '%$search%' 
                          OR ta.salary LIKE '%$search%' 
                          OR ta.hours LIKE '%$search%'";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['assistant_id']}</td>
                                <td>{$row['first_name']}</td>
                                <td>{$row['last_name']}</td>
                                <td>{$row['date_of_birth']}</td>
                                <td>{$row['gender']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['medical_history']}</td>
                                <td>{$row['contact']}</td>
                                <td>{$row['qualifications']}</td>
                                <td>{$row['enroll_date']}</td>
                                <td>{$row['salary']}</td>
                                <td>{$row['hours']}</td>
                              </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='13'>No records found</td></tr>";
                    }
                    ?>
            </table>
        </div>
        <div class="guardian d-flex justify-content-center">
            <table class="table table-bordered table-striped" id="guardian">
                <thead>
                    <tr>
                        <th>Guardian ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date Of Birth</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Medical History</th>
                        <th>Contact</th>
                        <th>Qualifications</th>
                        <th>Wards</th>
                        <th>Relation</th>
                    </tr>
                    <?php
                    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                    // Getting guardian info from persons table as well as guardian table by joinging them from person_id
                    // and filtering the data based on the search input and going through all the columns
                    // and getting the wards of the guardian by joining the student table and persons table
                    // and grouping the data by guardian id
                    $query = "SELECT g.guardian_id, p.first_name, p.last_name, p.date_of_birth, p.gender, p.email, p.address, p.medical_history, p.contact, p.qualifications, g.relation, 
                          GROUP_CONCAT(CONCAT(sp.first_name, ' ', sp.last_name) SEPARATOR ', ') AS wards
                          FROM guardian g 
                          JOIN persons p ON g.guardian_id = p.person_id
                          LEFT JOIN student s ON s.student_id = g.student_id
                          LEFT JOIN persons sp ON s.person_id = sp.person_id
                          WHERE p.first_name LIKE '%$search%' 
                          OR p.last_name LIKE '%$search%' 
                          OR p.date_of_birth LIKE '%$search%' 
                          OR p.gender LIKE '%$search%' 
                          OR p.email LIKE '%$search%' 
                          OR p.address LIKE '%$search%' 
                          OR p.medical_history LIKE '%$search%' 
                          OR p.contact LIKE '%$search%' 
                          OR p.qualifications LIKE '%$search%' 
                          OR g.relation LIKE '%$search%' 
                          OR sp.first_name LIKE '%$search%' 
                          OR sp.last_name LIKE '%$search%'
                          GROUP BY g.guardian_id, p.first_name, p.last_name, p.date_of_birth, p.gender, p.email, p.address, p.medical_history, p.contact, p.qualifications, g.relation";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['guardian_id']}</td>
                                <td>{$row['first_name']}</td>
                                <td>{$row['last_name']}</td>
                                <td>{$row['date_of_birth']}</td>
                                <td>{$row['gender']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['medical_history']}</td>
                                <td>{$row['contact']}</td>
                                <td>{$row['qualifications']}</td>
                                <td>{$row['wards']}</td>
                                <td>{$row['relation']}</td>
                              </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='12'>No records found</td></tr>";
                    }
                    ?>
            </table>
        </div>
        <div class="dinner d-flex justify-content-center">
            <table class="table table-bordered table-striped " id="dinner">
                <thead>
                    <tr>
                        <th>Payment ID</th>
                        <th>Student ID</th>
                        <th>Transaction Date</th>
                        <th>Total Amount</th>
                        <th>Amount Paid</th>
                        <th>Amount Due</th>
                        <th>Transaction Status</th>
                    </tr>
                    <tr>
                        <?php
                        $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                        // Getting dinner money info from dinner_money table and filtering the data based on the search input and going through all the columns
                        $query = "SELECT payment_id, student_id, transaction_date, total_amount, amount_paid, amount_due, transaction_status 
                              FROM dinner_money 
                              WHERE payment_id LIKE '%$search%' 
                              OR student_id LIKE '%$search%' 
                              OR transaction_date LIKE '%$search%' 
                              OR total_amount LIKE '%$search%' 
                              OR amount_paid LIKE '%$search%' 
                              OR amount_due LIKE '%$search%' 
                              OR transaction_status LIKE '%$search%'";
                        $result = $conn->query($query);

                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['payment_id']}</td>
                                    <td>{$row['student_id']}</td>
                                    <td>{$row['transaction_date']}</td>
                                    <td>{$row['total_amount']}</td>
                                    <td>{$row['amount_paid']}</td>
                                    <td>{$row['amount_due']}</td>
                                    <td>
                                        <div class='d-flex align-items-center'>
                                            <form method='POST' action='' class='me-2'>
                                                <input type='hidden' name='payment_id' value='{$row['payment_id']}'>
                                                <select class='' name='transaction_status' onchange='this.form.submit()'>
                                                    <option value='Paid' " . ($row['transaction_status'] == 'Paid' ? 'selected' : '') . ">Paid</option>
                                                    <option value='Pending' " . ($row['transaction_status'] == 'Pending' ? 'selected' : '') . ">Pending</option>
                                                    <option value='Overdue' " . ($row['transaction_status'] == 'Overdue' ? 'selected' : '') . ">Overdue</option>
                                                </select>
                                            </form>";
                                if ($row['transaction_status'] == 'Paid') {
                                    echo "<form method='POST' action=''>
                                            <input type='hidden' name='delete_payment_id' value='{$row['payment_id']}'>
                                            <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                          </form>";
                                }
                                echo "</div>
                                    </td>
                                  </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No records found</td></tr>";
                        }
                        ?>
                    </tr>
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
<script src="/assets/js/records.js"></script>

</html>