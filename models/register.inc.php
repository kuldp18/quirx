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

function set_user(object $pdo,string $fullname, string $email, string $username, string $password){
    $query = "INSERT INTO users (full_name, email, username, password) VALUES (:fullname, :email, :username, :password)";
    $stmt = $pdo->prepare($query); // prepare the query

    $options = ['cost' => 12];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);
    $stmt->bindParam(":fullname", $fullname, PDO::PARAM_STR); // bind the $fullname variable to the :fullname placeholder
    $stmt->bindParam(":email", $email, PDO::PARAM_STR); // bind the $email variable to the :email placeholder
    $stmt->bindParam(":username", $username, PDO::PARAM_STR); // bind the $username variable to the :username placeholder
    $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR); // bind the $hashed_password variable to the :password placeholder
    $stmt->execute(); // execute the query
}