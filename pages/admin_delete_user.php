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

        <div class="mb-4">
            <h2>Delete user_id: <?php echo $selected_user_id; ?></h2>
            <h1><?php echo 'Are you sure you want to delete ' . $selected_user['username'] . '?' ?>
            </h1>
            <!-- create a form with yes and no -->
            <form action="../includes/admin_delete_user.inc.php" method="POST">
                <input type="hidden" name="user_id" value="<?php echo $selected_user_id; ?>">
                <button type="submit" name="delete_user" class="btn btn-lg btn-danger">Yes</button>
                <a href="./admin_manage_users.php" class="btn btn-lg btn-primary">No</a>
            </form>

        </div>



    </div>

    <!-- Bootstrap JS (optional, only if you need Bootstrap JavaScript features) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>