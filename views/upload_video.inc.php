<?php

declare(strict_types=1);

function check_and_print_video_upload_errors()
{

    if (isset($_SESSION["errors_upload_video"])) {
        $errors = $_SESSION["errors_upload_video"];
        if (count($errors) > 0) {
            echo "<section class='modal modal--error'>";
            echo "<h1 class='modal__title'>Unable to upload your video: </h1>";
            echo "<span class='modal__close modal__close--error'>X</span>";
            foreach ($errors as $error) {
                echo "<p class='modal__item'>$error</p>";
            }
            echo "</section>";
            unset($_SESSION["errors_upload_video"]);
        }
    }
}
