<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get fields 
    $video = $_FILES['video'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $thumbnail = $_FILES['thumbnail'];
    $video_tags = $_POST['video_tags'];


    try {
        require_once "./db_handler.inc.php";
        require_once "../models/upload_video.inc.php";
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
        // check if thumbnail array is not empty and is a valid image, if empty, ignore
        else if (!empty($thumbnail['name']) && is_thumbnail_file_invalid($thumbnail)) {
            $errors['invalid_thumbnail'] = 'Please upload a valid image in .jpg, .jpeg or .png format';
        }
        require_once "./config_session.inc.php";

        if ($errors) {
            $_SESSION["errors_upload_video"] = $errors;
            header('Location: ../pages/upload_video.php');
            die();
        }

        // if video tags are empty, set to empty array
        if (empty($video_tags)) {
            $video_tags = [];
        }

        // Upload video
        upload_video($pdo, $title, $description, $video, $thumbnail, $video_tags);
        header('Location: ../index.php?upload=success');
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
