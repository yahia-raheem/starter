export const setCookie = (name, value, days) => {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
};
export const getCookie = (name) => {
  var nameEQ = name + "=";
  var ca = document.cookie.split(";");
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
};
export const eraseCookie = (name) => {
  document.cookie = name + "=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
};

export const elementObserver = (callback, options) =>
  new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        let target = entry.target;
        if (entry.isIntersecting) {
          callback(options);
        }
      });
    },
    {
      threshold: 0.25,
    }
  ).observe(options.element);

export const matchHeight = (selector) => {
  let objects = document.querySelectorAll(selector);
  let heights = Array.from(objects).map((x, i, a) => {
    return x.offsetHeight;
  });
  let max = Math.max(...heights);
  objects.forEach((el) => {
    el.style.height = `${max}px`;
  });
};
