<?php
require_once "../includes/db_handler.inc.php";
require_once "../includes/config_session.inc.php";
// require_once "../models/users.inc.php";
// require_once "../views/admin_manage_users.php";
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
</head>

<body>

    <?php include_once('../includes/components/navbar.inc.php') ?>
    <?php
    // check is user is not logged in 
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])) {
        // if not, redirect to home page
        header('Location: ../index.php');
        exit();
    }


    // if (isset($_GET["user_update"]) && $_GET["user_update"] === "success") {
    //     echo <<<HTML
    //       <section class="modal modal--success">
    //         <h1 class="modal__title">User updated successfully!</h1>
    //         <span class="modal__close modal__close--success">X</span>
    //       </section>
    //     HTML;
    // }


    ?>

    <div class="container mt-3">
        <h1 class="mb-4 heading">Report Page</h1>




    </div>



    <script src="../js/close_modal.js"></script>
</body>

</html>