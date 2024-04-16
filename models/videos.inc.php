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

// check if video exists
function does_video_exist(object $pdo, string $video_id): bool
{
    $query = "SELECT * FROM videos WHERE video_id = :video_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result === false) {
        return false;
    }

    return true;
}

// fetch creator id from video id
function fetch_creator_id(object $pdo, int $video_id): int
{
    $query = "SELECT user_id FROM videos WHERE video_id = :video_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result["user_id"];
}


// subcribe user to creator in user_subscriptions table: it takes user_id and creator_id
function subscribe_user_to_creator(object $pdo, int $user_id, int $creator_id): void
{
    $query = "INSERT INTO user_subscriptions (user_id, creator_id) VALUES (:user_id, :creator_id)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindParam(":creator_id", $creator_id, PDO::PARAM_INT);
    $stmt->execute();
}

// unsubscribe user from creator in user_subscriptions table: it takes user_id and creator_id
function unsubscribe_user_from_creator(object $pdo, int $user_id, int $creator_id): void
{
    $query = "DELETE FROM user_subscriptions WHERE user_id = :user_id AND creator_id = :creator_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindParam(":creator_id", $creator_id, PDO::PARAM_INT);
    $stmt->execute();
}

// check if user is already subscribed to creator
function is_user_subscribed_to_creator(object $pdo, int $user_id, int $creator_id): bool
{
    $query = "SELECT * FROM user_subscriptions WHERE user_id = :user_id AND creator_id = :creator_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindParam(":creator_id", $creator_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result === false) {
        return false;
    }

    return true;
}

// fetch uploaded videos using user id
function fetch_uploaded_videos(object $pdo, int $user_id): array
{
    $query = "SELECT * FROM videos WHERE user_id = :user_id ORDER BY created_at DESC";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// submit star rating
function submit_star_rating(object $pdo, int $video_id, string $rating): void
{
    // if video is already rated by the user, adjust the ratings_sum and ratings_count accordingly, count should not be incremented and fetch latest ratings_sum and ratings_count from fetch_ratings_sum_and_count function
    $ratings = fetch_ratings_sum_and_count($pdo, $video_id);
    $ratings_sum = $ratings["ratings_sum"];
    $ratings_count = $ratings["ratings_count"];
    if (is_video_rated_by_user($pdo, $video_id, $_SESSION["user_id"])) {
        $previous_rating = fetch_previous_rating_value($pdo, $video_id, $_SESSION["user_id"]);
        $ratings_sum = ($ratings_sum - $previous_rating) + $rating;
    } else {
        $ratings_sum += $rating;
        $ratings_count += 1;
    }

    // query to update video_ratings table
    $query = "UPDATE video_ratings SET ratings_sum = :ratings_sum, ratings_count = :ratings_count WHERE video_id = :video_id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_INT);
    $stmt->bindParam(":ratings_sum", $ratings_sum, PDO::PARAM_INT);
    $stmt->bindParam(":ratings_count", $ratings_count, PDO::PARAM_INT);
    $stmt->execute();

    // mark the video as rated by the user
    mark_video_as_rated($pdo, $video_id, $_SESSION["user_id"], $rating);
}

// if logged in user and uploader of the video are the same, return true
function is_user_video_creator(object $pdo, int $user_id, int $video_id): bool
{
    $query = "SELECT * FROM videos WHERE user_id = :user_id AND video_id = :video_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result === false) {
        return false;
    }

    return true;
}


// update user_video_stats table to mark the video as rated by the user
function mark_video_as_rated(object $pdo, int $video_id, int $user_id, string $rating): void
{
    // update `rated` enum to Y and update rated_at timestamp to current timestamp and also rating_value to the rating
    $query = "UPDATE user_video_stats SET rated = 'Y', rating_value = :rating, rated_at = CURRENT_TIMESTAMP WHERE video_id = :video_id AND user_id = :user_id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_INT);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindParam(":rating", $rating, PDO::PARAM_STR);
    $stmt->execute();
}

