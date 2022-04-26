
$(document).ready( function () {

  "use strict";

$(document).on('click', '.dropdown-menu', function (e) {
    e.stopPropagation();
  });

  $('.home-slider').slick({
    nav:true,
    dots:true,
  }); 
  $('.slider').slick({
    nav:false,
    slidesToShow: 4,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 4,
          infinite: true,
          dots: false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  }); 

  $('.recently-viewed-slider').slick({
    nav:false,
    slidesToShow: 6,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 6,
          slidesToScroll: 6,
          infinite: true,
          dots: false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  $("[data-trigger]").on("click", function(e){
    e.preventDefault();
    e.stopPropagation();
    var offcanvas_id =  $(this).attr('data-trigger');
    $(offcanvas_id).toggleClass("show");
    $('body').toggleClass("offcanvas-active");
    $(".screen-overlay").toggleClass("show");
}); 

$(".btn-close, .screen-overlay").click(function(e){
   $(".screen-overlay").removeClass("show");
   $(".offcanvas").removeClass("show");
   $("body").removeClass("offcanvas-active");
});   

$(function() {
  $('#sub-menu').smartmenus({
    subMenusSubOffsetX: 1,
    subMenusSubOffsetY: -8
  });
});

if ($(window).width() > '1200') {
  $('#sub-menu > li').hover(
      function () {
          if ($(this).children().hasClass('has-submenu')) {
              $(this).parents().find('nav').addClass('sidebar-unset');
          }
      },
      function () {
          $(this).parents().find('nav').removeClass('sidebar-unset');
      }
  )
}
$(window).on('scroll',function() {
  if ($(this).scrollTop() > 300) {
    $('.header-sticky').addClass("sticky");
  } else {
    $('.header-sticky').removeClass("sticky");
  }
});

$(function(){
  $.scrollUp();
});

$('.collapse-block-title').on('click', function (e) {
  e.preventDefault;
  var speed = 300;
  var thisItem = $(this).parent(),
      nextLevel = $(this).next('.collection-collapse-block-content');
  if (thisItem.hasClass('open')) {
      thisItem.removeClass('open');
      nextLevel.slideUp(speed);
  } else {
      thisItem.addClass('open');
      nextLevel.slideDown(speed);
  }
});

$('.color-selector ul li').on('click', function (e) {
  $(".color-selector ul li").removeClass("active");
  $(this).addClass("active");
});






$('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  focusOnSelect: true
});

$('.size-box ul li').on('click', function (e) {
  $(".size-box ul li").removeClass("active");
  $('#selectSize').removeClass('cartMove');
  $(this).addClass("active");
  $(this).parent().addClass('selected');
});

/*=====================
      Quantity Counter
     ==========================*/
     $('.qty-box .quantity-right-plus').on('click', function () {
      var $qty = $('.qty-box .input-number');
      var currentVal = parseInt($qty.val(), 10);
      if (!isNaN(currentVal)) {
          $qty.val(currentVal + 1);
      }
  });
  $('.qty-box .quantity-left-minus').on('click', function () {
      var $qty = $('.qty-box .input-number');
      var currentVal = parseInt($qty.val(), 10);
      if (!isNaN(currentVal) && currentVal > 1) {
          $qty.val(currentVal - 1);
      }
  });

 /* $('#cartEffect').on('click', function (e) {

    if ($("#selectSize .size-box ul").hasClass('selected')) {
        $('#cartEffect').text("Added to bag ");
        $('.added-notification').addClass("show");
        setTimeout(function () {
            $('.added-notification').removeClass("show");
        }, 5000);
    } else {
        $('#selectSize').addClass('cartMove');
    }
});  */

  
     




/* rate */

document.querySelectorAll('#star_review').forEach(function(element) {
  element.addEventListener("mouseenter", function(event) {
    $('#stars_confirm').html('');
    var stars = event.target.dataset.number;
    $('#star_input').val(stars);
    var count = 0;
    document.querySelectorAll('#star_review').forEach(function(el) {
      if (count < stars) {
        $(el).removeClass('fa-star gray');
        $(el).addClass('fa-star');
        $('#stars_confirm').append('<i class="fa fa-star" aria-hidden="true" style="color:#212529 !important"></i>');
      } else {
        $(el).removeClass('fa-star');
        $(el).addClass('fa-star gray');
      }
      count = count+1;
    });
  });
  
  element.addEventListener("mouseleave", function(event) {
    document.querySelectorAll('#star_review').forEach(function(el) {
      $(el).removeClass('fa-star');
      $(el).addClass('fa-star gray');
    });
  });
});




/** filter mobile **/
$('.sidebar-popup').on('click', function (e) {
  $('.open-popup').toggleClass('open');
  $('.collection-filter-block').css("left", "-15px");
});
$('.filter-btn').on('click', function (e) {
  $('.collection-filter-block').css("left", "-15px");
});
$('.filter-back').on('click', function (e) {
  $('.collection-filter-block').css("left", "-365px");
  $('.sidebar-popup').trigger('click');
});

$('.venobox').venobox();

});

