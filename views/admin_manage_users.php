<?php

declare(strict_types=1);

// check and print admin edit user errors
function check_and_print_admin_edit_user_errors()
{
    if (isset($_SESSION["errors_admin_edit_user"])) {
        $errors = $_SESSION["errors_admin_edit_user"];
        if (count($errors) > 0) {
            echo "<section class='modal modal--error'>";
            echo "<h1 class='modal__title'>Errors while updating user: </h1>";
            echo "<span class='modal__close modal__close--error'>X</span>";
            foreach ($errors as $error) {
                echo "<p class='modal__item'>$error</p>";
            }
            echo "</section>";
            unset($_SESSION["errors_admin_edit_user"]);
        }
    }
}
