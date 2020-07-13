document.addEventListener("DOMContentLoaded", () => {
  // constants for various functions explained below (just comment the constant and the script is no longer excuted)
  const menuLinks = document.querySelectorAll(
    ".navigation-bar .navbar-nav a.nav-link"
  );
  const doTrim = document.querySelectorAll("[data-trim]");
  const detImages = document.querySelectorAll(".det-res-img");
  const sReplace = document.querySelectorAll("[data-replace]");
  const mobSheet = document.querySelectorAll("[data-mobilesheet]");
  const sWidth = screen.width;

  // adds 'active' class to menu item when the current pages url is the same as the links href
  if (typeof menuLinks !== "undefined") {
    menuLinks.forEach((one) => {
      if (window.location.href == one.href) {
        one.classList.add("active");
      }
    });
  }

  // trims strings to be as long as the provided length in the 'data-trim' attribute
  if (typeof doTrim !== "undefined") {
    doTrim.forEach((one) => {
      var length = one.getAttribute("data-trim");
      one.innerHTML =
        one.innerHTML.length > length
          ? one.innerHTML.substring(0, length) + "..."
          : one.innerHTML;
      one.removeAttribute("data-trim");
    });
  }

  // determine the appropriate image to use when different images are used on mobile and desktop
  if (typeof detImages !== "undefined") {
    detImages.forEach((one) => {
      if (sWidth >= 768) {
        one.setAttribute(
          "data-srcset",
          one.getAttribute("data-srcset-desktop")
        );
        one.setAttribute("data-src", one.getAttribute("data-src-desktop"));
      } else {
        one.setAttribute("data-srcset", one.getAttribute("data-srcset-mobile"));
        one.setAttribute("data-src", one.getAttribute("data-src-mobile"));
      }
      one.removeAttribute("data-srcset-desktop");
      one.removeAttribute("data-srcset-mobile");
      one.removeAttribute("data-src-desktop");
      one.removeAttribute("data-src-mobile");
      one.classList.add("lazyload");
    });
  }

  // replaces a character with another based on both 'data-replace' and 'data-replaced-with' and removes the attributes after its done
  if (typeof sReplace !== "undefined") {
    sReplace.forEach((one) => {
      var replaced = one.getAttribute("data-replace");
      var replaceWith = one.getAttribute("data-replace-with");
      if (replaced && replaceWith) {
        one.innerHTML = one.innerHTML.replace(replaced, replaceWith);
        one.removeAttribute("data-replace");
        one.removeAttribute("data-replace-with");
      }
    });
  }

  // open bottom sheet (similar to the material bottom sheet) you should pass the following dictionary to it
  // var dict = {
  //   normalHeight: 'normal div height when the sheet is collapsed',
  //   expandedHeight: 'expanded div height',
  //   removedClasses: [
  //     {
  //       divClass: 'a class that always exists on the div that u want to remove a class from',
  //       toRemove: 'a class to remove',
  //     },
  //   ],
  //   addedClasses: [
  //     {
  //       divClass: 'a class that always exists on the div that u want to add a class to',
  //       toAdd: 'a class to add',
  //     },
  //   ],
  //   changedClasses: [
  //     {
  //       divClass: 'a class that always exists on the div that u want to add or remove a class to',
  //       toChange: 'a class to change',
  //       changeWith: 'the class to replace "to change" class with'
  //     },
  //   ]
  // };
  if (typeof mobSheet !== "undefined") {
    mobSheet.forEach((one) => {
      dict = one.getAttribute("data-mobilesheet");
      data = JSON.parse(dict);
      one.style.transition = "height 0.5s, box-shadow 0.2s";
      let buttons = one.querySelectorAll("[data-open]");
      if (typeof buttons !== "undefined") {
        buttons.forEach((button) => {
          button.addEventListener("click", () => {
            if (!one.classList.contains("open")) {
              openSheet(one);
            } else {
              closeSheet(one);
            }
          });
        });
      }
    });
  }
});

const openSheet = (element) => {
  let buttons = element.querySelectorAll("[data-open]");
  element.classList.add("shadow-vail", "open");
  element.style.height = data.expandedHeight;
  buttons.forEach((button) => {
    button.setAttribute("data-open", "true");
    typeof data.removedClasses !== "undefined"
      ? data.removedClasses.forEach((rclass) => {
          element
            .querySelector(`.${rclass.divClass}`)
            .classList.remove(rclass.toRemove);
        })
      : null;
    typeof data.addedClasses !== "undefined"
      ? data.addedClasses.forEach((aclass) => {
          element
            .querySelector(`.${aclass.divClass}`)
            .classList.add(aclass.toAdd);
        })
      : null;
    typeof data.changedClasses !== "undefined"
      ? data.changedClasses.forEach((cclass) => {
          element
            .querySelector(`.${cclass.divClass}`)
            .classList.remove(cclass.toChange);
          element
            .querySelector(`.${cclass.divClass}`)
            .classList.add(cclass.changeWith);
        })
      : null;
  });
  hideOnClickOutside(element);
};

const closeSheet = (element) => {
  let buttons = element.querySelectorAll("[data-open]");
  element.classList.remove("shadow-vail", "open");
  element.style.height = data.normalHeight;
  buttons.forEach((button) => {
    button.setAttribute("data-open", "false");
    typeof data.removedClasses !== "undefined"
      ? data.removedClasses.forEach((rclass) => {
          element
            .querySelector(`.${rclass.divClass}`)
            .classList.add(rclass.toRemove);
        })
      : null;
    typeof data.addedClasses !== "undefined"
      ? data.addedClasses.forEach((aclass) => {
          element
            .querySelector(`.${aclass.divClass}`)
            .classList.remove(aclass.toAdd);
        })
      : null;
    typeof data.changedClasses !== "undefined"
      ? data.changedClasses.forEach((cclass) => {
          element
            .querySelector(`.${cclass.divClass}`)
            .classList.add(cclass.toChange);
          element
            .querySelector(`.${cclass.divClass}`)
            .classList.remove(cclass.changeWith);
        })
      : null;
  });
};

const hideOnClickOutside = (element) => {
  const outsideClickListener = (event) => {
    if (!element.contains(event.target) && isVisible(element)) {
      closeSheet(element);
      document.removeEventListener("click", outsideClickListener);
    }
  };
  document.addEventListener("click", outsideClickListener);
}

const isVisible = (elem) =>
  !!elem &&
  !!(elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length);
