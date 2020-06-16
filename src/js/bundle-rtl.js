import "../../node_modules/bootstrap/dist/js/bootstrap.bundle.min";
import "../../node_modules/slick-carousel/slick/slick.min";
import "./components/my-navbar";
import 'lazysizes';
import 'lazysizes/plugins/respimg/ls.respimg';

import $ from "jquery";


document.addEventListener("DOMContentLoaded", () => {
  const packageButtons = document.querySelectorAll(".package-btn");
  const packages = document.querySelectorAll(".home-package");
  const menuLinks = document.querySelectorAll(
    ".nav-container .navbar-nav a.nav-link"
  );
  console.log(window.location.href);
  let currentPackageValue = 30;
  activatePackage(currentPackageValue);

  packageButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      currentPackageValue = btn.dataset.value;
      activatePackage(currentPackageValue);
    })
  });

  packages.forEach((one) => {
    one.addEventListener("mouseover", () => {
      one.classList.add("highlighted");
    });
    one.addEventListener("mouseout", () => {
      one.classList.remove("highlighted");
    })
  });

  menuLinks.forEach((one) => {
    if (window.location.href == one.href) {
      one.classList.add("active");
    }
  });

  function activatePackage(val) {
    packageButtons.forEach((btn) => {
      if (btn.dataset.value == val) {
        btn.classList.add('active');
      } else {
        btn.classList.remove('active');
      }
    })
    document.querySelectorAll(".package-col").forEach((one) => {
      if (one.dataset.for == val) {
        one.classList.add('active');
      } else {
        one.classList.remove('active');
      }
    });
  }
});

$(document).ready(function() {
  $("ul.navbar-nav li.dropdown").hover(
    function () {
      $(this).find(".dropdown-menu").stop(true, true).delay(50).fadeIn(200);
    },
    function () {
      $(this).find(".dropdown-menu").stop(true, true).delay(50).fadeOut(200);
    }
  );

  $(".instructor-slider").slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2500,
    lazyLoad: 'progressive',
    responsive: [
      {
        breakpoint: 1400,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 800,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });
  $('.t-slider').slick({
    dots: true,
    infinite: true,
    speed: 1000,
    arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    lazyLoad: 'progressive'
  })
});



