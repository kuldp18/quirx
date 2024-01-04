<?php

declare(strict_types=1);

function check_and_print_forgot_password_errors()
{

    if (isset($_SESSION["errors_forgot_password"])) {
        $errors = $_SESSION["errors_forgot_password"];
        if (count($errors) > 0) {
            echo "<section class='modal modal--error'>";
            echo "<h1 class='modal__title'>Unable to reset your password: </h1>";
            echo "<span class='modal__close modal__close--error'>X</span>";
            foreach ($errors as $error) {
                echo "<p class='modal__item'>$error</p>";
            }
            echo "</section>";
            unset($_SESSION["errors_forgot_password"]);
        }
    }
}
