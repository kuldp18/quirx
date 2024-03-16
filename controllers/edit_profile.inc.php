<?php
//Controllers handle the logic of the application

declare(strict_types=1);


function is_edit_form_empty(string $fullname, string $email, string $username, array $pfp)
{
    if (empty($fullname) && empty($email) && empty($username) && empty($pfp['name'])) {
        return true;
    }
    return false;
}


// is the email new and different from the old one?
function is_email_new(string $new_email, string $old_email)
{
    if ($new_email !== $old_email) {
        return true;
    }
    return false;
}

// is the username new and different from the old one?
function is_username_new(string $new_username, string $old_username)
{
    if ($new_username !== $old_username) {
        return true;
    }
    return false;
}

// is the name new and different from the old one?
function is_name_new(string $new_name, string $old_name)
{
    if ($new_name !== $old_name) {
        return true;
    }
    return false;
}


// is pfp image file invalid
function is_pfp_file_invalid(array $pfp)
{
    $pfp_name = $pfp['name'];
    $pfp_size = $pfp['size'];
    $pfp_error = $pfp['error'];

    $pfp_ext = explode('.', $pfp_name);
    $pfp_actual_ext = strtolower(end($pfp_ext));

    $allowed = ['jpg', 'jpeg', 'png'];

    if (in_array($pfp_actual_ext, $allowed)) {
        if ($pfp_error === 0 && $pfp_size > 0 && $pfp_size <= 2 * 1024 * 1024) {
            return false;
        } else {
            return true;
        }
    } else {
        return true;
    }
}
