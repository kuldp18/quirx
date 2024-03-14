<?php
//Controllers handle the logic of the application

declare(strict_types=1);


function is_edit_form_empty(string $fullname, string $email, string $username)
{
    if (empty($fullname) && empty($email) && empty($username)) {
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
