<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updated_name = $_POST['updated_name'];
    $updated_email = $_POST['updated_email'];
    $updated_username = $_POST['updated_username'];
    $updated_role = $_POST['updated_role'];
    $updated_status = $_POST['updated_status']; // active or inactive
    $selected_user_id = $_POST['selected_user_id'];

    try {
        require_once "./db_handler.inc.php";
        require_once "./config_session.inc.php";
        require_once "../models/edit_profile.inc.php";
        require_once "../models/register.inc.php";
        require_once "../models/users.inc.php";
        require_once "../controllers/edit_profile.inc.php";
        require_once "../controllers/register.inc.php";

        $current_user = get_current_user_details($pdo, $selected_user_id);

        // Error handlers

        $errors = [];



        // Check for empty inputs
        if (empty($updated_name) && empty($updated_email) && empty($updated_username)) {
            // make sure to use local variables here
            $errors["empty_input"] = "Please fill at least one field to update your profile";
        } else {
            // Check if at least one field is different from the old one
            if (!is_email_new($updated_email, $current_user['email']) && !is_username_new($updated_username, $current_user['username']) && !is_name_new($updated_name, $current_user['full_name'])) {
                $errors["no_changes"] = "No changes were made";
            }

            // Check if email is invalid
            else if (is_email_invalid($updated_email) && !empty($updated_email)) {
                $errors["invalid_email"] = "Please enter a valid email address";
            }

            // Check if username is taken
            else if (is_username_taken($pdo, $updated_username) && !empty($updated_username)) {
                $errors["username_taken"] = "Username is already taken";
            }

            // Check if email is already registered
            else if (is_email_registered($pdo, $updated_email) && !empty($updated_email)) {
                $errors["email_taken"] = "Email is already registered";
            }
        }

        // the fields that are still empty should be filled with the old values
        if (empty($updated_name)) {
            $updated_name = $current_user['full_name'];
        }
        if (empty($updated_email)) {
            $updated_email = $current_user['email'];
        }
        if (empty($updated_username)) {
            $updated_username = $current_user['username'];
        }



        if ($errors) {
            $_SESSION["errors_admin_edit_user"] = $errors;
            header('Location: ../pages/admin_manage_users.php');
            die();
        }

        // update user as admin
        update_user_as_admin($pdo, $selected_user_id, $updated_name, $updated_email, $updated_username, $updated_role, $updated_status);
        header('Location: ../pages/admin_manage_users.php?user_update=success');


        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Failed to update user as admin: " . $e->getMessage());
    }
} else {
    header('Location: ../index.php');
    die();
}
