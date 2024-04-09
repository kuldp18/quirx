<?php
require_once "../includes/db_handler.inc.php";
require_once "../includes/config_session.inc.php";
require_once "../models/users.inc.php";
require_once "../views/admin_manage_users.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - User Management</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/navbar.css" />

    <style>
        .table {
            border: 1px solid whitesmoke;
            font-size: 1.2rem;
        }

        .btn {
            width: 25px;
            height: 25px;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .actions {
            display: flex;
            flex-direction: column;
            gap: 5px;
            justify-content: center;
            align-items: center;
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
    $user_name = $_SESSION['user_username'];

    $user_list = get_all_users($pdo);

    check_and_print_admin_edit_user_errors();
    check_and_print_admin_delete_user_errors();

    if (isset($_GET["user_update"]) && $_GET["user_update"] === "success") {
        echo <<<HTML
          <section class="modal modal--success">
            <h1 class="modal__title">User updated successfully!</h1>
            <span class="modal__close modal__close--success">X</span>
          </section>
        HTML;
    }

    if (isset($_GET["user_delete"]) && $_GET["user_delete"] === "success") {
        echo <<<HTML
          <section class="modal modal--success">
            <h1 class="modal__title">User soft-deleted successfully!</h1>
            <span class="modal__close modal__close--success">X</span>
          </section>
        HTML;
    }


    ?>

    <div class="container mt-3">
        <h1 class="mb-4 heading">Admin - Manage Users</h1>

        <!-- Display Users Table -->
        <div class="mb-4">
            <h2>List of all users</h2>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Deleted_at</th>
                        <th scope="col">Updated_at</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">Role</th>
                        <th scope="col">Active</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- check if user list is not empty -->
                    <?php if (empty($user_list)) : ?>
                        <tr>
                            <td colspan="10">No users found</td>
                        </tr>
                    <?php endif; ?>

                    <?php if (!empty($user_list)) : ?>
                        <!-- loop through user list and display each user -->

                        <?php foreach ($user_list as $user) : ?>
                            <tr>
                                <td><?php echo $user['user_id'] !== null ? htmlspecialchars($user['user_id']) : 'null'; ?></td>
                                <td><?php echo $user['created_at'] !== null ? htmlspecialchars($user['created_at']) : 'null'; ?></td>
                                <td><?php echo $user['deleted_at'] !== null ? htmlspecialchars($user['deleted_at']) : 'null'; ?></td>
                                <td><?php echo $user['updated_at'] !== null ? htmlspecialchars($user['updated_at']) : 'null'; ?></td>
                                <td><?php echo $user['full_name'] !== null ? htmlspecialchars($user['full_name']) : 'null'; ?></td>
                                <td><?php echo $user['email'] !== null ? htmlspecialchars($user['email']) : 'null'; ?></td>
                                <td><?php echo $user['username'] !== null ? htmlspecialchars($user['username']) : 'null'; ?></td>
                                <td><?php echo $user['role'] !== null ? htmlspecialchars($user['role']) : 'null'; ?></td>
                                <td><?php echo $user['is_active'] !== null ? htmlspecialchars($user['is_active']) : 'null'; ?></td>
                                <td class="actions">
                                    <a href="<?php
                                                echo "./admin_edit_user.php?user_id=" . $user['user_id'];
                                                ?>" class="btn btn-primary btn-sm update-btn"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="<?php echo "./admin_delete_user.php?user_id=" . $user["user_id"]; ?>" class="btn btn-danger btn-sm delete-btn"><i class="fa-solid fa-trash"></i></a>
                                    <a href="#" class="btn btn-success btn-sm more-btn"><i class="fa-solid fa-ellipsis"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>


    </div>

    <!-- Bootstrap JS (optional, only if you need Bootstrap JavaScript features) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="../js/close_modal.js"></script>
</body>

</html>