const stars = document.querySelectorAll(".far.fa-star");

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
