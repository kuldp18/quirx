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
    <link rel="stylesheet" href="../css/admin_dashboard.css" />
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
    ?>

    <main class="admin_dashboard">
        <div class="dashboard_container">
            <h1 class="heading">Admin Dashboard</h1>
            <p class="subheading">Welcome, <?php echo $user_name; ?>!</p>
        </div>
        <h2 class="subheading subheading--bigger">Admin Actions</h2>
        <section class="admin__actions">
            <a href="./admin_manage_tags.php" class="admin__actions__link">Manage Video Tags</a>
            <a href="./admin_manage_users.php" class="admin__actions__link">Manage Users</a>
        </section>
    </main>

</body>

</html>