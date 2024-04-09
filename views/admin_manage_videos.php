<?php

declare(strict_types=1);


// check and print admin delete video errors
function check_and_print_admin_delete_video_errors()
{
    if (isset($_SESSION["errors_admin_delete_video"])) {
        $errors = $_SESSION["errors_admin_delete_video"];
        if (count($errors) > 0) {
            echo "<section class='modal modal--error'>";
            echo "<h1 class='modal__title'>Errors while deleting video: </h1>";
            echo "<span class='modal__close modal__close--error'>X</span>";
            foreach ($errors as $error) {
                echo "<p class='modal__item'>$error</p>";
            }
            echo "</section>";
            unset($_SESSION["errors_admin_delete_video"]);
        }
    }
}

// check and print admin edit video errors
function check_and_print_admin_edit_video_errors()
{
    if (isset($_SESSION["errors_admin_edit_video"])) {
        $errors = $_SESSION["errors_admin_edit_video"];
        if (count($errors) > 0) {
            echo "<section class='modal modal--error'>";
            echo "<h1 class='modal__title'>Errors while editing video: </h1>";
            echo "<span class='modal__close modal__close--error'>X</span>";
            foreach ($errors as $error) {
                echo "<p class='modal__item'>$error</p>";
            }
            echo "</section>";
            unset($_SESSION["errors_admin_edit_video"]);
        }
    }
}
