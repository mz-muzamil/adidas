jQuery(document).ready(function ($) {
  $(".home-banner").owlCarousel({
    loop: true,
    margin: 0,
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
      },
    },
  });

  Fancybox.bind("[data-fancybox]", {
    infinite: false,
    groupAttr: false,
    Hash: false,
  });

  function next_prev_posts(first_post_id, last_post_id) {
    jQuery.ajax({
      type: "POST",
      data: {
        action: "get_next_prev_events",
        data: [
          { first_post_id: first_post_id },
          { last_post_id: last_post_id },
        ],
      },
      url: "http://localhost/adidas/wp-admin/admin-post.php",
      success: function (data) {
        console.log(data);
      },
    });
  }

  $(".prev-button").on("click", function () {
    var first_post_id = $(".event-article").attr("data-first_post_id");
    next_prev_posts(null, first_post_id);
  });

  $(".next-button").on("click", function () {
    var last_post_id = $(".event-article").attr("data-last_post_id");
    next_prev_posts(last_post_id, null);
  });

  $("#commentform p input[type=text], #commentform p textarea, #commentform p input[type=email], #commentform p input[type=url]").addClass("form-control");
  $("#commentform p input[type=submit]").addClass("btn btn-success");
  $("#commentform p input[type=submit]").val("Submit");
  
});
