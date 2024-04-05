<?php

declare(strict_types=1);

// return all user list from db
function get_all_users(object $pdo): array
{
    $query = "SELECT user_id, created_at, deleted_at, updated_at, full_name, email, username, role, is_active FROM users";
    $stmt = $pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
