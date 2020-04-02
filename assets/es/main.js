document.addEventListener("DOMContentLoaded", () => {
  mySlider(5000, 1000);
  var image = document.querySelector(".logo-image");
  image.src = "images/Group 18.webp";
  var navBar = document.querySelector(".nav-container");
  var mobNav = false;
  navDesktop();
  document.addEventListener("scroll", function() {
    navDesktop();
  });

  document
    .querySelector(".navbar-toggler")
    .addEventListener("click", function() {
      navMobile();
    });

  function navDesktop() {
    var scrollTop =
      document.documentElement.scrollTop || document.body.scrollTop;
    if (scrollTop > 50) {
      navBar.style.position = "fixed";
      navBar.classList.add("shadow", "bg-light");
      navBar.querySelector("nav").classList.add("navbar-light");
      navBar.querySelector("nav").classList.remove("navbar-dark");
      navBar.style.padding = 0;
      var newUrl = "images/Group 16.webp";
    } else {
      if (mobNav == false) {
        navBar.style.position = "absolute";
        navBar.classList.remove("shadow", "bg-light");
        navBar.querySelector("nav").classList.remove("navbar-light");
        navBar.querySelector("nav").classList.add("navbar-dark");
        navBar.style.padding = null;
      }
      var newUrl = "images/Group 18.webp";
    }
    image.src = newUrl;
  }

  function navMobile() {
    var scrollTop =
      document.documentElement.scrollTop || document.body.scrollTop;
    if (mobNav == false) {
      if (scrollTop <= 50) {
        navBar.classList.add("shadow", "bg-light");
        navBar.querySelector("nav").classList.add("navbar-light");
        navBar.querySelector("nav").classList.remove("navbar-dark");
        var newUrl = "images/Group 16.webp";
        image.src = newUrl;
      }
      mobNav = true;
    } else {
      if (scrollTop <= 50) {
        navBar.style.position = "absolute";
        navBar.classList.remove("shadow", "bg-light");
        navBar.querySelector("nav").classList.remove("navbar-light");
        navBar.querySelector("nav").classList.add("navbar-dark");
        var newUrl = "images/Group 18.webp";
        image.src = newUrl;
      }
      mobNav = false;
    }
  }
});
$(document).ready(function() {});
