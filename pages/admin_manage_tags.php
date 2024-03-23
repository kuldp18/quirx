<?php
require_once "../includes/config_session.inc.php";
require_once "../views/video_tags.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Manage Video Tags</title>
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/navbar.css" />
    <link rel="stylesheet" href="../css/admin_manage_tags.css" />
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

    <main class="tags">
        <section class="tags__section">
            <h3 class="tags__section__heading">Create video tag</h3>
            <form action="../includes/create_tag.inc.php" method="post">
                <input type="text" name="new_tag" placeholder="Enter new video tag name">
                <button type="submit" class="tags__btn">Create</button>
            </form>
        </section>
        <section class="tags__section"></section>
        <section class="tags__section"></section>
        <section class="tags__section"></section>
    </main>

    <?php
    check_and_print_video_tag_creation_errors();

    if (isset($_GET["success"]) && $_GET["success"] === "tag_created") {
        echo <<<HTML
          <section class="modal modal--success">
            <h1 class="modal__title">New video tag created!</h1>
            <span class="modal__close modal__close--success">X</span>
          </section>
        HTML;
    }
    ?>

    <script src="../js/close_modal.js"></script>
</body>

</html>