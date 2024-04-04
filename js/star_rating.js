const stars = document.querySelectorAll(".far.fa-star");

const videoId = document.querySelector(".video__id__span").innerText.trim();

let clickedStarIndex = -1; // global variable to keep track of clicked star

function hoverStar() {
  stars.forEach((star, index) => {
    star.addEventListener("mouseover", () => {
      updateStars(index, "mouseover");
    });
    star.addEventListener("mouseout", () => {
      updateStars(clickedStarIndex, "mouseout");
    });
    star.addEventListener("click", () => {
      clickedStarIndex = index;
      updateStars(clickedStarIndex, "click");

      let rating = clickedStarIndex + 1;
      console.log("rating: ", rating);
      console.log("videoId: ", videoId);
      ratingAjax(rating, videoId);
    });
  });
}

function updateStars(starIndex, eventType) {
  stars.forEach((star, index) => {
    if (index <= starIndex) {
      star.classList.remove("far");
      star.classList.add("fas");
    } else {
      if (eventType !== "click" || index > clickedStarIndex) {
        star.classList.remove("fas");
        star.classList.add("far");
      }
    }
  });
}

hoverStar();

function ratingAjax(rating, video_id) {
  fetch("../includes/star_rating.inc.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ rating, video_id: video_id }),
  });
}
