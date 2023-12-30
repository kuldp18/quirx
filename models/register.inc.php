<?php
// Models actually interact with the database

declare(strict_types=1);


function get_username(object $pdo, string $username){
    $query = "SELECT username FROM users WHERE username = :username"; // :username is a named placeholder
    $stmt = $pdo->prepare($query); // prepare the query
    $stmt->bindParam(":username", $username, PDO::PARAM_STR); // bind the $username variable to the :username placeholder
    $stmt->execute(); // execute the query

    $result = $stmt->fetch(PDO::FETCH_ASSOC); //fetch the result from the query
    return $result;
}

function get_email(object $pdo, string $email){
    $query = "SELECT email FROM users WHERE email = :email"; // :email is a named placeholder
    $stmt = $pdo->prepare($query); // prepare the query
    $stmt->bindParam(":email", $email, PDO::PARAM_STR); // bind the $email variable to the :email placeholder
    $stmt->execute(); // execute the query

    $result = $stmt->fetch(PDO::FETCH_ASSOC); //fetch the result from the query
    return $result;
}