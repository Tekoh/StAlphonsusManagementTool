<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
    $current_page = basename($_SERVER['PHP_SELF']);
    $faculty_pages = ['addta.php', 'addteacher.php', 'faculty.php', 'listta.php', 'listteacher.php'];
    $library_pages = ['add-removebooks.php', 'library.php', 'librarylist.php'];
    $student_pages = ['addstudent.php', 'liststudent.php', 'student.php'];
    $finance_pages = ['finances.php'];
    $class_pages = ['class.php', 'listclass.php', 'addclass.php'];
    ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/index.php">St Alphonsus</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>" href="/index.php">Home</a>
                    <a class="nav-link <?= (in_array($current_page, $faculty_pages)) ? 'active' : '' ?>" href="/pages/faculty.php">Teachers</a>
                    <a class="nav-link <?= (in_array($current_page, $student_pages)) ? 'active' : '' ?>" href="/pages/student.php">Students</a>
                    <a class="nav-link <?= (in_array($current_page, $library_pages)) ? 'active' : '' ?>" href="/pages/library.php">Library</a>
                    <a class="nav-link <?= (in_array($current_page, $class_pages)) ? 'active' : '' ?>" href="/pages/class.php">Class</a>
                    <a class="nav-link <?= (in_array($current_page, $finance_pages)) ? 'active' : '' ?>" href="/pages/finances.php">Finances</a>
            </div>
        </div>
    </nav>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</html>