<?php
require_once "../includes/db_handler.inc.php";
require_once "../includes/config_session.inc.php";
require_once "../models/users.inc.php";
require_once "../models/reports.inc.php";
require_once "../views/admin_manage_users.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - User Reports</title>
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

    $user_reports = get_all_user_reports($pdo);






    // if (isset($_GET["user_update"]) && $_GET["user_update"] === "success") {
    //     echo <<<HTML
    //       <section class="modal modal--success">
    //         <h1 class="modal__title">User updated successfully!</h1>
    //         <span class="modal__close modal__close--success">X</span>
    //       </section>
    //     HTML;
    // }

    // if (isset($_GET["user_delete"]) && $_GET["user_delete"] === "success") {
    //     echo <<<HTML
    //       <section class="modal modal--success">
    //         <h1 class="modal__title">User soft-deleted successfully!</h1>
    //         <span class="modal__close modal__close--success">X</span>
    //       </section>
    //     HTML;
    // }


    ?>

    <div class="container mt-3">
        <h1 class="mb-4 heading">Admin - Manage User Reports</h1>

        <!-- Display Users Table -->
        <div class="mb-4">
            <h2>List of all reports</h2>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col">Report ID</th>
                        <th scope="col" style="color: rgba(255,0,0,0.85);">Target User ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Reported At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Status</th>
                        <th scope="col">User</th>
                        <th scope="col" style="color: rgba(255,0,0,0.85);">Target User</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- check if report list is not empty -->
                    <?php if (empty($user_reports)) : ?>
                        <tr>
                            <td colspan="10">No reports found</td>
                        </tr>
                    <?php endif; ?>

                    <?php if (!empty($user_reports)) : ?>
                        <!-- loop through report list and display each report -->
                        <?php foreach ($user_reports as $report) : ?>
                            <tr>
                                <td><?= $report['user_report_id'] ?></td>
                                <td><?= $report['target_user_id'] ?></td>
                                <td><?= $report['user_id'] ?></td>
                                <td><?= $report['reason'] ?></td>
                                <td><?= $report['reported_at'] ?></td>
                                <td><?= $report['updated_at'] ?></td>
                                <td><?= $report['status'] ?></td>
                                <td><?= $report['username'] ?></td>
                                <td><?= $report['target_username'] ?></td>
                                <td class="actions">
                                    <a href="<?php
                                                echo "./admin_edit_user_report.php?target_user_id=" . $report['target_user_id'] . "&report_id=" . $report['user_report_id'];
                                                ?>" class="btn btn-primary btn-sm update-btn"><i class="fa-solid fa-pencil"></i>
                                    </a>
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