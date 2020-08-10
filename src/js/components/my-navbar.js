document.addEventListener("DOMContentLoaded", () => {
  const navBar = document.querySelector(".navigation");
  var mobNav = false;
  var lastScrollTop = 0;
  var scrollDirection;

  navDesktop();
  window.addEventListener(
    "scroll",
    () => {
      var st = window.pageYOffset || document.documentElement.scrollTop;
      if (st > lastScrollTop) {
        scrollDirection = 'down';
      } else {
        scrollDirection = 'up';
      }
      lastScrollTop = st <= 0 ? 0 : st;
      navDesktop();
    },
    false
  );

  document
    .querySelector(".navbar-toggler")
    .addEventListener("click", function () {
      mobNav = mobNav == false ? true : false;
      navMobile();
    });

  function navDesktop() {
    var scrollTop =
      document.documentElement.scrollTop || document.body.scrollTop;
    if (scrollDirection && scrollDirection == 'down' && scrollTop > 200 && mobNav == false) {
      navBar.classList.add('down');
      navBar.classList.remove('up');
    } else if (scrollDirection && scrollDirection == 'up' && scrollTop > 200 && mobNav == false) {
      navBar.classList.add('up');
      navBar.classList.remove('down');
    }
  }

  function navMobile() {
    
  }
});
