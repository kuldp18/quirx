<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    try {
        require_once "./db_handler.inc.php";
        require_once "../models/forgot_pass.inc.php";
        require_once "../controllers/forgot_pass.inc.php";


        $errors = [];

        // check if email is empty
        if (empty($email)) {
            $errors["empty_input"] = "Please input your registered email";
        }

        // check if email is invalid
        else if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Please enter a valid email address";
        }

        // check if email exists in database if email is not empty and is valid
        if (empty($errors)) {
            $result = get_user($pdo, $email);

            // check if email is wrong
            if (is_email_wrong($result)) {
                $errors["email_not_found"] = "Email not found";
            }
        }


        require_once "./config_session.inc.php";

        if ($errors) {
            $_SESSION["errors_forgot_password"] = $errors;
            header('Location: ../pages/forgot_password.php');
            die();
        }

        // generate reset token
        $reset_token = bin2hex(random_bytes(32));
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d");

        // insert reset token into database and send reset email

        insert_reset_token($pdo, $email, $reset_token, $date);
        send_reset_email($email, $reset_token);

        // redirect to forgot password page with success message if everything is successful
        header('Location: ../pages/forgot_password.php?reset=success');

        //close connection

        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    exit();
}
