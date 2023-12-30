<?php
require_once "../includes/config_session.inc.php";
require_once "../views/register.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quirx - Registration</title>
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/register.css" />
  </head>
  <body>
    <main class="registration">
      <h1 class="registration__title">Join Quirx today!</h1>
      <h3 class="subheading">
        Already an user? Login
        <a href="./login.php" class="registration__link">here</a>.
      </h3>
      <form class="registration__form" method="post" action="../includes/register.inc.php">
        <input
          type="text"
          name="fullname"
          placeholder="Enter full name"
        />
        <input type="email" name="email" placeholder="Enter email"  />
        <input
          type="text"
          name="username"
          placeholder="Enter username"    
        />
        <input
          type="password"
          name="password"
          placeholder="Enter password" 
        />
        <input type="submit" value="Register" class="registration__btn" />
      </form>
    </main>

    <!-- <section class="error"> -->
      <!-- <h1 class="error__title">Errors occurred while registering: </h1>
      <p class="error__item">Sample error 1</p>
      <p class="error__item">Sample error 2</p> -->
    <!-- </section> -->

    <?php
    check_and_print_register_errors();
    ?>
  </body>
</html>
