<?php
    require_once __DIR__. '/navbar.php';
?>
    <div class="container mt-5">
    <div class="card border-primary shadow p-4">
  
        <h2>Edit Task</h2>
        <?php show_flash_message(); ?>
        <form method="post">
            <div class="mb-3">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="<?= $task['start_time'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="stop_time" class="form-label">Stop Time</label>
                <input type="datetime-local" class="form-control" id="stop_time" name="stop_time" value="<?= $task['stop_time'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control" id="notes" name="notes" required><?= $task['notes'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required><?= $task['description'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Task</button>
            <a href="index.php?route=dashboard" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php
    require_once __DIR__. '/footer.php';
?>