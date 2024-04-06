<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_user_id = $_POST['user_id'];

    try {
        require_once "./db_handler.inc.php";
        require_once "./config_session.inc.php";
        // require_once "../models/edit_profile.inc.php";
        // require_once "../models/register.inc.php";
        require_once "../models/users.inc.php";
        // require_once "../controllers/edit_profile.inc.php";
        // require_once "../controllers/register.inc.php";


        // Error handlers

        $errors = [];



        // Check for empty inputs
        if (!empty($selected_user_id) && !does_user_exist($pdo, $selected_user_id)) {
            $errors['user_id'] = 'User does not exist';
        }




        if ($errors) {
            $_SESSION["errors_admin_delete_user"] = $errors;
            header('Location: ../pages/admin_manage_users.php');
            die();
        }

        // delete user as admin (soft delete)
        delete_user_as_admin($pdo, $selected_user_id);
        header('Location: ../pages/admin_manage_users.php?user_delete=success');
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Failed to delete user as admin: " . $e->getMessage());
    }
} else {
    header('Location: ../index.php');
    die();
}
