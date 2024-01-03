<?php
require_once "./includes/config_session.inc.php";
require_once "./views/login.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quirx - Home Page</title>
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/home.css" />
  <link rel="stylesheet" href="./css/navbar.css" />
</head>

<body>
  <?php include_once('./includes/components/navbar_default.inc.php') ?>
  <main class="home">
    <h1 class="home__title">Welcome to Quirx!</h1>
    <?php
    require_once "./includes/config_session.inc.php";

    include_once "./views/login.inc.php";

    output_username();
    ?>
    <!-- <a href="./pages/register.php" class="home__link">Register</a>
    <a href="./pages/login.php" class="home__link">Login</a> -->
  </main>

  <?php
  if (isset($_GET["login"]) && $_GET["login"] === "success") {
    echo <<<HTML
          <section class="modal modal--success">
            <h1 class="modal__title">Login successful!</h1>
            <span class="modal__close modal__close--success">X</span>
          </section>
        HTML;
  }
  ?>


  <script src="./js/close_modal.js"></script>

</body>

</html>