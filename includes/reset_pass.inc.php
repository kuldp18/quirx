<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pass = $_POST['password'];
    $repeat_pass = $_POST['repeat_password'];
    $email = $_POST['email'];
    $token = $_POST['token'];

    try {
        require_once "./db_handler.inc.php";
        require_once "../models/reset_pass.inc.php";

        $errors = [];

        // check if email is empty
        if (empty($pass)) {
            $errors["empty_input"] = "Please input your new password";
        }

        // check if passwords donot match
        if ($pass !== $repeat_pass) {
            $errors["passwords_dont_match"] = "Passwords donot match";
        }

        require_once "./config_session.inc.php";

        if ($errors) {
            $_SESSION["errors_reset_password"] = $errors;
            header('Location: ../pages/reset_password.php?email=' . $email . '&token=' . $token);
            die();
        }

        // set new password to db
        $is_new_password_set = set_new_password($pdo, $email, $pass);
        // empty reset token and reset token date if password is set

        $reset_success = false;
        if ($is_new_password_set) {
            $reset_success = empty_reset_token($pdo, $email);
        }

        if (!$reset_success) {
            header('Location: ../pages/login.php?reset=false');
            die();
        }

        // redirect to login page with success message if everything is successful
        header('Location: ../pages/login.php?reset=true');

        //close connection

        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../forgot_pass.php");
    exit();
}
