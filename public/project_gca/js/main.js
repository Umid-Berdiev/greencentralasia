window.addEventListener('DOMContentLoaded', (event) => {
  console.log('DOM fully loaded and parsed');
  $("#menu").on("click", "a", function(event) {
    event.preventDefault(); //опустошим стандартную обработку
    var id = $(this).attr("href"), //заберем айдишник блока с параметром URL
      top = $(id).offset().top; //определим высоту от начала страницы до якоря
    $("body,html").animate({ scrollTop: top }, 1000); //сделаем прокрутку за 1 с
  });

  var swiper2 = new Swiper(".swiper_docs", {
    slidesPerView: "auto",
    spaceBetween: 30,
    navigation: {
      nextEl: ".main-slider .swiper-button-next",
      prevEl: ".main-slider .swiper-button-prev",
    },
    loop: false,
    autoplay: {
      delay: 5000,
    },
    breakpoints: {
      767: {
        slidesPerView: 4,
        spaceBetween: 5,
        pagination: {
          clickable: true,
          el: ".swiper_docs .swiper-pagination",
          type: "bullets",
        },
      },
    },
  });

  var swiper33 = new Swiper('.media-swiper-container', {
    slidesPerView: 5,
    spaceBetween: 5,
    // init: false,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 5,
      },
      768: {
        slidesPerView: 4,
        spaceBetween: 5,
      },
      1024: {
        slidesPerView: 5,
        spaceBetween: 5,
      },
    }
  });

  $("span.togle_form_header").on("click", function() {
    $("header").toggleClass("active");
  });

  if ($(window).width() < 1200) {
    $(".hdr_top_main").wrap("<div class='new_s'></div>");
    $(".hdr_top_main")
      .append($(".ht_ul"))
      .append($(".form_header"));

    $(".hamburger").on("click", function() {
      $("body").addClass("menu_opened");
    });

    $("body").click(function(e) {
      if (!$(e.target).is(".new_s *,.hamburger, .hamburger *")) {
        $("body").removeClass("menu_opened");
      }
    });
  }
});