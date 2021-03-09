/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/js/bundle.js":
/*!**************************!*\
  !*** ./src/js/bundle.js ***!
  \**************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_helpers__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./components/helpers */ "./src/js/components/helpers.js");
/* harmony import */ var _components_sidebar__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/sidebar */ "./src/js/components/sidebar.js");
/* harmony import */ var _components_sidebar__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_components_sidebar__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _components_shared__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/shared */ "./src/js/components/shared.js");
// import "./components/bootstrap-imports";
// import "slick-carousel";
// import "./components/my-navbar";
// import "./components/navigator";
// import "./components/widgets";


 // import $ from "jquery";

document.addEventListener("DOMContentLoaded", function () {}); // $(function () {
//   $(document).on('click', '.dropdown-menu', function (e) {
//     e.stopPropagation();
//   });
//   var windowSize = $(window).width();
//   if (windowSize > 1200) {
//     $("ul.navbar-nav li.dropdown:not(.megamenu)").hover(
//       function () {
//         $(this).find(">.dropdown-menu").stop(true, true).delay(50).fadeIn(200);
//       },
//       function () {
//         $(this).find(">.dropdown-menu").stop(true, true).delay(50).fadeOut(200);
//       }
//     );
//   } else {
//     $("ul.navbar-nav li.dropdown > a.dropdown-toggle")
//       .attr("href", "#")
//       .attr("data-toggle", "dropdown")
//       .removeAttr("data-hover");
//   }
// });

/***/ }),

/***/ "./src/js/components/helper-funcs.js":
/*!*******************************************!*\
  !*** ./src/js/components/helper-funcs.js ***!
  \*******************************************/
/*! exports provided: setCookie, getCookie, eraseCookie, elementObserver, matchHeight, invertColor, hideOnClickOutside, imgTosvg */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "setCookie", function() { return setCookie; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getCookie", function() { return getCookie; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "eraseCookie", function() { return eraseCookie; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "elementObserver", function() { return elementObserver; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "matchHeight", function() { return matchHeight; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "invertColor", function() { return invertColor; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "hideOnClickOutside", function() { return hideOnClickOutside; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "imgTosvg", function() { return imgTosvg; });
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var setCookie = function setCookie(name, value, days) {
  var expires = "";

  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    expires = "; expires=" + date.toUTCString();
  }

  document.cookie = name + "=" + (value || "") + expires + "; path=/";
};
var getCookie = function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(";");

  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];

    while (c.charAt(0) == " ") {
      c = c.substring(1, c.length);
    }

    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }

  return null;
};
var eraseCookie = function eraseCookie(name) {
  document.cookie = name + "=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
};
var elementObserver = function elementObserver(callback, options) {
  return new IntersectionObserver(function (entries, observer) {
    entries.forEach(function (entry) {
      var target = entry.target;

      if (entry.isIntersecting) {
        callback(options);
      }
    });
  }, {
    threshold: 0.25
  }).observe(options.element);
};
var matchHeight = function matchHeight(selector) {
  var objects = document.querySelectorAll(selector);
  var heights = Array.from(objects).map(function (x, i, a) {
    return x.offsetHeight;
  });
  var max = Math.max.apply(Math, _toConsumableArray(heights));
  objects.forEach(function (el) {
    el.style.height = "".concat(max, "px");
  });
};
var invertColor = function invertColor(hex, bw) {
  if (hex.indexOf("#") === 0) {
    hex = hex.slice(1);
  } // convert 3-digit hex to 6-digits.


  if (hex.length === 3) {
    hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
  }

  if (hex.length !== 6) {
    throw new Error("Invalid HEX color.");
  }

  var r = parseInt(hex.slice(0, 2), 16),
      g = parseInt(hex.slice(2, 4), 16),
      b = parseInt(hex.slice(4, 6), 16);

  if (bw) {
    // http://stackoverflow.com/a/3943023/112731
    return r * 0.299 + g * 0.587 + b * 0.114 > 186 ? "#000000" : "#FFFFFF";
  } // invert color components


  r = (255 - r).toString(16);
  g = (255 - g).toString(16);
  b = (255 - b).toString(16); // pad each with zeros and return

  return "#" + padZero(r) + padZero(g) + padZero(b);
};
var hideOnClickOutside = function hideOnClickOutside(element, callback, check) {
  console.log(check);

  var outsideClickListener = function outsideClickListener(event) {
    if (!element.contains(event.target) && check) {
      callback();
      removeClickListener();
    }
  };

  var removeClickListener = function removeClickListener() {
    document.removeEventListener("click", outsideClickListener);
  };

  document.addEventListener("click", outsideClickListener);
};
var imgTosvg = function imgTosvg(options) {
  var img = options["element"];
  var index = options["index"];
  var imgURL = img.getAttribute("src");
  var imgID = img.getAttribute("id");
  var imgWidth = img.getAttribute("width");
  var imgHeight = img.getAttribute("height");
  var imgClasses = img.getAttribute("class");
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var resPure = this.responseText.trim();
      var parentDiv = document.createElement("div");
      parentDiv.innerHTML = resPure;
      var svg = parentDiv.querySelector("svg");

      if (svg != null) {
        if (imgID != null) {
          svg.setAttribute("id", imgID);
        } else {
          svg.setAttribute("id", "replaced-svg-".concat(index));
        }

        svg.removeAttribute("xmlns:a");
        svg.setAttribute("class", imgClasses);
        svg.setAttribute("width", imgWidth);
        svg.setAttribute("height", imgHeight);
        img.parentNode.replaceChild(svg, img);
      }
    }
  };

  xhttp.open("GET", imgURL, true);
  xhttp.send();
};

