<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    try {
        require_once "./db_handler.inc.php";
        require_once "../models/login.inc.php";
        require_once "../controllers/login.inc.php";

        // Error handlers

        $errors = [];

        // Check for empty inputs
        if (is_input_empty($email, $pass)) {
            // make sure to use local variables here
            $errors["empty_input"] = "Please fill in all fields";
        }

        // Check if email is invalid
        else if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Please enter a valid email address";
        }

        // fetch user from database
        $result = get_user($pdo, $email);

        if (!is_input_empty($email, $pass)) {


            // Check if email is wrong
            if (is_email_wrong($result)) {
                $errors["login_incorrect"] = "Email or password is incorrect";
            }
            // check if email is right and password is wrong
            if (!is_email_wrong($result) && is_password_wrong($pass, $result["password"])) {
                $errors["login_incorrect"] = "Email or password is incorrect";
            }
        }


        require_once "./config_session.inc.php";

        if ($errors) {
            $_SESSION["errors_login"] = $errors;
            header('Location: ../pages/login.php');
            die();
        }

        // generate new session id and append user id to it
        $new_session_id = session_create_id();
        $session_id = $new_session_id . "_" . $result["user_id"];
        session_id($session_id); // set the new session id

        // set session variables
        $_SESSION["user_id"] = $result["user_id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION["user_fullname"] = htmlspecialchars($result["full_name"]);
        $_SESSION["user_email"] = htmlspecialchars($result["email"]);
        $_SESSION["user_role"] = $result["role"];
        $_SESSION["user_pfp"] = $result["pfp"];
        $_SESSION["last_regeneration"] = time();

        // redirect to home page
        header('Location: ../index.php?login=success');

        // close connection
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
