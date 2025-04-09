<table class="table table-bordered mt-4">
  <thead>
    <tr>
      <th>Course Code</th>
      <th>Title</th>
      <th>Level</th>
      <th>Session</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $courses->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['course_code']) ?></td>
        <td><?= htmlspecialchars($row['course_title']) ?></td>
        <td><?= htmlspecialchars($row['level']) ?></td>
        <td><?= htmlspecialchars($row['session']) ?></td>
        <td><?= htmlspecialchars($row['status']) ?></td>
        <td>
          <a href="?edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="actions/handle_form.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this course?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>