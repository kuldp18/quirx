<?php
require_once "../includes/config_session.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quirx - My Profile</title>
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/profile.css" />
    <link rel="stylesheet" href="../css/navbar.css" />
</head>

<body>
    <?php include_once('../includes/components/navbar.inc.php') ?>

    <?php
    // check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        // if not, redirect to login page
        header('Location: ./login.php');
        exit();
    }
    ?>
    <main class="profile">
        <h1 class="profile__title">My Profile</h1>
        <section class="profile__hero">
            <div class="profile__hero__img">
                <img src="../assets/default_pfp.svg" alt="User profile picture" width="200" height="200">
            </div>
            <p class="profile__hero__fullname">
                <?php if (isset($_SESSION['user_fullname'])) {
                    echo $_SESSION['user_fullname'];
                } else {
                    echo "User";
                } ?>
            </p>
            <p class="profile__hero__username">@<span><?php if (isset($_SESSION['user_username'])) {
                                                            echo $_SESSION['user_username'];
                                                        } else {
                                                            echo "username";
                                                        } ?>
                </span></p>
            <p class="profile__hero__email">
                <?php if (isset($_SESSION['user_email'])) {
                    echo $_SESSION['user_email'];
                } else {
                    echo "email";
                } ?>
            </p>

            <?php if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] === 'Y') { ?>
                <p>Role: Admin</p>
            <?php } ?>
        </section>
        <a href="./edit_profile.php" class="profile__btn">Edit Profile</a>
        <a href="#" class="profile__btn">Dashboard</a>
    </main>
</body>

</html>