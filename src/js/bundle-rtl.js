import "./components/bootstrap-imports";
// import "../../node_modules/slick-carousel/slick/slick.min";
// import "./components/my-navbar";
// import './components/shared';
import "./components/helpers";
import "./components/navigator";
import 'lazysizes';
import 'lazysizes/plugins/respimg/ls.respimg';

import $ from "jquery";


document.addEventListener("DOMContentLoaded", () => { });

$(function () {
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



