<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quirx - Registration</title>
  <link rel="stylesheet" href="../css/global.css" />
  <link rel="stylesheet" href="../css/login.css" />
</head>

<body>
  <main class="login">
    <h1 class="login__title">Login to Quirx</h1>
    <h3 class="subheading">
      New to Quirx? Register
      <a href="./register.php" class="login__link">here</a>.
    </h3>
    <form class="login__form">
      <input type="email" name="email" placeholder="Enter email" required />
      <input type="password" name="password" placeholder="Enter password" required />
      <!-- TODO : ADD FORGOT PASSWORD FEATURE -->
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
  ?>
  <script src="../js/close_modal.js"></script>
</body>

</html>