/***/ }),

/***/ "./src/js/components/helpers.js":
/*!**************************************!*\
  !*** ./src/js/components/helpers.js ***!
  \**************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _helper_funcs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./helper-funcs */ "./src/js/components/helper-funcs.js");

document.addEventListener("DOMContentLoaded", function () {
  // constants for various functions explained below (just comment the constant and the script is no longer excuted)
  var doTrim = document.querySelectorAll("[data-trim]");
  var detImages = document.querySelectorAll(".det-res-img");
  var sReplace = document.querySelectorAll("[data-replace]");
  var mobSheet = document.querySelectorAll("[data-mobilesheet]");
  var sWidth = screen.width;
  var removeChildTag = document.querySelectorAll("[data-removeChildTag]");
  var aspectRatio = document.querySelectorAll('[data-aspectRatio]');
  var colorDivs = document.querySelectorAll('[data-color]');
  var menuIcons = document.querySelectorAll(".menu-icon");
  var selectInputs = document.querySelectorAll(".wpcf7 select"); // colors the select field with the placeholder color until the first option is changed (first options's value has to be empty and the cf7 mixin has to be used)

  if (typeof selectInputs != "undefined" && selectInputs.length > 0) {
    selectInputs.forEach(function (select) {
      if (select.value == "") {
        select.classList.add("untouched");
      }

      var changeEvent = function changeEvent(e) {
        console.log('fired');
        select.classList.remove("untouched");
        removeChangeEvent();
      };

      var removeChangeEvent = function removeChangeEvent() {
        select.removeEventListener("change", changeEvent);
      };

      select.addEventListener("change", changeEvent);
    });
  } // adds icons to the navigation menu item if both ".menu-icon" and "icon-[image id]" classes exist in extra classes (this depends on an api endpoint)


  if (typeof menuIcons !== "undefined" && menuIcons.length > 0) {
    var baseUrl = window.location.origin;
    menuIcons.forEach(function (one, i) {
      var iconId = Array.from(one.classList).find(function (single) {
        return /^icon-/.test(single);
      });

      if (iconId) {
        var requestUrl = "".concat(baseUrl, "/wp-json/generaldata/v1/getimage/").concat(iconId.split("-")[1]);
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            var resPure = JSON.parse(this.responseText).trim();
            var parentDiv = document.createElement("div");
            parentDiv.innerHTML = resPure;
            var img = parentDiv.querySelector("img");
            one.prepend(img);
            one.classList.remove(iconId); // imgTosvg({'element': img, 'index': i});
          }
        };

        xhttp.open("GET", requestUrl, true);
        xhttp.send();
      }
    });
  } // finds all occurances of data-color and makes a css variable named --elm-color available to the div for it and all of its decendants


  if (typeof colorDivs !== 'undefined' && colorDivs.length > 0) {
    colorDivs.forEach(function (one) {
      var color = one.getAttribute('data-color');
      one.style.setProperty("--elm-color", color);
    });
  } // trims strings to be as long as the provided length in the 'data-trim' attribute


  if (typeof doTrim !== 'undefined' && doTrim.length > 0) {
    doTrim.forEach(function (one) {
      var length = one.getAttribute("data-trim");
      one.innerHTML = one.innerHTML.length > length ? one.innerHTML.substring(0, length) + "..." : one.innerHTML;
      one.removeAttribute("data-trim");
    });
  } // determine the appropriate image to use when different images are used on mobile and desktop
  // if (typeof detImages !== 'undefined' && detImages.length > 0) {
  //   detImages.forEach((one) => {
  //     if (sWidth >= 768) {
  //       one.setAttribute(
  //         "data-srcset",
  //         one.getAttribute("data-srcset-desktop")
  //       );
  //       one.setAttribute("data-src", one.getAttribute("data-src-desktop"));
  //     } else {
  //       one.setAttribute("data-srcset", one.getAttribute("data-srcset-mobile"));
  //       one.setAttribute("data-src", one.getAttribute("data-src-mobile"));
  //     }
  //     one.removeAttribute("data-srcset-desktop");
  //     one.removeAttribute("data-srcset-mobile");
  //     one.removeAttribute("data-src-desktop");
  //     one.removeAttribute("data-src-mobile");
  //     one.classList.add("lazyload");
  //   });
  // }
  // replaces a character with another based on both 'data-replace' and 'data-replaced-with' and removes the attributes after its done
  // if (typeof sReplace !== 'undefined' && sReplace.length > 0) {
  //   sReplace.forEach((one) => {
  //     var replaced = one.getAttribute("data-replace");
  //     var replaceWith = one.getAttribute("data-replace-with");
  //     if (replaced && replaceWith) {
  //       one.innerHTML = one.innerHTML.replace(replaced, replaceWith);
  //       one.removeAttribute("data-replace");
  //       one.removeAttribute("data-replace-with");
  //     }
  //   });
  // }
  // removes an html tag from children of a node.
  // if (typeof removeChildTag !== 'undefined' && removeChildTag.length > 0) {
  //   removeChildTag.forEach((one) => {
  //     let tag = one.getAttribute("data-removeChildTag");
  //     let b = one.getElementsByTagName(tag);
  //     while (b.length) {
  //       let parent = b[0].parentNode;
  //       while (b[0].firstChild) {
  //         parent.insertBefore(b[0].firstChild, b[0]);
  //       }
  //       parent.removeChild(b[0]);
  //     }
  //   });
  // }
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
  // if (typeof mobSheet !== 'undefined' && mobSheet.length > 0) {
  //   mobSheet.forEach((one) => {
  //     dict = one.getAttribute("data-mobilesheet");
  //     data = JSON.parse(dict);
  //     one.style.transition = "height 0.5s, box-shadow 0.2s";
  //     let buttons = one.querySelectorAll("[data-open]");
  //     if (buttons) {
  //       buttons.forEach((button) => {
  //         button.addEventListener("click", () => {
  //           if (!one.classList.contains("open")) {
  //             openSheet(one);
  //           } else {
  //             closeSheet(one);
  //           }
  //         });
  //       });
  //     }
  //   });
  // }
  // determine height based on width (aspect ratio)


  if (typeof aspectRatio !== 'undefined' && aspectRatio.length > 0) {
    aspectRatio.forEach(function (one) {
      var width = one.offsetWidth;
      var aspectRatio = one.getAttribute('data-aspectRatio');
      var height = detHeight(aspectRatio, width);
      one.style.height = "".concat(height, "px");
    });
    window.addEventListener('resize', function () {
      aspectRatio.forEach(function (one) {
        var width = one.offsetWidth;
        var aspectRatio = one.getAttribute('data-aspectRatio');
        var height = detHeight(aspectRatio, width);
        one.style.height = "".concat(height, "px");
      });
    });
  }
});

