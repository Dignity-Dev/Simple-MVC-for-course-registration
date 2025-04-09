<?php
require_once 'db.php';
require_once 'controllers/CourseController.php';

$controller = new CourseController($conn);
$edit_mode = false;
$edit_data = null;

if (isset($_GET['edit'])) {
    $edit_mode = true;
    $edit_data = $controller->get($_GET['edit']);
}
$courses = $controller->index();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Course Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <?php include 'views/form.php'; ?>
    </div>
    <div class="col-md-6">
      <?php include 'views/table.php'; ?>
    </div>
  </div>
</div>

</body>
</html>