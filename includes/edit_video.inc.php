<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_title = trim($_POST['title']);
    $new_description = trim($_POST['description']);
    $new_tags_arr = $_POST['tags'];
    $new_thumbnail_arr = $_FILES['thumbnail'];
    $video_id = $_POST['video_id'];

    try {
        require_once "./db_handler.inc.php";
        require_once "./config_session.inc.php";
        require_once "../models/videos.inc.php";
        require_once "../models/video_tags.inc.php";
        require_once "../controllers/edit_video.inc.php";

        $current_video_details = !empty($video_id) ? fetch_video_by_id($pdo, $video_id) : [];
        $current_video_tags = get_video_tags_by_video_id($pdo, $video_id);


        // Error handlers

        $errors = [];



        // Check for empty inputs
        if (is_edit_video_form_empty($new_title, $new_description, $new_tags_arr, $new_thumbnail_arr)) {
            // make sure to use local variables here
            $errors["empty_input"] = "Please fill at least one field to update your profile";
        }


        // the fields that are still empty should be filled with the old values
        if (empty($new_title)) {
            $new_title = $current_video_details['video_title'];
        }
        if (empty($new_description)) {
            $new_description = $current_video_details['video_desc'];
        }
        if (empty($new_tags_arr)) {
            $new_tags_arr = $current_video_tags;
        }

        if ($errors) {
            $_SESSION["errors_edit_video"] = $errors;
            header('Location: ../pages/edit_video.php?video_id=' . $video_id);
            die();
        }

        // edit video
        edit_video_as_user($pdo, $video_id, $new_title, $new_description);
        // update video tags
        if (!empty($new_tags_arr)) {
            update_video_tags($pdo, $video_id, $new_tags_arr);
        }
        // update video thumbnail
        if (!empty($new_thumbnail_arr)) {
            update_video_thumbnail($pdo, $video_id, $new_thumbnail_arr);
        }

        // update timestamp
        update_video_timestamp($pdo, $video_id);


        header('Location: ../pages/user_dashboard.php?video_updated=success');

        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header('Location: ../index.php');
    die();
}
