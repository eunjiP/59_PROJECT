let weekButtons = document.querySelectorAll(".listing-card__info__week");

weekButtons.forEach((weekButton, index) => {
  weekButton.addEventListener("click", () => {
    if (weekButtons[index].classList == "listing-card__info__week") {
      weekButtons[index].classList.add("active");
    } else {
      weekButtons[index].classList.remove("active");
    }
  });
});

let tabs = document.querySelectorAll(".tabs__toggle"),
  contents = document.querySelectorAll(".tabs__content");

tabs.forEach((tab, index) => {
  tab.addEventListener("click", () => {
    contents.forEach((content) => {
      content.classList.remove("is-active");
    });
    tabs.forEach((tab) => {
      tab.classList.remove("is-active");
    });
    contents[index].classList.add("is-active");
    tabs[index].classList.add("is-active");
  });
});

// ---------------------------------nav 바---------------------------------

const body = document.querySelector("body"),
  darkMode = body.querySelector(".mode-text"),
  listcard = body.querySelectorAll(".listing-card__item"),
  sidebar = body.querySelector(".sidebar"),
  toggle = body.querySelector(".toggle"),
  searchBtn = body.querySelector(".search-box"),
  modeSwitch = body.querySelector(".toggle-switch"),
  modeText = body.querySelector(".mode-text");

toggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});
modeSwitch.addEventListener("click", () => {
  body.classList.toggle("dark");
  darkMode.classList.toggle("dark");

  if (body.classList.contains("dark")) {
    modeText.innerHTML = "Light Mode";
  } else {
    modeText.innerHTML = "Dark Mode";
  }
});

// ---------------------------------편집 카드---------------------------------

const details = document.querySelectorAll(".detail__icon");
details.forEach((detail, index) => {
  detail.addEventListener("click", () => {
    details[index].classList.toggle("show");
  });
});

