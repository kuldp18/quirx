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
