<?php

declare(strict_types=1);

// fetch all videos from the database
function fetch_all_videos(object $pdo): array
{
    $query = "SELECT * FROM videos";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// fetch username from video id
function fetch_username_from_video_id(object $pdo, string $video_id): string
{
    $query = "SELECT username FROM users WHERE user_id = (SELECT user_id FROM videos WHERE video_id = :video_id)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result["username"];
}
