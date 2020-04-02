function mySlider(autoDelay, slideChangeDelay) {
  var slides = document.querySelectorAll(".mySlides");
  var dots = document.querySelectorAll(".dot");
  var prev = document.querySelector(".prev");
  var next = document.querySelector(".next");
  var slideIndex = 1;
  var called = false;
  showSlides(slideIndex);
  window.onbeforeunload = () => {
    clearInterval(autoSlide);
  };
  let autoSlide = window.setInterval(() => {
    if (!called) {
      plusSlides(1);
    }
  }, autoDelay);
  dots.forEach(one => {
    one.addEventListener("click", () => {
      showSlides((slideIndex = one.getAttribute("data-slide")));
    });
  });
  prev.addEventListener("click", () => {
    plusSlides(-1);
  });

  next.addEventListener("click", () => {
    plusSlides(1);
  });
  function plusSlides(n) {
    showSlides((slideIndex += n));
  }
  function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }
  function showSlides(n) {
    called = !called;
    if (called) {
      var i;
      if (n > slides.length) {
        slideIndex = 1;
      }
      if (n < 1) {
        slideIndex = slides.length;
      }
      for (i = 0; i < slides.length; i++) {
        if (slides[i].classList.contains("show")) {
          slides[i].classList.remove("show");
          let slide = slides[i];
          sleep(slideChangeDelay).then(() => {
            slide.style.display = "none";
          });
        } else {
          slides[i].style.display = "none";
          slides[i].classList.remove("show");
        }
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      slides[slideIndex - 1].classList.add("show");
      dots[slideIndex - 1].className += " active";
      called = !called;
    }
  }
}
