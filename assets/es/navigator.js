document.addEventListener("DOMContentLoaded", () => {
  const loader = document.querySelector(".loader");
  window.addEventListener("load", () => {
    loader.classList.add("done");
  });
  const links = document.querySelectorAll("a");
  links.forEach(link => {
    if (link.hasAttribute("href") && link.dataset.toggle == null && !link.href.endsWith('.html')) {
      link.addEventListener("click", e => {
        e.preventDefault();
        if (
          window.location.host == "localhost" ||
          window.location.host == "projects.emarketing-arabia.com"
        ) {
          if (
            window.location.pathname.replace(/^\//, "") ==
            link.pathname.replace(/^\//, "").concat("/")
          ) {
            var target = $(link.hash);
            target = target.length
              ? target
              : $("[name=" + link.hash.slice(1) + "]");
            if (target.length) {
              window.scroll({
                top: target.offset().top,
                behavior: "smooth"
              });
              return false;
            }
          }
        } else {
          if (
            window.location.pathname.replace(/^\//, "") ==
            link.pathname.replace(/^\//, "")
          ) {
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
    }
  });
});
