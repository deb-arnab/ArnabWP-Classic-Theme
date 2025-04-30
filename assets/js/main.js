
window.addEventListener("load", function() {
  document.body.classList.add('loaded');
});


jQuery(document).ready(function($){
    $(".owl-carousel.hero-slider").owlCarousel({
      items: 1, // Show one slide at a time
      loop: true, // Loop the slides
      autoplay: true, // Enable autoplay
      autoplayTimeout: 3000, // Autoplay timeout in milliseconds
      autoplayHoverPause: true, // Pause on hover
      nav: true, // Show navigation buttons
      dots: true, // Show pagination dots
      responsive: {
        600: {
          items: 1
        },
        1000: {
          items: 1
        }
      }
    });
  });

  jQuery(document).ready(function($){
    $(".owl-carousel.employee-slider").owlCarousel({
     
        loop: true,
        margin: 20,
        nav: false,
        dots: false, // Show pagination dots
        autoplay: true,
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            1000: { items: 4 }
        }
    });
});

jQuery(document).ready(function($){
  $('.owl-carousel.client-carousel').owlCarousel({
      loop: true,
      margin: 20,
      autoplay: true,
      autoplayTimeout: 3000,
      nav: false,
      dots: false,
      smartSpeed: 600,
      responsive: {
          0: { items: 2 },
          600: { items: 3 },
          1000: { items: 5 }
      }
  });
});


jQuery(document).ready(function($){
  $('.owl-carousel.testimonial-carousel').owlCarousel({
    loop: true,
    margin: 20,
    autoplay: true,
    autoplayTimeout: 6000,
    nav: false,
    dots: false,
    responsive: {
        0: { items: 1 },
        600: { items: 1 },
        1000: { items: 1 }
    }
});
});



// Show or hide the scroll-to-top button based on scroll position
window.onscroll = function() {
  let scrollToTopBtn = document.getElementById("scrollToTop");
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
      scrollToTopBtn.style.display = "block"; // Show button when scroll position is > 100px
  } else {
      scrollToTopBtn.style.display = "none"; // Hide button when scroll position is <= 100px
  }
};

// Scroll to top when the button is clicked
document.getElementById("scrollToTop").addEventListener("click", function() {
  window.scrollTo({ top: 0, behavior: "smooth" });
});