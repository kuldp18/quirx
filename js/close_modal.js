const closeBtn = document.querySelector('.modal__close');
closeBtn.addEventListener('click', () => {
  let parent = document.querySelector('.modal');
  parent.remove();
});
