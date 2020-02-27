document.addEventListener("DOMContentLoaded", () => {
  const loader = document.querySelector(".loader");
  window.addEventListener("load", () => {
    loader.classList.add("done");
  });
  const links = document.querySelectorAll("a");
  links.forEach(link => {
    link.addEventListener("click", e => {
      e.preventDefault();
      window.history.pushState({ usedPush: true }, null, link.href);
      loader.classList.remove("done");
      loader.classList.add("pending");
      window.history.go();
    });
  });
});

$(document).ready(function() {});
