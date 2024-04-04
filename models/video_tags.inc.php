<?php

declare(strict_types=1);


// create new video tag
function create_new_video_tag(object $pdo, string $new_tag): void
{
    $query = "INSERT INTO video_tags (tag_name) VALUES (:new_tag)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":new_tag", $new_tag, PDO::PARAM_STR);
    $stmt->execute();
}


// get list of video tags from db
function get_video_tags(object $pdo): array
{
    $query = "SELECT * FROM video_tags";
    $stmt = $pdo->query($query);
    $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $tags;
}


// update video tag
function update_video_tag(object $pdo, string $tag_id, string $updated_tag): void
{
    $query = "UPDATE video_tags SET tag_name = :updated_tag, updated_at = CURRENT_TIMESTAMP WHERE tag_id = :tag_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":tag_id", $tag_id, PDO::PARAM_INT);
    $stmt->bindParam(":updated_tag", $updated_tag, PDO::PARAM_STR);
    $stmt->execute();
}

// delete video tag
function delete_video_tag(object $pdo, string $tag_id): void
{
    $query = "DELETE FROM video_tags WHERE tag_id = :tag_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":tag_id", $tag_id, PDO::PARAM_INT);
    $stmt->execute();
}

// get video tags of a video by video_id
function get_video_tags_by_video_id(object $pdo, string $video_id): array
{
    $query = "SELECT tag_name FROM video_tags WHERE tag_id IN (SELECT tag_id FROM video_tag_associations WHERE video_id = :video_id)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_STR);
    $stmt->execute();
    $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $tags;
}
