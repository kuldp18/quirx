<?php
require_once "../includes/db_handler.inc.php";
require_once "../includes/config_session.inc.php";
require_once "../models/edit_profile.inc.php";
require_once "../views/edit_profile.inc.php";
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

    $current_user = get_current_user_details($pdo, $_SESSION['user_id'])
    ?>
    <main class="profile">
        <h1 class="profile__title">Edit your profile <br>
            <span class="subheading">Enter values you want to update</span>
        </h1>

        <form action="../includes/edit_profile.inc.php" class="profile__form" method="post">

            <input type="text" name="name" placeholder="<?php
                                                        echo $current_user['full_name'];
                                                        ?>">
            <input type=" email" name="email" placeholder="<?php
                                                            echo $current_user['email'];
                                                            ?>">
            <input type="text" name="username" placeholder="<?php
                                                            echo $current_user['username'];
                                                            ?>">
            <button type="submit" class="profile__btn profile__btn--edit">Update</button>
        </form>

    </main>

    <?php
    check_and_print_edit_profile_errors();
    ?>

    <script src="../js/close_modal.js"></script>
</body>

</html>