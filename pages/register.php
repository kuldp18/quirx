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
  <link rel="stylesheet" href="../css/navbar.css" />
</head>

<body>
  <?php include_once('../includes/components/navbar.inc.php') ?>
  <main class="registration">
    <h1 class="registration__title">Join Quirx today!</h1>
    <h3 class="subheading">
      Already an user? Login
      <a href="./login.php" class="registration__link">here</a>.
    </h3>
    <form class="registration__form" method="post" action="../includes/register.inc.php">
      <?php
      register_inputs();
      ?>
      <input type="submit" value="Register" class="registration__btn" />
    </form>
  </main>

  <!-- <section class="modal modal--error">
    <h1 class="modal__title">Errors occurred while registering: </h1>
    <span class="modal__close modal__close--error">X</span>
    <p class="modal__item">Sample error 1</p>
    <p class="modal__item">Sample error 2</p>
  </section> -->

  <?php
  check_and_print_register_errors();
  ?>

  <script src="../js/close_modal.js"></script>
</body>

</html>