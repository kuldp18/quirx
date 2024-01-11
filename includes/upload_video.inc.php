<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get fields 
    $video = $_FILES['video'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $thumbnail = $_FILES['thumbnail'];

    try {
        require_once "./db_handler.inc.php";
        // require_once "../models/register.inc.php";
        require_once "../controllers/upload_video.inc.php";

        // Error handlers
        $errors = [];

        // Check for empty inputs: video and title

        if (is_upload_input_empty($title, $video)) {
            // make sure to use local variables here
            $errors['empty_input'] = 'Please upload a video and provide a title';
        } // Check if uploaded file is not a video
        else if (is_video_file_invalid($video)) {
            $errors['invalid_video'] = 'Please upload a valid video in .mp4 format';
        }

        require_once "./config_session.inc.php";

        if ($errors) {
            $_SESSION["errors_upload_video"] = $errors;
            header('Location: ../pages/upload_video.php');
            die();
        }

        // Upload video
        // close connection
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Error while uploading video: " . $e->getMessage());
    }
} else {
    header("Location: ../pages/upload_video.php");
    exit();
}
