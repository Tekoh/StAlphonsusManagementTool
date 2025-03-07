<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StAlphonsus | Add Teacher</title>
    <link rel="stylesheet" href="../assets/css/addteacher.css">
</head>
<body>
<?php include '../partials/header.php'; ?>
<section class="addTeacher container-fluid">
<form action="addteacher.inc.php" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>
        <label for="annual_salary">Annual Salary:</label>
        <input type="number" id="annual_salary" name="annual_salary" required>
        <label for="hours_per_month">Hours of Classes per Month:</label>
        <input type="number" id="hours_per_month" name="hours_per_month" required>
        <label for="phone_no">Phone Number:</label>
        <input type="tel" id="phone_no" name="phone_no" required>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>
        <label for="education">Last Education:</label>
        <input id="education" name="education" required></input>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>
        <button type="submit">Add Teacher</button>
</form>
</section>

    
</body>
</html>