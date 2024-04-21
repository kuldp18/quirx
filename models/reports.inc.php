<?php

declare(strict_types=1);


// submit video report
function submit_video_report(object $pdo, int $video_id, int $user_id, string $reason): void
{
    $query = "INSERT INTO video_reports (video_id, user_id, reason) VALUES (:video_id, :user_id, :reason)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_INT);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindParam(":reason", $reason, PDO::PARAM_STR);
    $stmt->execute();
}

// submit user report
function submit_user_report(object $pdo, int $target_user_id, int $user_id, string $reason): void
{
    $query = "INSERT INTO user_reports (target_user_id, user_id, reason) VALUES (:target_user_id, :user_id, :reason)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":target_user_id", $target_user_id, PDO::PARAM_INT);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindParam(":reason", $reason, PDO::PARAM_STR);
    $stmt->execute();
}

// get all video reports
function get_all_video_reports(object $pdo): array
{
    // video_reports has fields: video_report_id, video_id, user_id, reason, reported_at, updated_at, status, video_id is foreign key to videos table, user_id is foreign key to users table
    $query = "SELECT video_reports.video_report_id, video_reports.video_id, video_reports.user_id, video_reports.reason, video_reports.reported_at, video_reports.updated_at, video_reports.status, videos.video_title, users.username FROM video_reports JOIN videos ON video_reports.video_id = videos.video_id JOIN users ON video_reports.user_id = users.user_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

// update video report as admin 
function update_video_report(object $pdo, int $video_report_id, string $status): void
{
    $query = "UPDATE video_reports SET status = :status, updated_at = CURRENT_TIMESTAMP WHERE video_report_id = :video_report_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":status", $status, PDO::PARAM_STR);
    $stmt->bindParam(":video_report_id", $video_report_id, PDO::PARAM_INT);
    $stmt->execute();
}
