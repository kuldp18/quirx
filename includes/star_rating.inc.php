<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $rating = $data->rating;
    $video_id = $data->video_id;


    try {
        require_once "./db_handler.inc.php";
        require_once "../models/videos.inc.php";
        require_once "./config_session.inc.php";

        // Error handlers
        $errors = [];


        // check if user is logged in
        if (!isset($_SESSION["user_id"])) {
            $errors[] = "You need to be logged in to rate this video";
        }


        // check if rating is not empty or zero
        else if (empty($rating) || $rating == 0) {
            $errors[] = "Rating cannot be empty or zero";
        }

        // check if video is not empty and does exist
        else if (empty($video_id) || !fetch_video_by_id($pdo, $video_id)) {
            $errors[] = "Video does not exist";
        }

        // check if user is the creator of the video
        else if (is_user_video_creator($pdo, $_SESSION["user_id"], $video_id)) {
            $errors[] = "You cannot rate your own video";
        }



        if ($errors) {
            $_SESSION["error_star_rating"] = $errors;
            die();
        }

        // Rate video

        submit_star_rating($pdo, $video_id, $rating);

        header('Location: ../pages/video_page.php?video_id=' . $video_id . '&success=video_rated');
        // close connection
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Error while rating this video: " . $e->getMessage());
    }
} else {
    header("Location: ../pages/video_page.php?video_id=" . $video_id);
    exit();
}
