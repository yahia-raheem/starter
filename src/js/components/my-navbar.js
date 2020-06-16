document.addEventListener("DOMContentLoaded", () => {
  var navBar = document.querySelector(".nav-container");
  var mobNav = false;
  navDesktop();
  document.addEventListener("scroll", function () {
    navDesktop();
  });

  document
    .querySelector(".navbar-toggler")
    .addEventListener("click", function () {
      navMobile();
    });

  function navDesktop() {
    var scrollTop =
      document.documentElement.scrollTop || document.body.scrollTop;
    if (scrollTop > 80) {
      navBar.classList.add("shadow", "fixed");
      navBar.querySelector(".top-bar-container").classList.add("scrolled");
    } else {
      if (mobNav == false) {
        navBar.classList.remove("shadow", "fixed");
      }
      navBar.querySelector(".top-bar-container").classList.remove("scrolled");
    }
  }

  function navMobile() {
    var scrollTop =
      document.documentElement.scrollTop || document.body.scrollTop;
    if (mobNav == false) {
      if (scrollTop <= 80) {
        navBar.classList.add("shadow");
      } else {
        navBar.querySelector(".top-bar-container").classList.add("scrolled");
      }
      mobNav = true;
    } else {
      if (scrollTop <= 80) {
        navBar.classList.remove("fixed");
        navBar.querySelector(".top-bar-container").classList.remove("scrolled");
      }
      mobNav = false;
    }
  }
});
