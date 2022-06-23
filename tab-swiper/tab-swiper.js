// swiper 기능
var swiper = new Swiper('.mySwiper', {
  slidesPerView: 3.5,
  spaceBetween: 20,
});

// tabs 기능
let tabs = document.querySelectorAll('.tabs__toggle'),
  contents = document.querySelectorAll('.tabs__content');

tabs.forEach((tab, index) => {
  tab.addEventListener('click', () => {
    contents.forEach((content) => {
      content.classList.remove('is-active');
    });
    tabs.forEach((tab) => {
      tab.classList.remove('is-active');
    });
    contents[index].classList.add('is-active');
    tabs[index].classList.add('is-active');
  });
});
