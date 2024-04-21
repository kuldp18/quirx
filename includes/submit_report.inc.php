<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $report_type = $_POST['report_type']; // video or user
    $reason = $_POST['reason']; // reason for report
    $current_video_id = $_POST['video_id']; // video id

    try {
        require_once "./db_handler.inc.php";
        require_once "../models/videos.inc.php";
        require_once "../models/reports.inc.php";
        require_once "./config_session.inc.php";

        $current_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $target_user_id = fetch_creator_id($pdo, $current_video_id); // get the creator id of the video

        // Error handlers
        $errors = [];

        // check if report_type and reason are empty
        if (empty($report_type) || empty($reason)) {
            $errors[] = "Please fill in all fields";
        }

        // check if video exists
        else if (!does_video_exist($pdo, $current_video_id)) {
            $errors[] = "Video does not exist";
        }

        if ($errors) {
            $_SESSION["errors_report_page"] = $errors;
            header('Location: ../pages/report_page.php?video_id=' . $current_video_id);
            die();
        }

        // insert report into database based on report type

        if ($report_type === 'video') {
            submit_video_report($pdo, $current_video_id, $current_user_id, $reason);
            header('Location: ../pages/video_page.php?video_id=' . $current_video_id . '&video_report=success');
        } else if ($report_type === 'user') {
            submit_user_report($pdo, $target_user_id, $current_user_id, $reason);
            header('Location: ../pages/video_page.php?video_id=' . $current_video_id . '&user_report=success');
        }

        // close connection
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Error while submitting your report: " . $e->getMessage());
    }
} else {
    header('Location: ../pages/report_page.php?video_id=' . $current_video_id);
    exit();
}
