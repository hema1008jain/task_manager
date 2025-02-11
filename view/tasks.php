<?php
    require_once __DIR__. '/navbar.php';
?>
    <div class="container mt-5">
        <div class="card border-primary shadow p-4">       
            <h2 class="mb-4 text-center">Submitted Tasks</h2>
            <?php show_flash_message(); ?>
            <?php if ($tasks->num_rows > 0) { ?>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>User</th>
                            <th>Notes</th>
                            <th>Description</th>
                            <th>Start Time</th>
                            <th>Stop Time</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $tasks->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>                               
                                <td><?= $row['notes'] ?></td>
                                <td><?= substr($row['description'], 0, 100) . (strlen($row['description']) > 100 ? '...' : '') ?></td>
                                <td><?= $row['start_time'] ?></td>
                                <td><?= $row['stop_time'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p class="text-center text-muted">No tasks found</p>
            <?php } ?>
        </div>
    </div>
<?php
    require_once __DIR__. '/footer.php';
?>