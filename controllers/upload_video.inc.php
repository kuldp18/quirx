<?php

declare(strict_types=1);


// check video file and title are not empty
function is_upload_input_empty(string $title, array $video): bool
{
    if (empty($title) || empty($video)) {
        return true;
    }
    return false;
}

// check if uploaded file is not a video in .mp4
function is_video_file_invalid(array $video): bool
{
    $video_name = $video['name'];
    $video_size = $video['size'];
    $video_error = $video['error'];

    $video_ext = explode('.', $video_name);
    $video_actual_ext = strtolower(end($video_ext));

    $allowed = ['mp4'];

    if (in_array($video_actual_ext, $allowed)) {
        if ($video_error === 0 && $video_size > 0) {
            return false;
        } else {
            return true;
        }
    } else {
        return true;
    }
}
