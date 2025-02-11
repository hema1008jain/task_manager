<?php
    require_once __DIR__. '/navbar.php';
?>
<body>
    <div class="container mt-5">
    
        <div class="card border-primary shadow p-4">            
        <h2 class="mb-4 text-center">Add New Task</h2>
        <?php show_flash_message(); ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Start Time</label>
                    <input type="datetime-local" class="form-control" name="start_time" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stop Time</label>
                    <input type="datetime-local" class="form-control" name="stop_time" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea class="form-control" name="notes" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit Task</button>
            </form>
        </div>
    </div>
<?php
    require_once __DIR__. '/footer.php';
?>