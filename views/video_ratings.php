<?php

declare(strict_types=1);


// check and print video subscription errors
function check_and_print_video_subscription_errors()
{

    if (isset($_SESSION["errors_video_subscriptions"])) {
        $errors = $_SESSION["errors_video_subscriptions"];
        if (count($errors) > 0) {
            echo "<section class='modal modal--error'>";
            echo "<h1 class='modal__title'>Unable to subscribe: </h1>";
            echo "<span class='modal__close modal__close--error'>X</span>";
            foreach ($errors as $error) {
                echo "<p class='modal__item'>$error</p>";
            }
            echo "</section>";
            unset($_SESSION["errors_video_subscriptions"]);
        }
    }
}

// check and print star rating errors
function check_and_print_star_rating_errors()
{
    if (isset($_SESSION["error_star_rating"])) {
        $errors = $_SESSION["error_star_rating"];
        if (count($errors) > 0) {
            echo "<section class='modal modal--error'>";
            echo "<h1 class='modal__title'>Errors occurred while rating this video: </h1>";
            echo "<span class='modal__close modal__close--error'>X</span>";
            foreach ($errors as $error) {
                echo "<p class='modal__item'>$error</p>";
            }
            echo "</section>";
            unset($_SESSION["error_star_rating"]);
        }
    }
}
