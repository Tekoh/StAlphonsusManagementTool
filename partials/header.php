<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St. Alphonsus Primary School</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/main.css">
    <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
</head>

<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">St. Alphonsus</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>" href="index.php">Home</a>
        <a class="nav-link <?= ($current_page == 'teachers.php') ? 'active' : '' ?>" href="teachers.php">Teachers</a>
        <a class="nav-link <?= ($current_page == 'students.php') ? 'active' : '' ?>" href="students.php">Students</a>
        <a class="nav-link <?= ($current_page == 'classes.php') ? 'active' : '' ?>" href="classes.php">Classes</a>
        <a class="nav-link <?= ($current_page == 'finances.php') ? 'active' : '' ?>" href="finances.php">Finances</a>
      </div>
    </div>
  </div>
</nav>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>