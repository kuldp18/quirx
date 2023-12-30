<?php
//Views are responsible for displaying the data to the user

declare(strict_types=1);

function check_and_print_register_errors(){
    if(isset($_SESSION["errors_register"])){
        $errors = $_SESSION["errors_register"];
        if(count($errors) > 0){
            echo "<section class='error'>";
            echo "<h1 class='error__title'>Errors occurred while registering: </h1>";
            echo "<span class='error__close'>X</span>";
            foreach($errors as $error){
                echo "<p class='error__item'>$error</p>";
            }
            echo "</section>";
            unset($_SESSION["errors_register"]);
        }
        
    }
}
