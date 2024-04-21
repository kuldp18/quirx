<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updated_video_status = $_POST['updated_video_status'];
    $updated_report_status = $_POST['updated_report_status'];
    $selected_video_id = $_POST['selected_video_id'];
    $selected_report_id = $_POST['selected_report_id'];

    try {
        require_once "./db_handler.inc.php";
        require_once "./config_session.inc.php";
        require_once "../models/videos.inc.php";
        require_once "../models/reports.inc.php";

        $current_video = fetch_video_by_id($pdo, $selected_video_id);


        // take action for the video
        update_video_status($pdo, $selected_video_id, $updated_video_status);
        update_video_report($pdo, $selected_report_id, $updated_report_status);
        header('Location: ../pages/admin_manage_video_reports.php?video_report_update=success');
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Failed to take action for this video: " . $e->getMessage());
    }
} else {
    header('Location: ../index.php');
    die();
}
