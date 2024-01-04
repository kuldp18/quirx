<?php

declare(strict_types=1);

function get_user(object $pdo, string $email)
{
    $query = "SELECT * FROM users WHERE email = :email"; // :email is a named placeholder
    $stmt = $pdo->prepare($query); // prepare the query
    $stmt->bindParam(":email", $email, PDO::PARAM_STR); // bind the $email variable to the :email placeholder
    $stmt->execute(); // execute the query

    $result = $stmt->fetch(PDO::FETCH_ASSOC); //fetch the result from the query
    return $result;
}

function insert_reset_token($pdo, $email, $reset_token, $date)
{
    // insert reset token into users table
    $query = "UPDATE users SET reset_token = :reset_token, reset_token_expiration = :reset_token_expiration WHERE email = :email";
    $stmt = $pdo->prepare($query);
    //bind all parameters
    $stmt->bindParam(":reset_token", $reset_token, PDO::PARAM_STR);
    $stmt->bindParam(":reset_token_expiration", $date, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
