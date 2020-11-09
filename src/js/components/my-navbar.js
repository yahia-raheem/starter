document.addEventListener("DOMContentLoaded", () => {
  var navBar = document.querySelector(".nav-container");
  var mobNav = document.querySelector('.nav-container.mobile');
  navDesktop();
  navMobile();
  document.addEventListener("scroll", function () {
    navDesktop();
    navMobile();
  });

  function navDesktop() {
    var scrollTop =
      document.documentElement.scrollTop || document.body.scrollTop;
    if (scrollTop > 80) {
      navBar.querySelector('.nav-bar').classList.add('fixed', 'shadow');
    } else {
        navBar.querySelector('.nav-bar').classList.remove('fixed', 'shadow');
    }
  }

  function navMobile() {
    var scrollTop =
      document.documentElement.scrollTop || document.body.scrollTop;
    if (scrollTop > 80) {
      mobNav.querySelector('.caption').classList.add('hide');
      mobNav.querySelector('.navbar-brand').classList.remove('hide');
    } else {
      mobNav.querySelector('.caption').classList.remove('hide');
      mobNav.querySelector('.navbar-brand').classList.add('hide');
    }
  }
});
