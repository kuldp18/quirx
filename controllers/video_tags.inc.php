<?php

declare(strict_types=1);


// check if new video tag is empty
function is_new_tag_empty(string $new_tag): bool
{
    if (empty($new_tag)) {
        return true;
    }
    return false;
}


// check if video tag already exists
function is_video_tag_exists(object $pdo, string $new_tag): bool
{
    $query = "SELECT * FROM video_tags WHERE tag_name = :new_tag";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":new_tag", $new_tag, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return true;
    }
    return false;
}

// check if video tag and video id are not empty
function is_video_tag_and_id_empty(string $tag_id, string $updated_tag): bool
{
    if (empty($tag_id) || empty($updated_tag)) {
        return true;
    }
    return false;
}

// check if the video tag id exists
function is_video_tag_id_exists(object $pdo, string $tag_id): bool
{
    $query = "SELECT * FROM video_tags WHERE tag_id = :tag_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":tag_id", $tag_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return true;
    }
    return false;
}
