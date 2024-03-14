<?php

declare(strict_types=1);


function get_current_user_details(object $pdo, int $user_id): array
{
    $query = "SELECT * FROM users WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function update_user_details(object $pdo, int $user_id, string $new_name, string $new_email, string $new_username): void
{
    $query = "UPDATE users SET full_name = :new_name, email = :new_email, username = :new_username WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":new_name", $new_name, PDO::PARAM_STR);
    $stmt->bindParam(":new_email", $new_email, PDO::PARAM_STR);
    $stmt->bindParam(":new_username", $new_username, PDO::PARAM_STR);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
}
