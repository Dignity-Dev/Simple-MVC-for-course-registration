<?php
require_once '../db.php';
require_once '../controllers/CourseController.php';

$controller = new CourseController($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller->store($_POST);
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['delete'])) {
    $controller->destroy($_GET['delete']);
    header("Location: ../index.php");
    exit();
}