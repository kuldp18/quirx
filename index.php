<?php
require_once "./includes/db_handler.inc.php";
require_once "./includes/config_session.inc.php";
require_once "./models/videos.inc.php";
require_once "./views/login.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quirx - Home Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/video_list.css" />
  <link rel="stylesheet" href="./css/navbar.css" />
</head>

<body>
  <?php include_once('./includes/components/navbar_default.inc.php') ?>

  <?php
  $videos = fetch_all_videos($pdo);
  ?>
  <main class="videos">
    <section class="videos__search">
      <form class="search_form">
        <input type="text" name="search_form__input" class="search_form__input" placeholder="Search" required>
        <button type="submit" class="search_form__submit">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </form>
    </section>
    <section class="videos__recent">
      <h2 class="videos__title">Recently uploaded</h2>
      <section class="video-list">
        <?php foreach ($videos as $video) : ?>
          <a href="./pages/video_page.php?video_id=<?php echo $video['video_id']; ?>" class="video__link">
            <article class="video">
              <div class="video__thumbnail">
                <?php
                $thumbnail = $video['video_thumbnail'] ? "./uploads/thumbnails/" . $video['video_thumbnail'] : "https://placehold.co/1280x720/black/white?text=No+Thumbnail&font=monsterrat";
                ?>
                <img src="<?php echo $thumbnail; ?>" alt="No thumbnail found" class="video__thumbnail__img">
              </div>
              <div class="video__details">
                <h3 class="video__details__title"><?php echo $video['video_title']; ?></h3>
                <p class="video__details__user"><?php echo "@" . fetch_username_from_video_id($pdo, $video["video_id"]) ?></p>
              </div>
            </article>
          </a>
        <?php endforeach; ?>


      </section>
    </section>
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

  <?php
  if (isset($_GET["upload"]) && $_GET["upload"] === "success") {
    echo <<<HTML
          <section class="modal modal--success">
            <h1 class="modal__title">Video uploaded successfully!</h1>
            <span class="modal__close modal__close--success">X</span>
          </section>
        HTML;
  }
  ?>


  <script src="./js/close_modal.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.min.js" integrity="sha512-wC/cunGGDjXSl9OHUH0RuqSyW4YNLlsPwhcLxwWW1CR4OeC2E1xpcdZz2DeQkEmums41laI+eGMw95IJ15SS3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="./js/video_list.js"></script>

</body>

</html>