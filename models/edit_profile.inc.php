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

function update_user_details(object $pdo, int $user_id, string $new_name, string $new_email, string $new_username, array $new_pfp): void
{
    $query = "UPDATE users SET full_name = :new_name, email = :new_email, username = :new_username WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":new_name", $new_name, PDO::PARAM_STR);
    $stmt->bindParam(":new_email", $new_email, PDO::PARAM_STR);
    $stmt->bindParam(":new_username", $new_username, PDO::PARAM_STR);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();

    // if pfp is not empty, upload pfp
    if (!empty($new_pfp['name'])) {
        upload_pfp($pdo, $user_id, $new_pfp);
    }
    // if successful, update updated_at in user to current timestamp
    update_user_updated_at($pdo, $user_id);
}

// update updated_at in user to current timestamp
function update_user_updated_at(object $pdo, int $user_id): void
{
    $query = "UPDATE users SET updated_at = CURRENT_TIMESTAMP WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
}


// upload profile picture
function upload_pfp(object $pdo, int $user_id, array $new_pfp): void
{
    $pfp_name = $new_pfp['name'];
    $pfp_tmp_name = $new_pfp['tmp_name'];

    $pfp_ext = explode('.', $pfp_name);
    $pfp_actual_ext = strtolower(end($pfp_ext));

    $allowed = ['jpg', 'jpeg', 'png'];

    if (in_array($pfp_actual_ext, $allowed)) {
        $pfp_new_name = uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $pfp_actual_ext;
        $pfp_destination = "../uploads/pfp/" . $pfp_new_name;
        move_uploaded_file($pfp_tmp_name, $pfp_destination);

        // update pfp in database
        $query = "UPDATE users SET pfp = :pfp WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":pfp", $pfp_new_name, PDO::PARAM_STR);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
