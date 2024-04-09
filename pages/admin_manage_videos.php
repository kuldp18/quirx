<?php
require_once "../includes/db_handler.inc.php";
require_once "../includes/config_session.inc.php";
require_once "../models/videos.inc.php";
require_once "../views/admin_manage_videos.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Video Management</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/navbar.css" />

    <style>
        .table {
            border: 1px solid whitesmoke;
            font-size: 1.2rem;
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

    $video_list = fetch_all_videos($pdo);

    check_and_print_admin_delete_video_errors();
    check_and_print_admin_edit_video_errors();

    if (isset($_GET["video_update"]) && $_GET["video_update"] === "success") {
        echo <<<HTML
          <section class="modal modal--success">
            <h1 class="modal__title">Video updated successfully!</h1>
            <span class="modal__close modal__close--success">X</span>
          </section>
        HTML;
    }

    if (isset($_GET["video_delete"]) && $_GET["video_delete"] === "success") {
        echo <<<HTML
          <section class="modal modal--success">
            <h1 class="modal__title">Video soft-deleted successfully!</h1>
            <span class="modal__close modal__close--success">X</span>
          </section>
        HTML;
    }


    ?>

    <div class="container mt-3">
        <h1 class="mb-4 heading">Admin - Manage Videos</h1>

        <!-- Display videos Table -->
        <div class="mb-4">
            <h2>List of all videos</h2>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col">Video_id</th>
                        <th scope="col">User_id</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Deleted_at</th>
                        <th scope="col">Updated_at</th>
                        <th scope="col">Title</th>
                        <th scope="col">Active</th>
                        <th scope="col">Views</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- check if video list is not empty -->
                    <?php if (empty($video_list)) : ?>
                        <tr>
                            <td colspan="10">No videos found</td>
                        </tr>
                    <?php endif; ?>

                    <?php if (!empty($video_list)) : ?>
                        <!-- loop through videos list and display each user -->

                        <?php foreach ($video_list as $video) : ?>
                            <tr>
                                <td><?php echo $video['video_id'] !== null ? htmlspecialchars($video['video_id']) : 'null'; ?></td>
                                <td><?php echo $video['user_id'] !== null ? htmlspecialchars($video['user_id']) : 'null'; ?></td>
                                <td><?php echo $video['created_at'] !== null ? htmlspecialchars($video['created_at']) : 'null'; ?></td>
                                <td><?php echo $video['deleted_at'] !== null ? htmlspecialchars($video['deleted_at']) : 'null'; ?></td>
                                <td><?php echo $video['updated_at'] !== null ? htmlspecialchars($video['updated_at']) : 'null'; ?></td>
                                <td><?php echo $video['video_title'] !== null ? htmlspecialchars($video['video_title']) : 'null'; ?></td>
                                <td><?php echo $video['is_active'] !== null ? htmlspecialchars($video['is_active']) : 'null'; ?></td>
                                <td><?php echo fetch_video_views($pdo, $video['video_id']) ?></td>
                                <td><?php echo fetch_average_rating($pdo, $video['video_id']) ?></td>
                                <td>
                                    <a href="<?php
                                                echo "./admin_edit_video.php?video_id=" . $video['video_id'];
                                                ?>" class="btn btn-primary btn-sm update-btn">Edit</a>
                                    <a href="<?php echo "./admin_delete_video.php?video_id=" . $video["video_id"]; ?>" class="btn btn-danger btn-sm delete-btn">Delete</a>
                                    <a href="#" class="btn btn-success btn-sm more-btn">More</a>
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