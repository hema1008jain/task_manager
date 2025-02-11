<h5>All Submitted Tasks</h5>
<?php show_flash_message(); ?>
<?php if ($tasks->num_rows > 0) { ?>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>User</th>
                <th>Start Time</th>
                <th>Stop Time</th>
                <th>Notes</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $tasks->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
                    <td><?= $row['start_time'] ?></td>
                    <td><?= $row['stop_time'] ?></td>
                    <td><?= $row['notes'] ?></td>
                    <td><?= substr($row['description'], 0, 100) . (strlen($row['description']) > 100 ? '...' : '') ?></td>
                    </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p class="text-center text-muted border border-secondary p-2">No tasks found</p>
<?php } ?>