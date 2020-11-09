document.addEventListener("DOMContentLoaded", () => {
  const gradients = document.querySelectorAll("[data-gradient]");
  if (gradients.length > 0) {
    gradients.forEach((one) => {
      let gradientColor = one.getAttribute("data-gradient");
      one.style.background = `radial-gradient(circle, rgba(255, 255, 255, 1) 0%, ${gradientColor} 91%)`;
    });
  }
});
