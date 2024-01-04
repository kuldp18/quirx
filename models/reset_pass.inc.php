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
