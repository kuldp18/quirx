<!-- <?php
        require_once "../includes/config_session.inc.php";
        ?> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quirx - Upload new video</title>
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/navbar.css" />
    <link rel="stylesheet" href="../css/upload_video.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/autoresize.jquery.js"></script>
</head>

<body>
    <?php include_once('../includes/components/navbar.inc.php') ?>

    <?php
    // check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        // if not, redirect to login page
        header('Location: ./login.php');
        exit();
    }
    ?>
    <main class="upload">
        <h2 class="upload__title">New video upload</h2>
        <section class="upload__section">
            <form action="" class="upload__section__form" method="post" enctype="multipart/form-data">
                <div class="upload__section__form__item upload__section__form__item--video">
                    <label>Choose video:</label>
                    <input type="file" name="video" class="upload__input">
                </div>
                <p class="upload__title upload__title--sub">Video details</p>
                <div class="upload__section__form__item">
                    <label>Video Title: </label>
                    <input type="text" name="title" class="upload__input">
                </div>
                <div class="upload__section__form__item">
                    <label>Description <small>(optional)</small>: </label>
                    <textarea name="description" maxlength="1000" class="upload__textarea"></textarea>
                </div>
                <div class="upload__section__form__item">
                    <label>Thumbnail <small>(optional)</small>: </label>
                    <input type="file" name="thumbnail" class="upload__input">
                </div>
                <!-- TODO: ADD VIDEO TAG FEATURE -->
                <input type="submit" value="Upload video" class="upload__btn">
            </form>
        </section>
    </main>

    <script>
        $('textarea').autoResize();
    </script>
</body>

</html>