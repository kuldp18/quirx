<?php

declare(strict_types=1);

// is edit video form empty
function is_edit_video_form_empty(string $title, string $description, array $tags, array $thumbnail): bool
{
    return empty($title) && empty($description) && empty($tags) && empty($thumbnail);
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
