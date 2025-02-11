<?php
    require_once __DIR__. '/navbar.php';
?>
<!-- body start -->
    <div class="container mt-5">    
        <div class="card border-primary shadow p-4">
            <h2 class="mb-4 text-center">Welcome, <?= htmlspecialchars($first_name) ?>!</h2>            
            <?php if ($role_name === "Admin") { ?>
                <?php require_once __DIR__.'/admin_dashboard.php' ?> 
            <?php } else { ?> 
                <?php require_once __DIR__.'/user_dashboard.php' ?> 
            <?php } ?>
        </div>
    </div>
<!-- body end -->
<?php
    require_once __DIR__. '/footer.php';
?>
    