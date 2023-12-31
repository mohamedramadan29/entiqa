"use strict";
(function () {

  $(".select2").select2();
  $(".chat_com_option .make_inter_time").click(function () {
    $(".interview_options").toggle();
  })

  $("nav .profile_item").click(function (e) {
    e.stopPropagation();
    $("nav .profile_item .profile_links").toggle();
    $("nav .notification_links").hide();

  });
  document.addEventListener("click", function (e) {
    if (e.target != $("nav .profile_item")) {
      $("nav .profile_item .profile_links").hide();
    }
  });

  $("nav .notification_items").click(function (event) {
    event.stopPropagation();
    $("nav .notification_links").toggle();
    $("nav .profile_item .profile_links").hide();
  });
  document.addEventListener("click", function (event) {
    if (event.target != $("nav .notification_items")) {
      $("nav .notification_links").hide();
    }
  });



  $(".chat_com_option .send_con_contract").click(function () {
    $(".compelete_contract").toggle();
  })

  $(".chat_com_option .cancel_contract").click(function () {
    $(".cancel_contract_section").toggle();
  })

  $(".message_text .send_attachment").click(function () {
    $('.message_text input[type=file]').toggle();
  });

  $(".document_button").click(function () {
    $('.document_link').toggle();
  });
  if (window.location.href.includes("stars")) {
    $("#stars").addClass("active");
  }
  if (window.location.href.includes("fav")) {
    $("#fav").addClass("active");
    $("#stars").removeClass("active");
  }
  if (window.location.href.includes("emp")) {
    $("#emp").addClass("active");
    $("#stars").removeClass("active");
  }
  if (window.location.href.includes("index")) {
    $("#index").addClass("active");
  }
  if (window.location.href.includes("contact")) {
    $("#contacts").addClass("active");
  }
  if (window.location.href.includes("register")) {
    $("#register").addClass("active");
  }
  if (window.location.href.includes("login")) {
    $("#login").addClass("active");
  }
  if (window.location.href.includes("index")) {
    $("#individuals").addClass("active");
  }

  if (window.location.href.includes("exam")) {
    $("#exam_link").addClass("active");
  }

  $("#CountDownTimer").TimeCircles({
    time: {
      Days: { show: false }, Hours: { show: false }, Seconds: { show: false },
      Minutes: {
        show: true,
        text: "دقائق",
        color: "#F16583"
      },

    },
    circle_bg_color: "#EFEFEF",
    bg_width: 0.6,
  });

  $("#CountDownTimer").TimeCircles({ count_past_zero: false }).addListener(countdownComplete);
  function countdownComplete(unit, value, total) {
    if (total <= 0) {
      $(this).fadeOut('slow').replaceWith("<h2 class='text-center'>  انتهي وقت الاختبار!! </h2>");

    }
  }

  // Fade in and fade out are examples of how chaining can be done with TimeCircles
  $(".fadeIn").click(function () {
    $("#PageOpenTimer").fadeIn();
  });
  $(".fadeOut").click(function () {
    $("#PageOpenTimer").fadeOut();
  });

  $('.answer1').each(function () {
    $(this).click(function () {
      $(this).find('input[type="radio"]').prop('checked', true)
      $(this).css('background', '#00c4ff3d')
      $(this).siblings('li').css('background', 'white')
    })
  });

  $("#change_image").click(function () {
    $(".div_change_image").show();
  })

}());

