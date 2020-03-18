"use strict";

document.addEventListener("DOMContentLoaded", function () {
  var loader = document.querySelector(".loader");
  window.addEventListener("load", function () {
    loader.classList.add("done");
  });
  var links = document.querySelectorAll("a");
  links.forEach(function (link) {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      if (window.location.host == "localhost" || window.location.host == "projects.emarketing-arabia.com") {
        if (window.location.pathname.replace(/^\//, "") == link.pathname.replace(/^\//, "").concat("/")) {
          var target = $(link.hash);
          target = target.length ? target : $("[name=" + link.hash.slice(1) + "]");
          if (target.length) {
            window.scroll({
              top: target.offset().top,
              behavior: "smooth"
            });
            return false;
          }
        }
      } else {
        if (window.location.pathname.replace(/^\//, "") == link.pathname.replace(/^\//, "")) {
          var target = $(link.hash);
          if (target.length) {
            window.scroll({
              top: target.offset().top,
              behavior: "smooth"
            });
            return false;
          }
        }
      }
      window.history.pushState({ usedPush: true }, null, link.href);
      loader.classList.remove("done");
      loader.classList.add("pending");
      window.history.go();
    });
  });
});