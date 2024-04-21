<?php
require_once "../includes/db_handler.inc.php";
require_once "../includes/config_session.inc.php";
require_once "../models/users.inc.php";
// require_once "../views/video_tags.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - User Reports</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/navbar.css" />

    <style>
        .table {
            border: 1px solid whitesmoke;
            font-size: 1.2rem;
        }

        form {
            font-size: 1.25rem;
        }

        label,
        input.form-control,
        select.form-select,
        textarea.form-control,
        option {
            font-size: inherit;
        }
    </style>
</head>

<body>

    <?php include_once('../includes/components/navbar.inc.php') ?>
    <?php
    // check is user is not logged in or is not admin
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
        // if not, redirect to home page
        header('Location: ../index.php');
        exit();
    }
    $target_user_id = $_GET['target_user_id'];
    $user_report_id = $_GET['report_id'];

    $selected_user =  get_user_by_id($pdo, $target_user_id);
    ?>

    <div class="container mt-3">
        <h1 class="mb-4 heading">Admin - Manage User Report</h1>

        <div class="mb-4" id="updateUserForm">
            <h2>Update User: <?php echo $target_user_id; ?></h2>
            <form method="POST" action="../includes/admin_edit_user_report.inc.php">
                <div class="mb-3">
                    <label for="updateActive" class="form-label">User status</label>
                    <select class="form-select" name="updated_user_status">
                        <option value="Y" <?php echo $selected_user['is_active'] === 'Y' ? 'selected' : '' ?>>Active</option>
                        <option value="N" <?php echo $selected_user['is_active'] === 'N' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="updateStatus" class="form-label">Report status</label>
                    <select class="form-select" name="updated_report_status">
                        <option value="resolved" selected>Resolved</option>
                        <option value="under_review">Under Review</option>
                        <option value="created">Created</option>
                    </select>
                </div>
                <input type="hidden" name="selected_user_id" value="<?php echo $target_user_id; ?>">
                <input type="hidden" name="selected_report_id" value="<?php echo $user_report_id; ?>">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="./admin_manage_user_reports.php" class="btn btn-secondary" id="cancelUpdate">Cancel</a>
            </form>
        </div>



    </div>

    <!-- Bootstrap JS (optional, only if you need Bootstrap JavaScript features) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>