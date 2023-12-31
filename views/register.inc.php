<?php
//Views are responsible for displaying the data to the user

declare(strict_types=1);

function register_inputs()
{
    // fullname

    if (isset($_SESSION["reg_data"]["fullname"])) {
        echo '<input
          type="text"
          name="fullname"
          placeholder="Enter full name"
          value="' . $_SESSION["reg_data"]["fullname"] . '"/>';
    } else {
        echo '<input
          type="text"
          name="fullname"
          placeholder="Enter full name"/>';
    }

    // email
    if (isset($_SESSION["reg_data"]["email"]) && !isset($_SESSION["errors_register"]["email_taken"]) && isset($_SESSION["reg_data"]["email"]) && !isset($_SESSION["errors_register"]["invalid_email"])) {
        echo ' <input
        type="email"
        name="email"
        placeholder="Enter email"
        value="' . $_SESSION["reg_data"]["email"] . '"/>';
    } else {
        echo ' <input
        type="email"
        name="email"
        placeholder="Enter email"    
    />';
    }

    //username
    if (isset($_SESSION["reg_data"]["username"]) && !isset($_SESSION["errors_register"]["username_taken"])) {
        echo ' <input
        type="text"
        name="username"
        placeholder="Enter username"
        value="' . $_SESSION["reg_data"]["username"] . '"/>';
    } else {
        echo ' <input
        type="text"
        name="username"
        placeholder="Enter username"    
    />';
    }

    // password
    echo '<input
        type="password"
        name="password"
        placeholder="Enter password" 
    />';
}

function check_and_print_register_errors()
{
    if (isset($_SESSION["errors_register"])) {
        $errors = $_SESSION["errors_register"];
        if (count($errors) > 0) {
            echo "<section class='modal modal--error'>";
            echo "<h1 class='modal__title'>Errors occurred while registering: </h1>";
            echo "<span class='modal__close modal__close--error'>X</span>";
            foreach ($errors as $error) {
                echo "<p class='modal__item'>$error</p>";
            }
            echo "</section>";
            unset($_SESSION["errors_register"]);
        }
    }
}
