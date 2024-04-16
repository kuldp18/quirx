<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_video_id = $_POST['video_id'];

    try {
        require_once "./db_handler.inc.php";
        require_once "./config_session.inc.php";
        require_once "../models/videos.inc.php";



        // Error handlers

        $errors = [];



        // Check for empty inputs
        if (!empty($selected_video_id) && !does_video_exist($pdo, $selected_video_id)) {
            $errors['video_id'] = 'Video does not exist';
        }




        if ($errors) {
            $_SESSION["errors_delete_video"] = $errors;
            header('Location: ../pages/user_dashboard.php');
            die();
        }

        // delete video as admin (soft delete)
        delete_video_as_admin($pdo, $selected_video_id);
        header('Location: ../pages/user_dashboard.php?video_deleted=success');
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Failed to delete your video: " . $e->getMessage());
    }
} else {
    header('Location: ../index.php');
    die();
}
