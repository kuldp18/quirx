<?php

declare(strict_types=1);


// check and print report errors
function check_and_print_report_errors()
{
    if (isset($_SESSION["errors_report_page"])) {
        $errors = $_SESSION["errors_report_page"];
        if (count($errors) > 0) {
            echo "<section class='modal modal--error'>";
            echo "<h1 class='modal__title'>Errors while submitting report: </h1>";
            echo "<span class='modal__close modal__close--error'>X</span>";
            foreach ($errors as $error) {
                echo "<p class='modal__item'>$error</p>";
            }
            echo "</section>";
            unset($_SESSION["errors_report_page"]);
        }
    }
}
