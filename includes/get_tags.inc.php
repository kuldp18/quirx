<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    try {
        require_once "./db_handler.inc.php";
        require_once "../models/video_tags.inc.php";
        require_once "../controllers/video_tags.inc.php";
        require_once "./config_session.inc.php";

        // Error handlers
        $errors = [];

        // get video tags
        $tags = get_video_tags($pdo);

        if (empty($tags)) {
            $errors["errors_admin_manage_tags"] = "No tags found or error while fetching tags";
        } else {
            $_SESSION['list_tags'] = $tags;
        }
        header('Location: ../pages/admin_manage_tags.php?success=tags_fetched');
        // close connection
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Error while getting video tags: " . $e->getMessage());
    }
} else {
    header("Location: ../pages/admin_manage_tags.php");
    exit();
}
