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
    <title>Admin Dashboard - User Management</title>
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
    $selected_user_id = $_GET['user_id'];
    $selected_user = get_user_by_id($pdo, $selected_user_id);



    ?>

    <div class="container mt-3">
        <h1 class="mb-4 heading">Admin - Manage Users</h1>

        <!-- Update User Form (Hidden by default) -->
        <div class="mb-4" id="updateUserForm">
            <h2>Update User: <?php echo $selected_user_id; ?></h2>
            <form method="POST" action="../includes/admin_edit_user.inc.php">
                <div class="mb-3">
                    <label for="updateName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="updateName" placeholder="<?php echo $selected_user['full_name'] ?>" name="updated_name">
                </div>
                <div class="mb-3">
                    <label for="updateEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="updateEmail" placeholder="<?php echo $selected_user['email'] ?>" name="updated_email">
                </div>
                <div class="mb-3">
                    <label for="updateUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="updateUsername" placeholder="<?php echo $selected_user['username'] ?>" name="updated_username">
                </div>
                <div class="mb-3">
                    <label for="updateRole" class="form-label">Role</label>
                    <select class="form-select" name="updated_role">
                        <option value="admin" <?php echo $selected_user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="user" <?php echo $selected_user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="updateActive" class="form-label">Active</label>
                    <select class="form-select" name="updated_status">
                        <option value="Y" <?php echo $selected_user['is_active'] === 'Y' ? 'selected' : '' ?>>Yes</option>
                        <option value="N" <?php echo $selected_user['is_active'] === 'N' ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
                <input type="hidden" name="selected_user_id" value="<?php echo $selected_user_id; ?>">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" id="cancelUpdate">Cancel</button>
            </form>
        </div>



    </div>

    <!-- Bootstrap JS (optional, only if you need Bootstrap JavaScript features) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>