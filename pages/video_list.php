<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quirx - Video Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/video_list.css" />
    <link rel="stylesheet" href="../css/navbar.css" />
</head>

<body>
    <?php include_once('../includes/components/navbar.inc.php') ?>


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
                <a href="./video_page.php" class="video__link">
                    <article class="video">
                        <div class="video__thumbnail">
                            <!-- TODO: Figure out width and height attributes -->
                            <!-- TODO: Add alt attribute -->
                            <img src="#" alt="" class="video__thumbnail__img">
                        </div>
                        <div class="video__details">
                            <h3 class="video__details__title">This is a sample video title that is very long and should be truncated after this</h3>
                            <p class="video__details__user">User 1</p>
                        </div>
                    </article>
                </a>

                <article class="video">
                    <div class="video__thumbnail">
                        <!-- TODO: Figure out width and height attributes -->
                        <!-- TODO: Add alt attribute -->
                        <img src="#" alt="" class="video__thumbnail__img">
                    </div>
                    <div class="video__details">
                        <h3 class="video__details__title">This is a sample video title that is very long and should be truncated after this</h3>
                        <p class="video__details__user">User 1</p>
                    </div>
                </article>

                <article class="video">
                    <div class="video__thumbnail">
                        <!-- TODO: Figure out width and height attributes -->
                        <!-- TODO: Add alt attribute -->
                        <img src="#" alt="" class="video__thumbnail__img">
                    </div>
                    <div class="video__details">
                        <h3 class="video__details__title">This is a sample video title that is very long and should be truncated after this</h3>
                        <p class="video__details__user">User 1</p>
                    </div>
                </article>

                <article class="video">
                    <div class="video__thumbnail">
                        <!-- TODO: Figure out width and height attributes -->
                        <!-- TODO: Add alt attribute -->
                        <img src="#" alt="" class="video__thumbnail__img">
                    </div>
                    <div class="video__details">
                        <h3 class="video__details__title">This is a sample video title that is very long and should be truncated after this</h3>
                        <p class="video__details__user">User 1</p>
                    </div>
                </article>


                <article class="video">
                    <div class="video__thumbnail">
                        <!-- TODO: Figure out width and height attributes -->
                        <!-- TODO: Add alt attribute -->
                        <img src="#" alt="" class="video__thumbnail__img">
                    </div>
                    <div class="video__details">
                        <h3 class="video__details__title">This is a sample video title that is very long and should be truncated after this</h3>
                        <p class="video__details__user">User 1</p>
                    </div>
                </article>
            </section>
        </section>
        <section class="videos__subscriptions">
            <h2 class="videos__title">From your subscriptions</h2>
            <section class="video-list">
                <article class="video">
                    <div class="video__thumbnail">
                        <!-- TODO: Figure out width and height attributes -->
                        <!-- TODO: Add alt attribute -->
                        <img src="#" alt="" class="video__thumbnail__img">
                    </div>
                    <div class="video__details">
                        <h3 class="video__details__title">This is a sample video title that is very long and should be truncated after this</h3>
                        <p class="video__details__user">User 1</p>
                    </div>
                </article>

                <article class="video">
                    <div class="video__thumbnail">
                        <!-- TODO: Figure out width and height attributes -->
                        <!-- TODO: Add alt attribute -->
                        <img src="#" alt="" class="video__thumbnail__img">
                    </div>
                    <div class="video__details">
                        <h3 class="video__details__title">This is a sample video title that is very long and should be truncated after this</h3>
                        <p class="video__details__user">User 1</p>
                    </div>
                </article>


                <article class="video">
                    <div class="video__thumbnail">
                        <!-- TODO: Figure out width and height attributes -->
                        <!-- TODO: Add alt attribute -->
                        <img src="#" alt="" class="video__thumbnail__img">
                    </div>
                    <div class="video__details">
                        <h3 class="video__details__title">This is a sample video title that is very long and should be truncated after this</h3>
                        <p class="video__details__user">User 1</p>
                    </div>
                </article>
            </section>
        </section>
    </main>

    <script>
        // truncate each video title after certain characters

        function truncateVideoTitle(titleElement, maxLength) {
            let truncatedText = titleElement.textContent.slice(0, maxLength) + '...';
            titleElement.textContent = truncatedText;
        }

        const videoTitles = document.querySelectorAll('.video__details__title');
        videoTitles.forEach(title => {
            truncateVideoTitle(title, 70);
        });

        async function getRandomImage() {
            try {
                let response = await fetch("https://picsum.photos/1280/720");
                if (response.ok) {
                    let {
                        url
                    } = await response;
                    return url;
                } else {
                    throw new Error('Failed to fetch image');
                }
            } catch (error) {
                console.error('Error fetching image:', error);
                return null;
            }
        }

        async function setThumbnails() {
            let thumbnails = document.querySelectorAll('.video__thumbnail__img');
            thumbnails.forEach(async thumbnail => {
                try {
                    let image = await getRandomImage();
                    if (image) {
                        thumbnail.src = image;
                    }
                } catch (error) {
                    console.error('Error setting thumbnail:', error);
                }
            });
        }

        // Call setThumbnails to set the thumbnails once the page is loaded
        window.addEventListener('load', setThumbnails);
    </script>
</body>

</html>