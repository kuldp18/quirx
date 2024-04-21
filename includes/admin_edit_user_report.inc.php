<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updated_user_status = $_POST['updated_user_status'];
    $updated_report_status = $_POST['updated_report_status'];
    $selected_user_id = $_POST['selected_user_id'];
    $selected_report_id = $_POST['selected_report_id'];

    try {
        require_once "./db_handler.inc.php";
        require_once "./config_session.inc.php";
        require_once "../models/users.inc.php";
        require_once "../models/reports.inc.php";



        // take action for the video
        update_user_status($pdo, $selected_user_id, $updated_user_status);
        update_user_report($pdo, $selected_report_id, $updated_report_status);
        header('Location: ../pages/admin_manage_user_reports.php?user_report_update=success');
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Failed to take action for this user: " . $e->getMessage());
    }
} else {
    header('Location: ../index.php');
    die();
}
