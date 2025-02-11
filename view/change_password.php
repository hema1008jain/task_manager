<?php
    require_once __DIR__. '/navbar.php';
?>
    <div class="container mt-5">
    
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow p-4">
                    <h2 class="text-center">Change Password</h2>  
                    <?php show_flash_message(); ?>                  
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <div class="input-group">
                                <input type="password" name="new_password" id="passwordField" class="form-control">
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#passwordField"><i class="bi bi-eye"></i></button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" id="confirmPasswordField" class="form-control">
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#confirmPasswordField"><i class="bi bi-eye"></i></button>
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="auto_generate" id="autoGenerate">
                            <label class="form-check-label" for="autoGenerate">Auto-generate password</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    require_once __DIR__. '/footer.php';
?>