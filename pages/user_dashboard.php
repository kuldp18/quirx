<?php
require_once "../includes/config_session.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quirx - User Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/navbar.css" />
    <link rel="stylesheet" href="../css/user_dashboard.css" />
</head>

<body>
    <?php include_once('../includes/components/navbar.inc.php') ?>
    <?php
    // check is user is not logged in
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])) {
        // if not, redirect to home page
        header('Location: ../index.php');
        exit();
    }
    $user_name = $_SESSION['user_username'];
    ?>

    <main class="user_dashboard">
        <h1 class="heading">Your Dashboard</h1>
        <section class="upload">
            <h2 class="subheading">Uploaded Videos</h2>
            <section class="upload__videos">
                <article class="video">
                    <div class="video__left">
                        <div class="video__thumbnail">
                            <img src="../uploads/thumbnails/65f56ebd4a58e6.94540096.png" alt="video_thumbnail">
                        </div>
                        <div class="video__views">
                            Views: 5
                        </div>
                        <div class="video__ratings">
                            Ratings: 10
                        </div>
                    </div>

                    <div class="video__right">
                        <form action="">
                            <button type="submit" name="edit">Edit</button>
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </div>

                </article>


                <article class="video">
                    <div class="video__left">
                        <div class="video__thumbnail">
                            <img src="../uploads/thumbnails/65f56ebd4a58e6.94540096.png" alt="video_thumbnail">
                        </div>
                        <div class="video__views">
                            Views: 5
                        </div>
                        <div class="video__ratings">
                            Ratings: 10
                        </div>
                    </div>

                    <div class="video__right">
                        <form action="">
                            <button type="submit" name="edit">Edit</button>
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </div>

                </article>


                <article class="video">
                    <div class="video__thumbnail">
                        <img src="../uploads/thumbnails/65f56ebd4a58e6.94540096.png" alt="video_thumbnail">
                    </div>
                    <div>
                        <div class="video__views">
                            Views: 5
                        </div>
                        <div class="video__ratings">
                            Ratings: 10
                        </div>
                    </div>
                    <form action="" class="btn__form">
                        <button type="submit" name="edit" class="video__btn video__btn--edit">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button type="submit" name="delete" class="video__btn video__btn--delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </article>
            </section>
        </section>
    </main>

</body>

</html>