<?php
require_once "../includes/db_handler.inc.php";
require_once "../includes/config_session.inc.php";
require_once "../models/reset_pass.inc.php";
require_once "../views/reset_pass.inc.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quirx - Reset your password</title>
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/reset_pass.css" />
    <link rel="stylesheet" href="../css/navbar.css" />
</head>

<body>
    <?php include_once('../includes/components/navbar.inc.php') ?>
    <?php
    if (isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit();
    }

    if (!isset($_GET['email']) || !isset($_GET['token'])) {
        header("Location: ./login.php?reset=failed");
        exit();
    }

    // verify email and token
    $email = $_GET['email'];
    $token = $_GET['token'];
    $isVerified = verify_email_and_reset_token($pdo, $email, $token);

    if (!$isVerified) {
        header("Location: ./login.php?reset=invalid");
        exit();
    }
    ?>
    <main class="reset">
        <h1 class="reset__title">Reset your password</h1>
        <h3 class="subheading">
            Enter your new strong password below.
        </h3>
        <form class="reset__form" method="post" action="../includes/reset_pass.inc.php">
            <input type="password" name="password" placeholder="Enter new password" />
            <input type="hidden" name="email" value='<?php echo $_GET['email']; ?>' />
            <input type="submit" value="Reset password" class="reset__btn" />
        </form>
    </main>

    <?php

    // if (isset($_GET["reset"]) && $_GET["reset"] === "success") {
    //     echo <<<HTML
    //       <section class="modal modal--success">
    //         <h1 class="modal__title">Password reset link has been sent to your registered email.</h1>
    //         <span class="modal__close modal__close--success">X</span>
    //       </section>
    //     HTML;
    // }
    ?>




    <script src="../js/close_modal.js"></script>
</body>

</html>