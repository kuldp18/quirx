<?php

declare(strict_types=1);


// check and print video tag creation errors
function check_and_print_video_tag_creation_errors()
{

    if (isset($_SESSION["errors_admin_manage_tags"])) {
        $errors = $_SESSION["errors_admin_manage_tags"];
        if (count($errors) > 0) {
            echo "<section class='modal modal--error'>";
            echo "<h1 class='modal__title'>Unable to create new tag: </h1>";
            echo "<span class='modal__close modal__close--error'>X</span>";
            foreach ($errors as $error) {
                echo "<p class='modal__item'>$error</p>";
            }
            echo "</section>";
            unset($_SESSION["errors_admin_manage_tags"]);
        }
    }
}

//check and print video list tags errors
function check_and_print_video_tag_list_errors()
{

    if (isset($_SESSION["errors_admin_manage_tags"])) {
        $errors = $_SESSION["errors_admin_manage_tags"];
        if (count($errors) > 0) {
            echo "<section class='modal modal--error'>";
            echo "<h1 class='modal__title'>Unable to fetch tags: </h1>";
            echo "<span class='modal__close modal__close--error'>X</span>";
            foreach ($errors as $error) {
                echo "<p class='modal__item'>$error</p>";
            }
            echo "</section>";
            unset($_SESSION["errors_admin_manage_tags"]);
        }
    }
}
