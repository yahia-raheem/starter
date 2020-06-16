
document.addEventListener("DOMContentLoaded", () => {
  const loader = document.querySelector(".loader");
  
  if (loader) {
    window.addEventListener("load", () => {
      loader.classList.add("done");
    });
  }
  const links = document.querySelectorAll("a");
  links.forEach((link) => {
    link.addEventListener("click", () => {
      if (
        !link.href.includes("tel:") &&
        !link.href.includes("mailto:") &&
        getLastPart(link.href) !== "#"
      ) {
        if (loader) {
          loader.classList.remove("done");
          loader.classList.add("pending");
        }
      }
    });
  });

  window.addEventListener("popstate", function (e) {
    if (loader && !getLastPart(e.target.location.href).includes("#")) {
      loader.classList.remove("done");
      loader.classList.add("pending");
    }
  });

  
});

function getLastPart(url) {
  var parts = url.split("/");
  return url.lastIndexOf("/") !== url.length - 1
    ? parts[parts.length - 1]
    : parts[parts.length - 2];
}