// check if video is already rated by the user
function is_video_rated_by_user(object $pdo, int $video_id, int $user_id): bool
{
    $query = "SELECT * FROM user_video_stats WHERE video_id = :video_id AND user_id = :user_id AND rated = 'Y'";
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

// fetch sum and count of ratings for a video
function fetch_ratings_sum_and_count(object $pdo, int $video_id): array
{
    $query = "SELECT ratings_sum, ratings_count FROM video_ratings WHERE video_id = :video_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

// fetch previous rating value of the user
function fetch_previous_rating_value(object $pdo, int $video_id, int $user_id): string
{
    $query = "SELECT rating_value FROM user_video_stats WHERE video_id = :video_id AND user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_INT);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result["rating_value"];
}


// delete video as admin
function delete_video_as_admin(object $pdo, string $video_id): void
{
    // just set is_active to N and update deleted_at timestamp
    $query = "UPDATE videos SET is_active = 'N', deleted_at = CURRENT_TIMESTAMP WHERE video_id = :video_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_STR);
    $stmt->execute();
}

// update video as admin
function update_video_as_admin(object $pdo, string $video_id, string $updated_title, string $updated_desc, string $updated_status): void
{
    $query = "UPDATE videos SET video_title = :video_title, video_desc = :video_desc, is_active = :is_active, updated_at = CURRENT_TIMESTAMP WHERE video_id = :video_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_STR);
    $stmt->bindParam(":video_title", $updated_title, PDO::PARAM_STR);
    $stmt->bindParam(":video_desc", $updated_desc, PDO::PARAM_STR);
    $stmt->bindParam(":is_active", $updated_status, PDO::PARAM_STR);
    $stmt->execute();
}

// edit video as user
function edit_video_as_user(object $pdo, string $video_id, string $updated_title, string $updated_desc): void
{
    // update video details
    $query = "UPDATE videos SET video_title = :video_title, video_desc = :video_desc WHERE video_id = :video_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_STR);
    $stmt->bindParam(":video_title", $updated_title, PDO::PARAM_STR);
    $stmt->bindParam(":video_desc", $updated_desc, PDO::PARAM_STR);
    $stmt->execute();
}


// update video tags
function update_video_tags(object $pdo, string $video_id, array $updated_tags): void
{
    // delete all tags associated with the video
    $query = "DELETE FROM video_tag_associations WHERE video_id = :video_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_STR);
    $stmt->execute();

    // insert new tags
    foreach ($updated_tags as $tag) {
        $query = "INSERT INTO video_tag_associations (video_id, tag_id) VALUES (:video_id, (SELECT tag_id FROM video_tags WHERE tag_name = :tag_name))";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":video_id", $video_id, PDO::PARAM_STR);
        $stmt->bindParam(":tag_name", $tag, PDO::PARAM_STR);
        $stmt->execute();
    }
}

// update video thumbnail
function update_video_thumbnail(object $pdo, string $video_id, array $updated_thumbnail): void
{
    if (!empty($updated_thumbnail)) {

        // fetch necessary detail from the thumbnail array
        $thumbnail_name = $updated_thumbnail['name'];

        // move the thumbnail to the uploads folder
        // encode thumbnail_name into a random string
        $thumbnail_name = bin2hex(random_bytes(10)) . "." . pathinfo($thumbnail_name, PATHINFO_EXTENSION);
        $thumbnail_destination = "../uploads/thumbnails/" . $thumbnail_name;



        // Move the uploaded file
        if (move_uploaded_file($updated_thumbnail['tmp_name'], $thumbnail_destination)) {

            // update the thumbnail in the database
            $query = "UPDATE videos SET video_thumbnail = :thumbnail WHERE video_id = :video_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":video_id", $video_id, PDO::PARAM_STR);
            $stmt->bindParam(":thumbnail", $thumbnail_name, PDO::PARAM_STR);
            $stmt->execute();
        }
    }
}

// update updated_at timestamp
function update_video_timestamp(object $pdo, string $video_id): void
{
    $query = "UPDATE videos SET updated_at = CURRENT_TIMESTAMP WHERE video_id = :video_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_STR);
    $stmt->execute();
}
