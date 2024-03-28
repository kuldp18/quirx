<?php
require_once "../includes/db_handler.inc.php";
require_once "../includes/config_session.inc.php";
require_once "../models/videos.inc.php";
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
    // check if user is not logged in
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])) {
        // if not, redirect to home page
        header('Location: ../index.php');
        exit();
    }
    $user_id = $_SESSION['user_id'];

    // fetch user uploads
    if (isset($user_id)) {
        $uploads = fetch_uploaded_videos($pdo, $user_id);
    }
    ?>

    <main class="user_dashboard">
        <h1 class="heading">Your Dashboard</h1>
        <section class="upload">
            <h2 class="subheading subheading--larger">Your uploads</h2>
            <section class="upload__videos">
                <?php foreach ($uploads as $video) { ?>
                    <article class="video">
                        <div class="video__thumbnail video__item">
                            <?php
                            $thumbnail = $video['video_thumbnail'] ? "../uploads/thumbnails/" . $video['video_thumbnail'] : "https://placehold.co/1280x720/black/white?text=No+Thumbnail&font=monsterrat";
                            ?>
                            <img src="<?php echo $thumbnail; ?>" alt="No thumbnail found" class="video__thumbnail__img" width="300" height="200">
                        </div>
                        <div class="video__info video__item">
                            <div class="video__title">
                                Title: <?php echo $video['video_title']; ?>
                            </div>
                            <?php
                            $video_id = $video['video_id'];
                            $views = fetch_video_views($pdo, $video_id);
                            $average_rating = fetch_average_rating($pdo, $video_id);
                            ?>
                            <div class="video__ratings">
                                Rating: <?php echo $average_rating; ?>
                            </div>
                            <div class="video__views">
                                Views: <?php echo $views; ?>
                            </div>
                        </div>
                        <form action="" class="btn__form video__item">
                            <button type="submit" name="edit" class="video__btn video__btn--edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button type="submit" name="delete" class="video__btn video__btn--delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </article>
                <?php } ?>
            </section>
        </section>
    </main>


    <script>
        function truncateVideoTitle(titleElement, maxLength) {
            let truncatedText = titleElement.textContent.slice(0, maxLength) + "...";
            titleElement.textContent = truncatedText;
        }

        const videoTitles = document.querySelectorAll(".video__title");
        videoTitles.forEach((title) => {
            if (title.textContent.trim().length > 110) {
                truncateVideoTitle(title, 110);
            }
        });
    </script>

</body>

</html>