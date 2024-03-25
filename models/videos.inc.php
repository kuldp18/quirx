<?php

declare(strict_types=1);

// fetch all videos from the database
function fetch_all_videos(object $pdo): array
{
    $query = "SELECT * FROM videos ORDER BY created_at DESC";
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


// fetch video by id
function fetch_video_by_id(object $pdo, string $video_id): array
{
    $query = "SELECT * FROM videos WHERE video_id = :video_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

// fetch ratings from video_id 
function fetch_ratings(object $pdo, int $video_id): array
{
    $query = "SELECT * FROM video_ratings WHERE video_id = :video_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result === false) {
        return [];
    }

    return $result;
}


// fetch average rating from video_id
function fetch_average_rating(object $pdo, int $video_id): float
{
    // fetch ratings_count and ratings_sum
    $query = "SELECT ratings_count, ratings_sum FROM video_ratings WHERE video_id = :video_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result["ratings_count"] == 0) {
        return 0;
    } else {
        return $result["ratings_sum"] / $result["ratings_count"];
    }
}

// fetch video views
function fetch_video_views(object $pdo, int $video_id): int
{
    $query = "SELECT video_views FROM video_ratings WHERE video_id = :video_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result["video_views"];
}

// check if current user has viewed the video

function has_user_viewed_video(object $pdo, int $video_id, int $user_id): bool
{
    $query = "SELECT * FROM user_video_stats WHERE video_id = :video_id AND user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_INT);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result === false) {
        return false;
    }

    return true;
}


// increment video views
function increment_video_views(object $pdo, int $video_id, int $user_id): void
{
    if ($user_id !== null) {
        if (!has_user_viewed_video($pdo, $video_id, $user_id)) {
            $query = "UPDATE video_ratings SET video_views = video_views + 1 WHERE video_id = :video_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":video_id", $video_id, PDO::PARAM_INT);
            $stmt->execute();

            // Insert user_video_stats record to mark the video as viewed by the user
            $query = "INSERT INTO user_video_stats (video_id, user_id) VALUES (:video_id, :user_id)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":video_id", $video_id, PDO::PARAM_INT);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
}
