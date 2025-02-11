<?php
    require_once __DIR__. '/navbar.php';
?>
    <div class="container mt-5">
    
        <div class="card border-primary shadow p-4">
            <h2 class="mb-4 text-center">User List</h2>
            <?php show_flash_message(); ?>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['first_name'] ?></td>
                        <td><?= $row['last_name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['phone'] ?></td>
                        <td><?= $row['role_name'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="index.php?route=dashboard" class="btn btn-primary">Back to Dashboard</a>
        </div>
    </div>
<?php
    require_once __DIR__. '/footer.php';
?>