<header class="header">
    <nav class="nav">
        <div class="nav__left">
            <h1 class="nav__title">
                <a href="../index.php" class="nav__link nav__link--title">Quirx</a>
            </h1>
        </div>
        <div class="nav__right">
            <ul class="nav__list">
                <?php
                // check if user is logged in and is admin
                if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') { ?>

                    <li class="nav__item"><a href="./admin_dashboard.php" class="nav__link">Admin</a></li>

                <?php } ?>

                <?php if (isset($_SESSION['user_id'])) { ?>
                    <li class="nav__item"><a href="./user_profile.php" class="nav__link">Profile</a></li>
                    <li class="nav__item"><a href="./upload_video.php" class="nav__link">Upload</a></li>
                    <form action="../includes/logout.inc.php" method="post" class="nav__item">
                        <input type="submit" name="logout" value="Logout" class="nav__link nav__link--btn">
                    </form>
                <?php } else { ?>
                    <li class="nav__item"><a href="./register.php" class="nav__link">Register</a></li>
                    <li class="nav__item"><a href="./login.php" class="nav__link">Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>