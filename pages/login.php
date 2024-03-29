<?php
require_once "../includes/config_session.inc.php";
require_once "../views/login.inc.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quirx - Registration</title>
  <link rel="stylesheet" href="../css/global.css" />
  <link rel="stylesheet" href="../css/login.css" />
  <link rel="stylesheet" href="../css/navbar.css" />
</head>

<body>
  <?php include_once('../includes/components/navbar.inc.php') ?>
  <main class="login">
    <h1 class="login__title">Login to Quirx</h1>
    <h3 class="subheading">
      New to Quirx? Register
      <a href="./register.php" class="login__link">here</a>.
    </h3>
    <form class="login__form" method="post" action="../includes/login.inc.php">
      <input type="email" name="email" placeholder="Enter email" />
      <input type="password" name="password" placeholder="Enter password" />
      <a href="./forgot_password.php" class="login__link login__form__link">Forgot password?</a>
      <input type="submit" value="Login" class="login__btn" />
    </form>
  </main>

  <?php

  if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
    echo <<<HTML
          <section class="modal modal--success">
            <h1 class="modal__title">Registration successful!</h1>
            <span class="modal__close modal__close--success">X</span>
          </section>
        HTML;
  }

  if (isset($_GET["edit"]) && $_GET["edit"] === "success") {
    echo <<<HTML
          <section class="modal modal--success">
            <h1 class="modal__title">Profile updated successfully! Please log in again.</h1>
            <span class="modal__close modal__close--success">X</span>
          </section>
        HTML;
  }

  if (isset($_GET["reset"]) && $_GET["reset"] === "true") {
    echo <<<HTML
          <section class="modal modal--success">
            <h1 class="modal__title">Your password has been reset successfully!</h1>
            <span class="modal__close modal__close--success">X</span>
          </section>
        HTML;
  }

  if (isset($_GET["reset"]) && $_GET["reset"] === "invalid") {
    echo <<<HTML
          <section class="modal modal--error">
            <h1 class="modal__title">Invalid or expired reset link!</h1>
            <span class="modal__close modal__close--error">X</span>
          </section>
        HTML;
  }

  if (isset($_GET["reset"]) && $_GET["reset"] === "false") {
    echo <<<HTML
          <section class="modal modal--error">
            <h1 class="modal__title">Error while resetting your password!</h1>
            <span class="modal__close modal__close--error">X</span>
          </section>
        HTML;
  }
  ?>

  <?php
  check_and_print_login_errors();
  ?>

  <script src="../js/close_modal.js"></script>
</body>

</html>