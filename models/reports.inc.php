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
