<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $current_video_id = $_POST['video_id'];

    try {
        require_once "./db_handler.inc.php";
        require_once "../models/videos.inc.php";
        // require_once "../controllers/video_tags.inc.php";
        require_once "./config_session.inc.php";

        $current_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $creator_id = fetch_creator_id($pdo, $current_video_id);

        // Error handlers
        $errors = [];

        // check if user is logged in
        if ($current_user_id === null) {
            $errors[] = "Please login to subscribe";
        }

        // check if video exists
        else if (!does_video_exist($pdo, $current_video_id)) {
            $errors[] = "Video does not exist";
        }

        if ($errors) {
            $_SESSION["errors_video_subscriptions"] = $errors;
            header('Location: ../pages/video_page.php?video_id=' . $current_video_id);
            die();
        }


        // user is not subscribed to creator
        if (!is_user_subscribed_to_creator($pdo, $current_user_id, $creator_id) && $current_user_id !== null) {
            // subcribe user to creator
            if ($current_user_id !== $creator_id) {
                subscribe_user_to_creator($pdo, $current_user_id, $creator_id);
                header('Location: ../pages/video_page.php?video_id=' . $current_video_id . '&success=user_subscribed');
            } else {
                header('Location: ../pages/video_page.php?video_id=' . $current_video_id . '&error=self_subscribe');
            }
        }
        // user is already subscribed to creator
        else if (is_user_subscribed_to_creator($pdo, $current_user_id, $creator_id) && $current_user_id !== null) {
            // unsubscribe user from creator
            unsubscribe_user_from_creator($pdo, $current_user_id, $creator_id);
            header('Location: ../pages/video_page.php?video_id=' . $current_video_id . '&success=user_unsubscribed');
        }

        // close connection
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Error while subscribing: " . $e->getMessage());
    }
} else {
    header('Location: ../pages/video_page.php?video_id=' . $current_video_id);
    exit();
}
