import "../../node_modules/bootstrap/dist/js/bootstrap.bundle.min";
// import "../../node_modules/slick-carousel/slick/slick.min";
import "./components/my-navbar";
import "./components/navigator";
import 'lazysizes';
import 'lazysizes/plugins/respimg/ls.respimg';

import $ from "jquery";


document.addEventListener("DOMContentLoaded", () => {
  const menuLinks = document.querySelectorAll(
    ".nav-container .navbar-nav a.nav-link"
  );
  const doTrim = document.querySelectorAll("[data-trim]");

  menuLinks.forEach((one) => {
    if (window.location.href == one.href) {
      one.classList.add("active");
    }
  });

  doTrim.forEach((one) => {
    var length = one.getAttribute('data-trim');
    one.innerHTML = one.innerHTML.length > length ? one.innerHTML.substring(0, length) + "..." : one.innerHTML;
  });
});

$(document).ready(function() {
  var windowSize = $(window).width();
  if (windowSize > 1200) {
    $("ul.navbar-nav li.dropdown").hover(
      function () {
        $(this).find(">.dropdown-menu").stop(true, true).delay(50).fadeIn(200);
      },
      function () {
        $(this).find(">.dropdown-menu").stop(true, true).delay(50).fadeOut(200);
      }
    );
  } else {
    $("ul.navbar-nav li.dropdown > a.dropdown-toggle")
      .attr("href", "#")
      .attr("data-toggle", "dropdown")
      .removeAttr("data-hover");
  }
});



