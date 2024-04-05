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


    ?>

    <div class="container mt-3">
        <h1 class="mb-4 heading">Admin - Manage Users</h1>

        <!-- Update User Form (Hidden by default) -->
        <div class="mb-4 d-none" id="updateUserForm">
            <h2>Update User</h2>
            <form>
                <div class="mb-3">
                    <label for="updateName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="updateName" placeholder="Enter name">
                </div>
                <div class="mb-3">
                    <label for="updateEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="updateEmail" placeholder="Enter email">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" id="cancelUpdate">Cancel</button>
            </form>
        </div>


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
                                <td>
                                    <button class="btn btn-primary btn-sm update-btn">Edit</button>
                                    <button class="btn btn-danger btn-sm delete-btn">Delete</button>
                                    <button class="btn btn-success btn-sm more-btn">More</button>
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

    <script>
        // JavaScript for toggling update user form
        $(document).ready(function() {
            // Show update user form on edit button click
            $('.btn-primary').click(function() {
                $('#updateUserForm').removeClass('d-none');
            });
            // Hide update user form on cancel button click
            $('#cancelUpdate').click(function() {
                $('#updateUserForm').addClass('d-none');
            });
        });
    </script>
</body>

</html>