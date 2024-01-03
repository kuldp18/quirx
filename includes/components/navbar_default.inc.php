<header class="header">
    <nav class="nav">
        <div class="nav__left">
            <h1 class="nav__title">
                <a href="./index.php" class="nav__link nav__link--title">Quirx</a>
            </h1>
        </div>
        <div class="nav__right">
            <ul class="nav__list">
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <form action="./includes/logout.inc.php" method="post" class="nav__item">
                        <input type="submit" name="logout" value="Logout" class="nav__link nav__link--btn">
                    </form>
                <?php } else { ?>
                    <li class="nav__item"><a href="./pages/register.php" class="nav__link">Register</a></li>
                    <li class="nav__item"><a href="./pages/login.php" class="nav__link">Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>