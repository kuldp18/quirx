<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_tag = $_POST['new_tag'];


    try {
        require_once "./db_handler.inc.php";
        require_once "../models/video_tags.inc.php";
        require_once "../controllers/video_tags.inc.php";
        require_once "./config_session.inc.php";

        // Error handlers
        $errors = [];

        // check if new tag is empty
        if (is_new_tag_empty($new_tag)) {
            $errors[] = "New tag cannot be empty";
        }

        // check if tag already exists
        else if (is_video_tag_exists($pdo, $new_tag)) {
            $errors[] = "Tag already exists";
        }


        if ($errors) {
            $_SESSION["errors_admin_manage_tags"] = $errors;
            header('Location: ../pages/admin_manage_tags.php');
            die();
        }

        // Create new video tag

        create_new_video_tag($pdo, $new_tag);



        header('Location: ../pages/admin_manage_tags.php?success=tag_created');
        // close connection
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Error while creating new video tag: " . $e->getMessage());
    }
} else {
    header("Location: ../pages/admin_manage_tags.php");
    exit();
}
