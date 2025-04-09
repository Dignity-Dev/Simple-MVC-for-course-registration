<?php
require_once '../db.php';

$student_id = 1; // for testing purpose; replace with session or login id
$courses = $conn->query("SELECT * FROM courses");

$registered = [];
$result = $conn->query("SELECT course_id, status FROM student_courses WHERE student_id = $student_id");
while ($row = $result->fetch_assoc()) {
    $registered[$row['course_id']][] = $row['status'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];
    $status = $_POST['status'];

    $check = $conn->prepare("SELECT id FROM student_courses WHERE student_id=? AND course_id=? AND status=?");
    $check->bind_param("iis", $student_id, $course_id, $status);
    $check->execute();
    $check->store_result();

    if ($check->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO student_courses (student_id, course_id, status) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $student_id, $course_id, $status);
        $stmt->execute();
        header("Location: student.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Course Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
  <h3>Student Course Registration</h3>
  <div class="row row-cols-1 row-cols-md-2 g-4">
    <?php while ($course = $courses->fetch_assoc()): ?>
      <?php $statuses = explode(',', $course['status']); ?>
      <div class="col">
        <div class="card p-3">
          <h5><?= $course['course_code'] ?> - <?= $course['course_title'] ?></h5>
          <p><strong>Level:</strong> <?= $course['level'] ?> | <strong>Session:</strong> <?= $course['session'] ?></p>
          <div class="d-flex flex-wrap gap-2">
            <?php foreach ($statuses as $status): ?>
              <?php $isAdded = in_array($status, $registered[$course['id']] ?? []); ?>
              <form method="POST" class="d-inline">
                <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                <input type="hidden" name="status" value="<?= $status ?>">
                <button type="submit" class="btn btn-sm <?= $isAdded ? 'btn-success' : 'btn-primary' ?>" <?= $isAdded ? 'disabled' : '' ?>>
                  <?= $isAdded ? 'Added' : "Select ($status)" ?>
                </button>
              </form>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <hr class="my-4">
  <h4>Registered Courses</h4>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Course</th><th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $joined = $conn->query("SELECT c.course_code, c.course_title, sc.status
        FROM student_courses sc
        JOIN courses c ON sc.course_id = c.id
        WHERE sc.student_id = $student_id");
      while ($row = $joined->fetch_assoc()):
      ?>
        <tr>
          <td><?= $row['course_code'] ?> - <?= $row['course_title'] ?></td>
          <td><?= $row['status'] ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>