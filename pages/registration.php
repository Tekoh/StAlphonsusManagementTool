<?php
session_start();
include __DIR__ . "/../connection.php";
include __DIR__ . "/../functions.php";
$_SESSION;
$user_data = signin_check($conn);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus | Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/registration.css">
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
                    <a class="nav-link active" href="/pages/registration.php">Registration</a>
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
            <input type="radio" name="formOption" checked="" value="teacher">
            <span class="name">Teachers</span>
        </label>
        <label class="radio">
            <input type="radio" name="formOption" value="student">
            <span class="name">Students</span>
        </label>
        <label class="radio">
            <input type="radio" name="formOption" value="ta">
            <span class="name">Teaching Assistant</span>
        </label>
        <label class="radio">
            <input type="radio" name="formOption" value="class">
            <span class="name">Classes</span>
        </label>
        <label class="radio">
            <input type="radio" name="formOption" value="guardian">
            <span class="name">Guardians</span>
        </label>
        <label class="radio">
            <input type="radio" name="formOption" value="dinner">
            <span class="name">Dinner Money Transactions</span>
        </label>
    </div>
    <div class="container mt-4">
        <div class="teacher">
            <form action="/forms/addteacher.php" id="teacher" method="POST" class="m-5">
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date Of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="medicalHistory" class="form-label">Medical History</label>
                    <textarea class="form-control" id="medicalHistory" name="medicalHistory" rows="3"
                        required></textarea>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact" required>
                </div>
                <div class="mb-3">
                    <label for="qualifications" class="form-label">Qualifications</label>
                    <textarea class="form-control" id="qualifications" name="qualifications" rows="3"
                        required></textarea>
                </div>
                <div class="mb-3">
                    <label for="enrollDate" class="form-label">Enroll Date</label>
                    <input type="date" class="form-control" id="enrollDate" name="enrollDate" required>
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="number" class="form-control" id="salary" name="salary" required>
                </div>
                <div class="mb-3">
                    <label for="hours" class="form-label">Hours</label>
                    <input type="number" class="form-control" id="hours" name="hours" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>


        </div>
        <div class="student">
            <form action="/forms/addstudent.php" id="student" method="POST" class="m-5">
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date Of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="medicalHistory" class="form-label">Medical History</label>
                    <textarea class="form-control" id="medicalHistory" name="medicalHistory" rows="3"
                        required></textarea>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact" required>
                </div>
                <div class="mb-3">
                    <label for="qualifications" class="form-label">Qualifications</label>
                    <textarea class="form-control" id="qualifications" name="qualifications" rows="3"
                        required></textarea>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <div class="mb-3">
                    <label for="fee" class="form-label">Fee</label>
                    <input type="number" class="form-control" id="fee" name="fee" required>
                </div>
                <div class="mb-3">
                    <label for="feeStatus" class="form-label">Fee Status</label>
                    <select class="form-control" id="feeStatus" name="feeStatus" required>
                        <option value="paid">Paid</option>
                        <option value="pending">Pending</option>
                        <option value="overdie">Overdue</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="studentStatus" class="form-label">Student Status</label>
                    <select class="form-control" id="studentStatus" name="studentStatus" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="suspended">Suspended</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="enrollDate" class="form-label">Enroll Date</label>
                    <input type="date" class="form-control" id="enrollDate" name="enrollDate" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>

        </div>
        <div class="class">
            <form action="/forms/addclass.php" id="class" method="POST" class="m-5">
                <div class="mb-3">
                    <label for="gradeLevel" class="form-label">Grade Level</label>
                    <input type="text" class="form-control" id="gradeLevel" name="gradeLevel" required>
                </div>
                <div class="mb-3">
                    <label for="roomNumber" class="form-label">Room Number</label>
                    <input type="text" class="form-control" id="roomNumber" name="roomNumber" required>
                </div>
                <div class="mb-3">
                    <label for="capacity" class="form-label">Capacity</label>
                    <input type="number" class="form-control" id="capacity" name="capacity" required>
                </div>
                <div class="mb-3">
                    <label for="teacherId" class="form-label">Teacher ID</label>
                    <input type="text" class="form-control" id="teacherId" name="teacherId" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
        <div class="ta">
            <form action="/forms/addta.php" id="ta" method="POST" class="m-5">
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date Of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="medicalHistory" class="form-label">Medical History</label>
                    <textarea class="form-control" id="medicalHistory" name="medicalHistory" rows="3"
                        required></textarea>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact" required>
                </div>
                <div class="mb-3">
                    <label for="qualifications" class="form-label">Qualifications</label>
                    <textarea class="form-control" id="qualifications" name="qualifications" rows="3"
                        required></textarea>
                </div>
                <div class="mb-3">
                    <label for="enrollDate" class="form-label">Enroll Date</label>
                    <input type="date" class="form-control" id="enrollDate" name="enrollDate" required>
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="number" class="form-control" id="salary" name="salary" required>
                </div>
                <div class="mb-3">
                    <label for="hours" class="form-label">Hours</label>
                    <input type="number" class="form-control" id="hours" name="hours" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>

        </div>
        <div class="person">
            <form action="/forms/addperson.php" id="guardian" method="POST" class="m-5">
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date Of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="medicalHistory" class="form-label">Medical History</label>
                    <textarea class="form-control" id="medicalHistory" name="medicalHistory" rows="3"
                        required></textarea>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact" required>
                </div>
                <div class="mb-3">
                    <label for="qualifications" class="form-label">Qualifications</label>
                    <textarea class="form-control" id="qualifications" name="qualifications" rows="3"
                        required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>

        <div class="dinner">
            <form action="/forms/adddinner.php" id="dinner" method="POST" class="m-5">
                <div class="mb-3">
                    <label for="paymentId" class="form-label">Payment ID</label>
                    <input type="text" class="form-control" id="paymentId" name="paymentId" required>
                </div>
                <div class="mb-3">
                    <label for="studentId" class="form-label">Student ID</label>
                    <input type="text" class="form-control" id="studentId" name="studentId" required>
                </div>
                <div class="mb-3">
                    <label for="transactionDate" class="form-label">Transaction Date</label>
                    <input type="date" class="form-control" id="transactionDate" name="transactionDate" required>
                </div>
                <div class="mb-3">
                    <label for="totalAmount" class="form-label">Total Amount</label>
                    <input type="number" class="form-control" id="totalAmount" name="totalAmount" required>
                </div>
                <div class="mb-3">
                    <label for="amountPaid" class="form-label">Amount Paid</label>
                    <input type="number" class="form-control" id="amountPaid" name="amountPaid" required>
                </div>
                <div class="mb-3">
                    <label for="amountDue" class="form-label">Amount Due</label>
                    <input type="number" class="form-control" id="amountDue" name="amountDue" required>
                </div>
                <div class="mb-3">
                    <label for="transactionStatus" class="form-label">Transaction Status</label>
                    <select class="form-control" id="transactionStatus" name="transactionStatus" required>
                        <option value="completed">Completed</option>
                        <option value="pending">Pending</option>
                        <option value="overdue">OverDue</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
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
<script src="/assets/js/registration.js"></script>

</html>