<?php

declare(strict_types=1);

function check_and_print_login_errors()
{

    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];
        if (count($errors) > 0) {
            echo "<section class='modal modal--error'>";
            echo "<h1 class='modal__title'>Errors occurred while logging in: </h1>";
            echo "<span class='modal__close modal__close--error'>X</span>";
            foreach ($errors as $error) {
                echo "<p class='modal__item'>$error</p>";
            }
            echo "</section>";
            unset($_SESSION["errors_login"]);
        }
    }
}
