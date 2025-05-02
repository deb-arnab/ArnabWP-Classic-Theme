/**
 * Initializes the hero slider using Owl Carousel.
 * 
 * @requires Owl Carousel
 */
jQuery(document).ready(function($) {
    $(".owl-carousel.hero-slider").owlCarousel({
      items: 1, // Show one slide at a time
      loop: true, // Loop the slides
      autoplay: true, // Enable autoplay
      autoplayTimeout: 3000, // Delay between slides
      autoplayHoverPause: true, // Pause on hover
      nav: true, // Show navigation buttons
      dots: true, // Show pagination dots
      responsive: {
        600: { items: 1 },
        1000: { items: 1 }
      }
    });
  });
  
  /**
   * Initializes the employee slider using Owl Carousel.
   * 
   * @requires Owl Carousel
   */
  jQuery(document).ready(function($) {
    $(".owl-carousel.employee-slider").owlCarousel({
      loop: true,
      margin: 20,
      nav: false,
      dots: false,
      autoplay: true,
      responsive: {
        0: { items: 1 },
        600: { items: 2 },
        1000: { items: 4 }
      }
    });
  });
  
  /**
   * Initializes the client logo carousel using Owl Carousel.
   * 
   * @requires Owl Carousel
   */
  jQuery(document).ready(function($) {
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
  
  /**
   * Initializes the testimonial slider using Owl Carousel.
   * 
   * @requires Owl Carousel
   */
  jQuery(document).ready(function($) {
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