// truncate each video title after certain characters

function truncateVideoTitle(titleElement, maxLength) {
  let truncatedText = titleElement.textContent.slice(0, maxLength) + '...';
  titleElement.textContent = truncatedText;
}

const videoTitles = document.querySelectorAll('.video__details__title');
videoTitles.forEach((title) => {
  truncateVideoTitle(title, 70);
});

async function getRandomImage() {
  try {
    let response = await fetch('https://picsum.photos/1280/720');
    if (response.ok) {
      let { url } = await response;
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
  thumbnails.forEach(async (thumbnail) => {
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

// video-tilt

const allVideos = document.querySelectorAll('.video');
const options = {
  max: 20,
  speed: 100,
  glare: true,
  'max-glare': 0.3,
  scale: 1.02,
  transition: true,
  easing: 'cubic-bezier(.03,.98,.52,.99)',
};

VanillaTilt.init(allVideos, options);
