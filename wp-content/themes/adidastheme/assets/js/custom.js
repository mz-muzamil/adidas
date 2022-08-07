jQuery(document).ready(function ($) {
  $(".home-banner").owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    items: 1,
    autoplay: true,
    // animateOut: 'fadeOut',
    navText: [
      "<i class='fa-solid fa-angle-left'></i>",
      "<i class='fa-solid fa-angle-right'></i>",
    ],
  });

  $(".sports-carousel").owlCarousel({
    loop: false,
    margin: 30,
    nav: true,
    navText: [
      "<i class='fa-solid fa-angle-left'></i>",
      "<i class='fa-solid fa-angle-right'></i>",
    ],
    responsive: {
      0: {
        items: 1,
      },
      400: {
        items: 2,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 3,
      },      
      1200: {
        items: 4,
      }
    },
  });

  Fancybox.bind("[data-fancybox]", {
    infinite: false,
    groupAttr: false,
  });

  $('[data-bs-toggle="tooltip"]').tooltip();
  $("#demoTab").easyResponsiveTabs();
});
