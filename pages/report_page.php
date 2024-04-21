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
    <title>Quirx - Report Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/navbar.css" />
    <link rel="stylesheet" href="../css/report_page.css" />
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

    <main class="container">
        <h1 class="mt-5 mb-5 heading">Submit a report</h1>
        <form action="../includes/submit_report.inc.php" method="post">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="report_type" id="videoReport" value="video" checked>
                <label class="form-check-label" for="videoReport">
                    Report the video
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="report_type" id="userReport" value="user">
                <label class="form-check-label" for="userReport">
                    Report the user who uploaded the video
                </label>
            </div>
            <div class="form-group mt-3">
                <label for="reason">Reason</label>
                <textarea class="form-control" id="reason" name="reason" rows="2" placeholder="describe your issue here.." required></textarea>
            </div>
            <button type="submit" class="btn btn-danger mt-3">Report</button>
        </form>
    </main>



    <script src="../js/close_modal.js"></script>
</body>

</html>