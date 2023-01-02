jQuery(document).ready(function ($) {
  window.outerRepeater = $(".outer-repeater").repeater({
    isFirstItemUndeletable: true,
    show: function () {
      $(this).slideDown();
    },
    hide: function (deleteElement) {
      $(this).slideUp(deleteElement);
    },
  });
  $("#home_slider").on("submit", function (e) {
    e.preventDefault();
    var dataVariable = {
      action: "home_slider", // your action name
      data: $("#home_slider").serialize(), // some additional data to send
    };
    $.ajax({
      url: ajaxurl,
      type: "POST",
      data: dataVariable,
      success: function (response) {
        console.log(response);
      },
    });
  });

  var addButton = document.getElementById("img-upload-btn");
  var deleteButton = document.getElementById("img-delete-btn");
  var image = document.getElementById("img-data");
  var hidden = document.getElementById("img-hidden-field");

  var customUploader = wp.media({
    title: "Select Slide image",
    button: {
      text: "use this image",
    },
    multiple: false,
  });

  addButton.addEventListener("click", function () {
    if (custom_uploader) {
      custom_uploader.open();
      return;
    }
  });
});
