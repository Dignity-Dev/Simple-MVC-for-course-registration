<?php
$statuses = ['Compulsory', 'Required', 'Elective'];
$selected = $edit_mode ? explode(',', $edit_data['status']) : [];
?>

<h4><?= $edit_mode ? 'Edit Course' : 'Add New Course' ?></h4>
<form action="actions/handle_form.php" method="POST">
  <?php if ($edit_mode): ?>
    <input type="hidden" name="edit_id" value="<?= $edit_data['id'] ?>">
  <?php endif; ?>

  <div class="mb-3">
    <label class="form-label">Course Code</label>
    <input type="text" class="form-control" name="course_code" required value="<?= $edit_mode ? $edit_data['course_code'] : '' ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Course Title</label>
    <input type="text" class="form-control" name="course_title" required value="<?= $edit_mode ? $edit_data['course_title'] : '' ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Level</label>
    <input type="text" class="form-control" name="level" required value="<?= $edit_mode ? $edit_data['level'] : '' ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Session</label>
    <input type="text" class="form-control" name="session" required value="<?= $edit_mode ? $edit_data['session'] : '' ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Course Status</label>
    <select class="form-select" name="status[]" multiple required>
      <?php foreach ($statuses as $status): ?>
        <option value="<?= $status ?>" <?= in_array($status, $selected) ? 'selected' : '' ?>>
          <?= $status ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <button type="submit" class="btn btn-<?= $edit_mode ? 'success' : 'primary' ?>">
    <?= $edit_mode ? 'Update' : 'Submit' ?>
  </button>
</form>