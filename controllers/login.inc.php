<?php

declare(strict_types=1);

function is_input_empty(string $email, string $password)
{
    if (empty($email) || empty($password)) {
        return true;
    }
    return false;
}


function is_email_invalid(string $email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}


function is_email_wrong(bool|array $result)
{
    if (!$result) {
        return true;
    }
    return false;
}

function is_password_wrong(string $pass, string $hashed_pass)
{
    if (!password_verify($pass, $hashed_pass)) {
        return true;
    }
    return false;
}
