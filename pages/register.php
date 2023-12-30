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
      <form class="registration__form">
        <input
          type="text"
          name="fullname"
          placeholder="Enter full name"
          required
        />
        <input type="email" name="email" placeholder="Enter email" required />
        <input
          type="text"
          name="username"
          placeholder="Enter username"
          required
        />
        <input
          type="password"
          name="password"
          placeholder="Enter password"
          required
        />
        <input type="submit" value="Register" class="registration__btn" />
      </form>
    </main>
  </body>
</html>
