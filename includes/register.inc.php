<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        require_once "./db_handler.inc.php";
        require_once "../models/register.inc.php";
        require_once "../controllers/register.inc.php";

        // Error handlers

        $errors = [];

        // Check for empty inputs
        if(is_input_empty($fullname, $email, $username, $password)){
            $errors["empty_input"] = "Please fill in all fields";
        }

        // Check if email is invalid
        if(is_email_invalid($email)){
            $errors["invalid_email"] = "Please enter a valid email address";

        }

        // Check if username is taken
        if(is_username_taken($pdo, $username)){
            $errors["username_taken"] = "Username is already taken";

        }

        // Check if email is already registered
        if(is_email_registered($pdo, $email)){
            $errors["email_taken"] = "Email is already registered";
        }

        require_once "./config_session.inc.php";

        if($errors){
            $_SESSION["errors_register"] = $errors;
            header('Location: ../pages/register.php');
            die();
        }


    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

}else{
    header("Location: ../index.php");
    exit();
}