<?php

declare(strict_types=1);

// upload video to db
function upload_video(object $pdo, string $title, string $description, array $video, array $thumbnail)
{
    // video is already checked for empty and invalid file
    $video_name = $video['name'];
    $video_tmp_name = $video['tmp_name'];

    // get thumbnail details only if it exists
    if ($thumbnail['size'] > 0) {
        $thumbnail_name = $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_size = $thumbnail['size'];
        $thumbnail_error = $thumbnail['error'];
    } else {
        $thumbnail_name = null;
        $thumbnail_tmp_name = null;
        $thumbnail_size = null;
        $thumbnail_error = null;
    }

    // get user id
    $user_id = $_SESSION['user_id'];

    // upload mp4 video, we don't need to check for extension here
    $video_ext = explode('.', $video_name);
    $video_actual_ext = strtolower(end($video_ext));
    $video_name_new = uniqid('', true) . "." . $video_actual_ext;
    $video_destination = "../uploads/videos/" . $video_name_new;

    // upload thumbnail only if it exists
    if ($thumbnail_error === 0 && $thumbnail_size > 0) {
        $thumbnail_ext = explode('.', $thumbnail_name);
        $thumbnail_actual_ext = strtolower(end($thumbnail_ext));
        $thumbnail_name_new = uniqid('', true) . "." . $thumbnail_actual_ext;
        $thumbnail_destination = "../uploads/thumbnails/" . $thumbnail_name_new;
    } else {
        $thumbnail_name_new = null;
        $thumbnail_destination = null;
    }

    // move uploaded files to destination
    move_uploaded_file($video_tmp_name, $video_destination);

    // move thumbnail only if it exists
    if ($thumbnail_error === 0 && $thumbnail_size > 0) {
        move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination);
    }

    // insert video details to db
    $query = "INSERT INTO videos (user_id, video_title, video_desc, video_path, video_thumbnail) VALUES (:user_id, :title, :description, :video, :thumbnail)";

    // set description to null if empty
    if (empty($description)) {
        $description = null;
    }

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindParam(":title", $title, PDO::PARAM_STR);
    $stmt->bindParam(":description", $description, PDO::PARAM_STR);
    $stmt->bindParam(":video", $video_name_new, PDO::PARAM_STR);
    $stmt->bindParam(":thumbnail", $thumbnail_name_new, PDO::PARAM_STR);

    // execute the statement
    $stmt->execute();

    // get the last inserted video id and initialize video_ratings table
    $video_id = $pdo->lastInsertId();
    init_video_ratings($pdo, $video_id);
}

// update video_ratings table
function init_video_ratings(object $pdo, string $video_id)
{
    $query = "INSERT INTO video_ratings (video_id) VALUES (:video_id)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":video_id", $video_id, PDO::PARAM_STR);
    $stmt->execute();
}
