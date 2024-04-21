<?php

declare(strict_types=1);

// return all user list from db
function get_all_users(object $pdo): array
{
    $query = "SELECT user_id, created_at, deleted_at, updated_at, full_name, email, username, role, is_active FROM users";
    $stmt = $pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// return user by id
function get_user_by_id(object $pdo, int $user_id): array
{
    $query = "SELECT * FROM users WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// update user as admin
function update_user_as_admin(object $pdo, int $user_id, string $updated_name, string $updated_email, string $updated_username, string $updated_role, string $updated_status): void
{
    $query = "UPDATE users SET full_name = :updated_name, email = :updated_email, username = :updated_username, role = :updated_role, is_active = :updated_status, updated_at = CURRENT_TIMESTAMP WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['updated_name' => $updated_name, 'updated_email' => $updated_email, 'updated_username' => $updated_username, 'updated_role' => $updated_role, 'updated_status' => $updated_status, 'user_id' => $user_id]);
}

// delete user as admin
function delete_user_as_admin(object $pdo, int $user_id): void
{
    // just set is_active to N
    $query = "UPDATE users SET is_active = 'N', deleted_at = CURRENT_TIMESTAMP WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['user_id' => $user_id]);
}

// does user exist or not by id
function does_user_exist(object $pdo, int $user_id): bool
{
    $query = "SELECT user_id FROM users WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
}

// update user status 
function update_user_status(object $pdo, int $user_id, string $updated_status): void
{
    $query = "UPDATE users SET is_active = :updated_status, updated_at = CURRENT_TIMESTAMP WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['updated_status' => $updated_status, 'user_id' => $user_id]);
}
