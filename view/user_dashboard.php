<form id="taskForm" method="POST">
<h5>Your Tasks</h5>
<div id="flashMessageContainer">
    <?php show_flash_message(); ?>
</div>
<?php if ($tasks->num_rows > 0) { ?>
    <button type="button" id="submitSelected" class="btn btn-primary float-end mb-3">Submit Selected Tasks</button>
    <table class="table">
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>Start Time</th>
                <th>Stop Time</th>
                <th>Notes</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $tasks->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <?php if ($row['status'] !== 1) { ?>
                            <input type="checkbox" name="task_ids[]" class="task_id_check" value="<?= $row['id'] ?>">
                        <?php } ?>
                    </td>
                    <td><?= $row['start_time'] ?></td>
                    <td><?= $row['stop_time'] ?></td>
                    <td title="<?= htmlspecialchars($row['notes']) ?>">
                        <?= substr($row['notes'], 0, 25) . (strlen($row['notes']) > 25 ? '...' : '') ?>
                    </td>
                    <td title="<?= htmlspecialchars($row['description']) ?>">
                        <?= substr($row['description'], 0, 25) . (strlen($row['description']) > 25 ? '...' : '') ?>
                    </td>
                    <td>
                        <?php if ($row['status'] !== 1) { ?>
                            <a href=" index.php?route=edit_task&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a onclick="return confirm('Are you sure delete this task?')" href=" index.php?route=delete_task&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                        <?php } else { ?>
                            <span class="badge bg-success">Submitted</span>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
   
<?php } else { ?>
    <p class="text-center text-muted border border-secondary p-2">No tasks found</p>

<?php } ?>
</form>    