var detHeight = function detHeight(aspectRatio, width) {
  var data = aspectRatio.split('/');
  var aspectWidth = data[0];
  var aspectHeight = data[1];
  var height = parseInt(width) * parseInt(aspectHeight) / parseInt(aspectWidth);
  return height;
};

var openSheet = function openSheet(element) {
  var buttons = element.querySelectorAll("[data-open]");
  element.classList.add("shadow-vail", "open");
  element.style.height = data.expandedHeight;
  buttons.forEach(function (button) {
    button.setAttribute("data-open", "true");
    data.removedClasses ? data.removedClasses.forEach(function (rclass) {
      element.querySelector(".".concat(rclass.divClass)).classList.remove(rclass.toRemove);
    }) : null;
    data.addedClasses ? data.addedClasses.forEach(function (aclass) {
      element.querySelector(".".concat(aclass.divClass)).classList.add(aclass.toAdd);
    }) : null;
    data.changedClasses ? data.changedClasses.forEach(function (cclass) {
      element.querySelector(".".concat(cclass.divClass)).classList.remove(cclass.toChange);
      element.querySelector(".".concat(cclass.divClass)).classList.add(cclass.changeWith);
    }) : null;
  });
  hideOnClickOutside(element);
};

var closeSheet = function closeSheet(element) {
  var buttons = element.querySelectorAll("[data-open]");
  element.classList.remove("shadow-vail", "open");
  element.style.height = data.normalHeight;
  buttons.forEach(function (button) {
    button.setAttribute("data-open", "false");
    data.removedClasses ? data.removedClasses.forEach(function (rclass) {
      element.querySelector(".".concat(rclass.divClass)).classList.add(rclass.toRemove);
    }) : null;
    data.addedClasses ? data.addedClasses.forEach(function (aclass) {
      element.querySelector(".".concat(aclass.divClass)).classList.remove(aclass.toAdd);
    }) : null;
    data.changedClasses ? data.changedClasses.forEach(function (cclass) {
      element.querySelector(".".concat(cclass.divClass)).classList.add(cclass.toChange);
      element.querySelector(".".concat(cclass.divClass)).classList.remove(cclass.changeWith);
    }) : null;
  });
};

