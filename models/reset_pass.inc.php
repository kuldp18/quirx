<?php

declare(strict_types=1);


//verify email and reset token in database

function verify_email_and_reset_token(object $pdo, string $email, string $reset_token)
{
    date_default_timezone_set("Asia/Kolkata");
    $date = date("Y-m-d");
    $query = "SELECT * FROM users WHERE email = :email AND reset_token = :reset_token";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":reset_token", $reset_token, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $reset_token_expiration = $result["reset_token_expiration"];
        if ($reset_token_expiration < $date) {
            return false;
        }
        return true;
    } else {
        return false;
    }
}

// set new password to db

function set_new_password(object $pdo, string $email, string $new_password)
{
    // hash new password
    $options = ['cost' => 12];
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT, $options);

    // set new password to db
    $query = "UPDATE users SET password = :password WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    return true;
}

// empty reset token and reset token date if password is set

function empty_reset_token(object $pdo, string $email)
{
    $query = "UPDATE users SET reset_token = NULL, reset_token_expiration = NULL WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    return true;
}
