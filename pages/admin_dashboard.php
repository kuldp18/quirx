<?php
require_once "../includes/config_session.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quirx - Admin Dashboard</title>
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/navbar.css" />
</head>

<body>
    <?php include_once('../includes/components/navbar.inc.php') ?>
    <?php
    // check is user is not logged in or is not admin
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_is_admin']) || $_SESSION['user_is_admin'] !== 'Y') {
        // if not, redirect to home page
        header('Location: ../index.php');
        exit();
    }
    $user_name = $_SESSION['user_username'];

    // print user name if user is admin
    echo '<h1>Dear ' . $user_name . ', you are an admin!</h1>';
    ?>

</body>

</html>