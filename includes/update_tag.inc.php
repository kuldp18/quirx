<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tag_id = $_POST['tag_id'];
    $updated_tag = $_POST['updated_tag'];


    try {
        require_once "./db_handler.inc.php";
        require_once "../models/video_tags.inc.php";
        require_once "../controllers/video_tags.inc.php";
        require_once "./config_session.inc.php";

        // Error handlers
        $errors = [];

        // check if video tag and video id are not empty
        if (is_video_tag_and_id_empty($tag_id, $updated_tag)) {
            $errors["errors_admin_manage_tags"] = "Tag ID and updated tag name cannot be empty";
            $_SESSION['errors_admin_manage_tags'] = $errors;
        }

        // check if video tag id exists
        else if (!is_video_tag_id_exists($pdo, $tag_id)) {
            $errors["errors_admin_manage_tags"] = "Tag ID does not exist";
            $_SESSION['errors_admin_manage_tags'] = $errors;
        }

        // update video tag
        if (!empty($tag_id) && !empty($updated_tag)) {
            update_video_tag($pdo, $tag_id, $updated_tag);
            header('Location: ../pages/admin_manage_tags.php?success=tag_updated');
        }
        header('Location: ../pages/admin_manage_tags.php');

        // close connection
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Error while updating video tag: " . $e->getMessage());
    }
} else {
    header("Location: ../pages/admin_manage_tags.php");
    exit();
}
