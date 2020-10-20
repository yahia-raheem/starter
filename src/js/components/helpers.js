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
  const removeChildTag = document.querySelectorAll("[data-removeChildTag]");
  const aspectRatio = document.querySelectorAll('[data-aspectRatio]');


  // adds 'active' class to menu item when the current pages url is the same as the links href
  if (menuLinks.length > 0) {
    menuLinks.forEach((one) => {
      if (window.location.href == one.href) {
        one.classList.add("active");
      }
    });
  }

  // trims strings to be as long as the provided length in the 'data-trim' attribute
  if (doTrim.length > 0) {
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
  if (detImages.length > 0) {
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
  if (sReplace.length > 0) {
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

  // removes an html tag from children of a node.
  if (removeChildTag.length > 0) {
    removeChildTag.forEach((one) => {
      let tag = one.getAttribute("data-removeChildTag");
      let b = one.getElementsByTagName(tag);
      while (b.length) {
        let parent = b[0].parentNode;
        while (b[0].firstChild) {
          parent.insertBefore(b[0].firstChild, b[0]);
        }
        parent.removeChild(b[0]);
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
  if (mobSheet.length > 0) {
    mobSheet.forEach((one) => {
      dict = one.getAttribute("data-mobilesheet");
      data = JSON.parse(dict);
      one.style.transition = "height 0.5s, box-shadow 0.2s";
      let buttons = one.querySelectorAll("[data-open]");
      if (buttons) {
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

  // determine height based on width (aspect ratio)
  if (aspectRatio.length > 0) {
    aspectRatio.forEach((one) => {
      let width = one.offsetWidth
      let aspectRatio = one.getAttribute('data-aspectRatio');
      let height = detHeight(aspectRatio, width);
      one.style.height = `${height}px`;
    });
    window.addEventListener('resize', () => {
      aspectRatio.forEach((one) => {
        let width = one.offsetWidth
        let aspectRatio = one.getAttribute('data-aspectRatio');
        let height = detHeight(aspectRatio, width);
        one.style.height = `${height}px`;
      });
    });
  }
});

const detHeight = (aspectRatio, width) => {
  let data = aspectRatio.split('/');
  let aspectWidth = data[0];
  let aspectHeight = data[1];
  let height = parseInt(width) * parseInt(aspectHeight) / parseInt(aspectWidth);
  return height;
}

const openSheet = (element) => {
  let buttons = element.querySelectorAll("[data-open]");
  element.classList.add("shadow-vail", "open");
  element.style.height = data.expandedHeight;
  buttons.forEach((button) => {
    button.setAttribute("data-open", "true");
    data.removedClasses
      ? data.removedClasses.forEach((rclass) => {
        element
          .querySelector(`.${rclass.divClass}`)
          .classList.remove(rclass.toRemove);
      })
      : null;
    data.addedClasses
      ? data.addedClasses.forEach((aclass) => {
        element
          .querySelector(`.${aclass.divClass}`)
          .classList.add(aclass.toAdd);
      })
      : null;
    data.changedClasses
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
    data.removedClasses
      ? data.removedClasses.forEach((rclass) => {
        element
          .querySelector(`.${rclass.divClass}`)
          .classList.add(rclass.toRemove);
      })
      : null;
    data.addedClasses
      ? data.addedClasses.forEach((aclass) => {
        element
          .querySelector(`.${aclass.divClass}`)
          .classList.remove(aclass.toAdd);
      })
      : null;
    data.changedClasses
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
};

const isVisible = (elem) =>
  !!elem &&
  !!(elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length);

export const setCookie = (name, value, days) => {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
export const getCookie = (name) => {
  var nameEQ = name + "=";
  var ca = document.cookie.split(";");
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}
export const eraseCookie = (name) => {
  document.cookie = name + "=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
}

export const elementObserver = (callback, options) => new IntersectionObserver(
  (entries, observer) => {
      entries.forEach(entry => {
          let target = entry.target;
          if (entry.isIntersecting) {
              callback(options);
          }
      });
  },
  {
      threshold: 0.25
  }
).observe(options.element);