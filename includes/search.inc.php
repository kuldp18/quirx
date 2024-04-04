<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $search_query = $_GET['search_query'];


    try {
        require_once "./db_handler.inc.php";
        require_once "../models/video_search.inc.php";
        require_once "./config_session.inc.php";

        // Error handlers
        $errors = [];

        // check if search query is empty
        if (empty($search_query)) {
            $errors[] = "Search query cannot be empty";
        }



        if ($errors) {
            $_SESSION["errors_search"] = $errors;
            header('Location: ../index.php');
            die();
        }

        // Search for videos

        $videos = search_videos($pdo, $search_query);


        // set session for search results
        $_SESSION['search_results'] = $videos;
        $_SESSION['search_query'] = $search_query;
        header('Location: ../index.php?search_query=' . $search_query);
        // close connection
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Error while searching: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    exit();
}
