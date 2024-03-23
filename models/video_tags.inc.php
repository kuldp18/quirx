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
