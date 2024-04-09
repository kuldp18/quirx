<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updated_title = $_POST['updated_title'];
    $updated_desc = $_POST['updated_desc'];
    $updated_status = $_POST['updated_status']; // active or inactive
    $selected_video_id = $_POST['selected_video_id'];

    try {
        require_once "./db_handler.inc.php";
        require_once "./config_session.inc.php";
        require_once "../models/videos.inc.php";

        $current_video = fetch_video_by_id($pdo, $selected_video_id);

        // Error handlers

        $errors = [];



        // Check for empty inputs
        if (empty($updated_title) && empty($updated_desc)) {
            // make sure to use local variables here
            $errors["empty_input"] = "Please fill at least one field to update this video";
        }

        // the fields that are still empty should be filled with the old values
        if (empty($updated_title)) {
            $updated_title = $current_video['video_title'];
        }
        if (empty($updated_desc)) {
            $updated_desc = $current_video['video_desc'];
        }




        if ($errors) {
            $_SESSION["errors_admin_edit_video"] = $errors;
            header('Location: ../pages/admin_manage_videos.php');
            die();
        }

        // update video as admin
        update_video_as_admin($pdo, $selected_video_id, $updated_title, $updated_desc, $updated_status);
        header('Location: ../pages/admin_manage_videos.php?video_update=success');
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Failed to update video as admin: " . $e->getMessage());
    }
} else {
    header('Location: ../index.php');
    die();
}
