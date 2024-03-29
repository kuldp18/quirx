<?php
require_once "../includes/db_handler.inc.php";
require_once "../includes/config_session.inc.php";
require_once "../models/videos.inc.php";
require_once "../models/video_tags.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quirx - Edit Video</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/navbar.css" />
    <link rel="stylesheet" href="../css/edit_video.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/autoresize.jquery.js"></script>
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
    $video_id = $_GET['video_id'];

    $video_details = fetch_video_by_id($pdo, $video_id);
    $video_tag_list = get_video_tags($pdo);
    $current_video_tags = get_video_tags_by_video_id($pdo, $video_id);

    //print current video tags
    print_r($current_video_tags);

    ?>

    <main class="edit">
        <h1 class="heading heading--small">Edit Video</h1>
        <form action="" class="edit__form">
            <input type="text" name="title" class="edit__form__input" placeholder="Edit video title" value="<?php
                                                                                                            if (isset($video_details['video_title'])) {
                                                                                                                echo $video_details['video_title'];
                                                                                                            }
                                                                                                            ?>
            ">
            <textarea name="description" maxlength="1000" class="upload__textarea" placeholder="Edit video description"><?php if (isset($video_details['video_desc'])) {
                                                                                                                            echo $video_details['video_desc'];
                                                                                                                        }
                                                                                                                        ?>
            </textarea>
            <div class="edit__form__container">
                <?php
                foreach ($video_tag_list as $tag) {
                    echo '<div class="edit__form__checkbox">';
                    echo '<label for="' . $tag['tag_name'] . '">' . $tag['tag_name'] . '</label>';
                    $tagChecked = in_array($tag['tag_name'], $current_video_tags) ? 'checked' : '';
                    echo '<input type="checkbox" name="' . $tag['tag_name'] . '" value="' . $tag['tag_name'] . '" ' . $tagChecked . '>';
                    echo '</div>';
                }
                ?>
            </div>
            <div class="edit__form__thumbnail">
                <label for="thumbnail">Change or remove thumbnail:</label>
                <input type="file" name="thumbnail" class="edit__form__input">
            </div>
            <input type="submit" value="Edit video" class="edit__btn">
        </form>
    </main>

    <script>
        $('textarea').autoResize();
    </script>

</body>

</html>