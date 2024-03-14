<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_email = $_POST['email'];
    $new_name = $_POST['name'];
    $new_username = $_POST['username'];

    try {
        require_once "./db_handler.inc.php";
        require_once "./config_session.inc.php";
        require_once "../models/edit_profile.inc.php";
        require_once "../models/register.inc.php";
        require_once "../controllers/edit_profile.inc.php";
        require_once "../controllers/register.inc.php";

        $current_user = get_current_user_details($pdo, $_SESSION['user_id']);

        // Error handlers

        $errors = [];



        // Check for empty inputs
        if (is_edit_form_empty($new_name, $new_email, $new_username)) {
            // make sure to use local variables here
            $errors["empty_input"] = "Please fill in all fields";
        } else {
            // Check if atleast one field is different from the old one
            if (!is_email_new($new_email, $current_user['email']) && !is_username_new($new_username, $current_user['username']) && !is_name_new($new_name, $current_user['full_name'])) {
                $errors["no_changes"] = "No changes were made";
            }


            // Check if email is invalid
            else if (is_email_invalid($new_email) && !empty($new_email)) {
                $errors["invalid_email"] = "Please enter a valid email address";
            }

            // Check if username is taken
            else if (is_username_taken($pdo, $new_username) && !empty($new_username)) {
                $errors["username_taken"] = "Username is already taken";
            }

            // Check if email is already registered
            else if (is_email_registered($pdo, $new_email) && !empty($new_email)) {
                $errors["email_taken"] = "Email is already registered";
            }
        }

        // the fields that are still empty should be filled with the old values
        if (empty($new_name)) {
            $new_name = $current_user['full_name'];
        }
        if (empty($new_email)) {
            $new_email = $current_user['email'];
        }
        if (empty($new_username)) {
            $new_username = $current_user['username'];
        }




        if ($errors) {
            $_SESSION["errors_edit_profile"] = $errors;
            header('Location: ../pages/edit_profile.php');
            die();
        }

        // Update user details
        update_user_details($pdo, $_SESSION['user_id'], $new_name, $new_email, $new_username);

        // log out the user
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../pages/login.php?edit=success');

        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header('Location: ../index.php');
    die();
}