var hideOnClickOutside = function hideOnClickOutside(element) {
  var outsideClickListener = function outsideClickListener(event) {
    if (!element.contains(event.target) && isVisible(element)) {
      closeSheet(element);
      document.removeEventListener("click", outsideClickListener);
    }
  };

  document.addEventListener("click", outsideClickListener);
};

var isVisible = function isVisible(elem) {
  return !!elem && !!(elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length);
};

/***/ }),

/***/ "./src/js/components/shared.js":
/*!*************************************!*\
  !*** ./src/js/components/shared.js ***!
  \*************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _helper_funcs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./helper-funcs */ "./src/js/components/helper-funcs.js");

document.addEventListener("DOMContentLoaded", function () {
  var svgImages = document.querySelectorAll(".style-svg");
  svgImages.forEach(function (img, index) {
    Object(_helper_funcs__WEBPACK_IMPORTED_MODULE_0__["elementObserver"])(_helper_funcs__WEBPACK_IMPORTED_MODULE_0__["imgTosvg"], {
      element: img,
      index: index
    });
  });
});

/***/ }),

/***/ "./src/js/components/sidebar.js":
/*!**************************************!*\
  !*** ./src/js/components/sidebar.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var isOpen = false;
var sideBar = document.getElementById("mySidenav");
document.addEventListener("DOMContentLoaded", function () {
  var togglebtn = document.querySelector(".navbar-toggler");
  var closebtn = document.querySelector(".closebtn");
  var sidemenuItems = document.querySelectorAll(".mobile-menu .menu-item");
  sidemenuItems.forEach(function (item) {
    item.addEventListener("click", function (e) {
      e.stopPropagation();

      if (item.classList.contains("menu-item-has-children")) {
        var submenu = item.querySelector(".sub-menu");
        var itemsNum = item.querySelectorAll(".menu-item").length;

        if (submenu.classList.contains("opened")) {
          item.classList.remove('child-menu-opened');
          submenu.classList.remove("opened");
          submenu.style.maxHeight = 0;
        } else {
          item.classList.add('child-menu-opened');
          submenu.classList.add("opened");
          submenu.style.maxHeight = "".concat(itemsNum * 64, "px");
        }
      }
    });
  });
  togglebtn.addEventListener("click", function () {
    openNav();
    document.addEventListener("click", outsideClickListener);
    setTimeout(function () {
      isOpen = true;
    }, 1000);
  });
  closebtn.addEventListener("click", function () {
    closeNav();
  });
});

var openNav = function openNav() {
  sideBar.style.width = "100vw";
};

var closeNav = function closeNav() {
  sideBar.style.width = "0";
  isOpen = false;
  removeClickListener();
};

var outsideClickListener = function outsideClickListener(event) {
  if (!sideBar.contains(event.target) && isOpen) {
    closeNav();
  }
};

var removeClickListener = function removeClickListener() {
  document.removeEventListener("click", outsideClickListener);
};

/***/ }),

/***/ 0:
/*!********************************!*\
  !*** multi ./src/js/bundle.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /mnt/0CA504390CA50439/projects/deployed/starter/src/js/bundle.js */"./src/js/bundle.js");


/***/ })

/******/ });