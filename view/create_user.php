<?php
    require_once __DIR__. '/navbar.php';
?>
<!-- body data -->
    <div class="container mt-5">
        
        <div class="card border-primary shadow p-4">       
            <h2 class="mb-4 text-center">New User</h2>
            <div id="flashMessageContainer"><?php show_flash_message(); ?></div>
            <form method="POST" class="g-3">
                <div class="col-md-12">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="col-md-12 position-relative">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="passwordField" class="form-control" required>
                        <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#passwordField"><i class="bi bi-eye"></i></button>
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="checkbox" id="autoGenerate"> Auto Generate Password
                </div>
                <div class="col-md-12">
                    <label class="form-label">Role</label>
                    <select name="role_id" class="form-select" required>
                        <option value="">Select Role</option>
                        <?php while ($row = $roles->fetch_assoc()) { ?>
                            <option value="<?= $row['id'] ?>"><?= $row['role_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-success">Create User</button>
                </div>
            </form>
            <br>
            <?php if ($role_name === "Admin") { ?>
                <div class="text-center">
                    <a href="index.php?route=dashboard" class="btn btn-primary">Back to Dashboard</a>
                </div>
            <?php } ?>
        </div>
    </div>
<!-- end body data -->
<?php
    require_once __DIR__. '/footer.php';
?>
