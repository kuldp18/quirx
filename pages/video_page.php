<?php
require_once "../includes/db_handler.inc.php";
require_once "../includes/config_session.inc.php";
require_once "../views/video_ratings.php";
require_once "../models/videos.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quirx - Video Page</title>
    <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/video_page.css" />
    <link rel="stylesheet" href="../css/navbar.css" />
</head>

<body>
    <?php include_once('../includes/components/navbar.inc.php') ?>

    <?php

    $current_video_id = $_GET['video_id'];
    $video = fetch_video_by_id($pdo, $current_video_id);
    $username = fetch_username_from_video_id($pdo, $current_video_id);
    $average_rating = fetch_average_rating($pdo, $current_video_id);
    $video_views = fetch_video_views($pdo, $current_video_id);

    $current_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $creator_id = fetch_creator_id($pdo, $current_video_id);

    if ($current_user_id !== null) {
        increment_video_views($pdo, $current_video_id, $current_user_id);
    }

    // round average rating to 1 decimal place
    $average_rating = round($average_rating, 1);
    $previous_rating = 0;

    // if user rated the video already, fetch previous rating

    if ($current_user_id !== null && is_video_rated_by_user($pdo, $current_video_id, $current_user_id)) {
        $previous_rating = fetch_previous_rating_value($pdo, $current_video_id, $current_user_id);
    }

    ?>
    <main class="player">
        <span class="video__id__span">
            <?php echo $current_video_id; ?>
        </span>
        <video class="player__video video-js" controls preload="auto" width="650" height="300" poster="../uploads/thumbnails/<?php echo $video['video_thumbnail']; ?>" data-setup="{}">
            <source src="../uploads/videos/<?php echo $video['video_path']; ?>" type="video/mp4" />
            <p class="vjs-no-js">
                To view this video please enable JavaScript, and consider upgrading to a
                web browser that
                <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
            </p>
        </video>

        <section class="player__stats">
            <p class="video__title"><?php echo $video["video_title"]; ?></p>
            <div class="player__stats__sub">
                <div class="player__stats__sub__left">
                    <p class="user__name">
                        <a href="#" class="user__name__link">
                            <?php echo "@" . $username; ?>
                        </a>
                    </p>
                    <form action="../includes/subscriptions.inc.php" method="post">
                        <input type="hidden" name="video_id" value="<?php echo $current_video_id; ?>">
                        <?php
                        if ($current_user_id !== null) {

                            $isSubscribed = is_user_subscribed_to_creator($pdo, $current_user_id, $creator_id);
                            $buttonText = $isSubscribed ? "Unsubscribe" : "Subscribe";
                        } else {
                            $buttonText = "Subscribe";
                        }
                        ?>

                        <button class="subscribe__btn" type="submit"><?php echo $buttonText; ?></button>
                    </form>
                </div>
                <div class="player__stats__sub__right">
                    <p class="video__views">
                        <span class="views"><?php echo $video_views; ?></span> views
                    </p>
                </div>
            </div>

            <div class="player__stats__ratings">
                <div class="player__stats__ratings__left">
                    <p class="rate">Rate this video: </p>
                    <div id="stars">
                        <span class="star" data-rating="1"><i class="far fa-star"></i></span>
                        <span class="star" data-rating="2"><i class="far fa-star"></i></span>
                        <span class="star" data-rating="3"><i class="far fa-star"></i></span>
                        <span class="star" data-rating="4"><i class="far fa-star"></i></span>
                        <span class="star" data-rating="5"><i class="far fa-star"></i></span>
                    </div>
                    <form class="report__container">
                        <input type="hidden" value="<?php echo $current_video_id; ?>" name="video_id">
                        <button class="report__btn" type="submit">
                            <i class="fas fa-flag"></i>
                        </button>
                    </form>
                    <!-- if previous_rating is not 0 show it below -->
                    <?php if ($previous_rating !== 0) : ?>
                        <p class="previous__rating">
                            Your rating: <span class="previous__rating__value"><?php echo $previous_rating; ?></span>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="player__stats__ratings__right">
                    <p class="ratings">
                        Avg Rating: <span class="average__rating"><?php echo $average_rating; ?></span>
                    </p>
                </div>
            </div>
        </section>


        <?php if (!empty($video["video_desc"])) { ?>
            <section class="player__description">
                <?php echo $video["video_desc"]; ?>
            </section>
        <?php } ?>

    </main>

    <?php
    check_and_print_video_subscription_errors();

    check_and_print_star_rating_errors();

    if (isset($_GET["success"]) && $_GET["success"] === "user_subscribed") {
        echo <<<HTML
          <section class="modal modal--success">
            <h1 class="modal__title">User subscribed!</h1>
            <span class="modal__close modal__close--success">X</span>
          </section>
        HTML;
    }


    if (isset($_GET["error"]) && $_GET["error"] === "self_subscribe") {
        echo <<<HTML
          <section class="modal modal--error">
            <h1 class="modal__title">You can't subscribe yourself!</h1>
            <span class="modal__close modal__close--error">X</span>
          </section>
        HTML;
    }


    if (isset($_GET["success"]) && $_GET["success"] === "user_unsubscribed") {
        echo <<<HTML
          <section class="modal modal--success">
            <h1 class="modal__title">User unsubscribed!</h1>
            <span class="modal__close modal__close--success">X</span>
          </section>
        HTML;
    }

    ?>




    <script src="../js/close_modal.js"></script>
    <?php if (isset($current_user_id)) : ?>
        <?php if (!is_user_video_creator($pdo, $current_user_id, $current_video_id)) : ?>
            <script src="../js/star_rating.js"></script>
        <?php endif; ?>

        <?php if (is_user_video_creator($pdo, $current_user_id, $current_video_id)) : ?>
            <script>
                const stars = document.querySelectorAll(".star i");
                stars.forEach(star => {
                    star.style.cursor = "not-allowed";
                });
            </script>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!isset($current_user_id)) : ?>
        <script>
            const stars2 = document.querySelectorAll(".star i");
            stars2.forEach(star => {
                star.style.cursor = "not-allowed";
            });
        </script>
    <?php endif; ?>


    <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
</body>

</html>