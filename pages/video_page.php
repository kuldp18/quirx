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

    <main class="player">
        <video class="player__video video-js" controls preload="auto" width="650" height="300" poster="../uploads/thumbnails/65a02e21d102a8.98463163.jpg" data-setup="{}">
            <source src="../uploads/videos/65a02735805f18.02559713.mp4" type="video/mp4" />
            <p class="vjs-no-js">
                To view this video please enable JavaScript, and consider upgrading to a
                web browser that
                <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
            </p>
        </video>

        <section class="player__stats">
            <p class="video__title">This is a really long sample video title for testing this app, the name of this app is Quirx.</p>
            <div class="player__stats__sub">
                <div class="player__stats__sub__left">
                    <p class="user__name">
                        <a href="#" class="user__name__link">User 1</a>
                    </p>
                    <button class="subscribe__btn">Subscribe</button>
                </div>
                <div class="player__stats__sub__right">
                    <p class="video__views">
                        <span class="views">10</span> views
                    </p>
                </div>
            </div>

            <div class="player__stats__ratings">
                <div class="player__stats__ratings__left">
                    <p class="rate">Rate this video: </p>
                    <span class="stars">⭐⭐⭐⭐⭐</span>
                </div>
                <div class="player__stats__ratings__right">
                    <p class="ratings">
                        Rating: <span class="average__rating">4.5</span>
                    </p>
                </div>
            </div>
        </section>


        <section class="player__description">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem soluta sint officia suscipit commodi consequatur? Autem mollitia cum sequi voluptatibus facere vitae, aliquid enim, accusamus impedit accusantium blanditiis quia iusto quos dolorum iure? Reprehenderit doloremque eaque cum voluptates sequi corporis officiis magnam voluptate tempore, fugit dignissimos nisi tempora. Asperiores facilis, molestias corrupti amet placeat expedita officiis tempore sint maiores officia ratione, fuga facere nisi inventore eveniet deserunt. Recusandae vitae assumenda debitis cum, nemo ad adipisci nulla, temporibus quod magni reiciendis saepe? Velit, quia! Sed, iste. Explicabo deserunt sunt ipsum natus consequuntur quidem perspiciatis tempore ducimus et reprehenderit ipsam, exercitationem autem.
        </section>

    </main>





    <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
</body>

</html>