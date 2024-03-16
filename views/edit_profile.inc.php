<?php
//Views are responsible for displaying the data to the user

declare(strict_types=1);


function check_and_print_edit_profile_errors()
{
    if (isset($_SESSION["errors_edit_profile"])) {
        $errors = $_SESSION["errors_edit_profile"];
        if (count($errors) > 0) {
            echo "<section class='modal modal--error'>";
            echo "<h1 class='modal__title'>Errors while updating profile: </h1>";
            echo "<span class='modal__close modal__close--error'>X</span>";
            foreach ($errors as $error) {
                echo "<p class='modal__item'>$error</p>";
            }
            echo "</section>";
            unset($_SESSION["errors_edit_profile"]);
        }
    }
}
