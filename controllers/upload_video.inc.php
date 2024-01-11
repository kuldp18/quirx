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

// check if thumbnail is not empty and is a valid image
function is_thumbnail_file_invalid(array $thumbnail): bool
{
    $thumbnail_name = $thumbnail['name'];
    $thumbnail_size = $thumbnail['size'];
    $thumbnail_error = $thumbnail['error'];

    $thumbnail_ext = explode('.', $thumbnail_name);
    $thumbnail_actual_ext = strtolower(end($thumbnail_ext));

    $allowed = ['jpg', 'jpeg', 'png'];

    if (in_array($thumbnail_actual_ext, $allowed)) {
        if ($thumbnail_error === 0 && $thumbnail_size > 0) {
            return false;
        } else {
            return true;
        }
    } else {
        return true;
    }
}
