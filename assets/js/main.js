/**
 * Adds the 'loaded' class to the body once the window has fully loaded.
 */
window.addEventListener("load", function() {
  document.body.classList.add('loaded');
});



document.addEventListener('DOMContentLoaded', function () {
  const navbar = document.querySelector('.arnabwp-navbar');
  const mainNav = document.getElementById('mainNav');

  if (!navbar || !mainNav) return;

  // Scroll detection function
  function updateNavbarOnScroll() {
      if (window.scrollY > 10) {
          navbar.classList.add('scrolled');
      } else {
          navbar.classList.remove('scrolled');
      }
  }

  // Front page logic: Handle sticky and non-sticky navbar separately
  if (navbar) {
      if (navbar.classList.contains('sticky-navbar')) {
          // If sticky, handle scroll events
          window.addEventListener('scroll', updateNavbarOnScroll);
          updateNavbarOnScroll();  // Run initially

          // Bootstrap collapse toggle events
          mainNav.addEventListener('show.bs.collapse', function () {
              navbar.classList.add('scrolled');
          });

          mainNav.addEventListener('hide.bs.collapse', function () {
              updateNavbarOnScroll();
          });
      } else {
          // For non-sticky navbar, keep it transparent unless scrolled
          window.addEventListener('scroll', updateNavbarOnScroll);
          updateNavbarOnScroll();  // Run initially
      }
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const dropdowns = document.querySelectorAll(".navbar .dropdown");

  if (window.innerWidth >= 992) {
    dropdowns.forEach((dropdown) => {
      dropdown.addEventListener("mouseenter", function () {
        const menu = this.querySelector(".dropdown-menu");
        menu.classList.add("show");
      });

      dropdown.addEventListener("mouseleave", function () {
        const menu = this.querySelector(".dropdown-menu");
        menu.classList.remove("show");
      });
    });
  }
});


/**
 * Displays or hides the "scroll-to-top" button depending on scroll position.
 */
window.onscroll = function() {
  let scrollToTopBtn = document.getElementById("scrollToTop");
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    scrollToTopBtn.style.display = "block";
  } else {
    scrollToTopBtn.style.display = "none";
  }
};

/**
 * Smoothly scrolls to the top of the page when the "scroll-to-top" button is clicked.
 */
document.getElementById("scrollToTop").addEventListener("click", function() {
  window.scrollTo({ top: 0, behavior: "smooth" });
});