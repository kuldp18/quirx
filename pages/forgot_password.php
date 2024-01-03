<?php
require_once "../includes/config_session.inc.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quirx - Forgot Password</title>
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/forgot_pass.css" />
    <link rel="stylesheet" href="../css/navbar.css" />
</head>

<body>
    <?php include_once('../includes/components/navbar.inc.php') ?>
    <?php
    if (isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit();
    }
    ?>
    <main class="forgot">
        <h1 class="forgot__title">Forgot your password?</h1>
        <h3 class="subheading">
            Enter your registered email below. We will send you a password reset link shortly.
        </h3>
        <form class="forgot__form" method="post" action="../includes/forgot_pass.inc.php">
            <input type="email" name="email" placeholder="Enter email" />
            <input type="submit" value="Get reset link" class="forgot__btn" />
        </form>
    </main>


    <script src="../js/close_modal.js"></script>
</body>

</html>