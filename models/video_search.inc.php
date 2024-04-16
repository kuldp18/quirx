<?php

declare(strict_types=1);


// search videos using search query
function search_videos(object $pdo, string $search_query): array
{
    $query = "SELECT * FROM videos WHERE LOWER(video_title) LIKE LOWER(:search_query) AND is_active = 'Y'";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['search_query' => "%$search_query%"]);
    $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $videos;
}
