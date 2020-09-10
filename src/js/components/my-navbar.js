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
      navBar.querySelector('.nav-bar').classList.add('fixed', 'shadow');
    } else {
      if (mobNav == false) {
        navBar.querySelector('.nav-bar').classList.remove('fixed', 'shadow');
      }
    }
  }

  function navMobile() {
    var scrollTop =
      document.documentElement.scrollTop || document.body.scrollTop;
    if (mobNav == false) {
      if (scrollTop <= 80) {
        navBar.querySelector('.nav-bar').classList.add('fixed', 'shadow');
      }
      mobNav = true;
    } else {
      if (scrollTop <= 80) {
        navBar.querySelector('.nav-bar').classList.remove('fixed', 'shadow');
      }
      mobNav = false;
    }
  }
});
