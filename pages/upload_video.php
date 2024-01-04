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
    <link rel="stylesheet" href="../css/upload_video.css" />
    <link rel="stylesheet" href="../css/navbar.css" />
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
            <form action="" class="upload__section__form" method="post">
                <input type="file" name="video">
            </form>
        </section>
    </main>
</body>

</html>