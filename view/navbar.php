   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
   <!-- Navigation Bar -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php?route=dashboard">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role_name'] == "Admin") { ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?route=create_user"><i class="bi bi-person-plus"></i> Create User</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?route=users"><i class="bi bi-people"></i> Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?route=tasks"><i class="bi bi-list-task"></i> Submitted Tasks</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?route=download_report"><i class="bi bi-download"></i> Download Report</a></li>
                    <?php } elseif(isset($_SESSION['user']) && $_SESSION['user']['role_name'] == "User") { ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?route=create_task"><i class="bi bi-journal-plus"></i> Create Task</a></li>
                    <?php } ?>
                    <li class="nav-item"><a class="nav-link" href="index.php?route=change_password"><i class="bi bi-lock"></i> Change password</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="index.php?route=logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
<body>