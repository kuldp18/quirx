let modal = document.querySelector('.modal');

if (modal) {
  let closeBtn = document.querySelector('.modal__close');

  // add event listener only if closeBtn exists
  if (closeBtn) {
    closeBtn.addEventListener('click', function () {
      let parent = document.querySelector('.modal');
      parent.remove();
    });
  }
}
