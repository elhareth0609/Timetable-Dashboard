(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
    $("#sidebarToggleTop").on('click', function(e) {
        // $("body").toggleClass("sidebar-toggled");
        if (!$(".sidebar").hasClass("toggled")) {
            $(".sidebar").addClass("toggled");
            $('#overlay').css('display', 'block'); // Hide the overlay after click
            if ($(".sidebar").hasClass("myToggled")) {
                $(".sidebar").removeClass("myToggled");
            }
        };
    });



    $("#mySidebarToggle").on('click', function(e) {
        var $sidebar = $(".sidebar");
        var $icon = $(this).find("span");

        if (!$sidebar.hasClass("myToggled")) {
            $sidebar.addClass("myToggled");
            $icon.removeClass("mdi-radiobox-marked").addClass("mdi-radiobox-blank");
        } else {
            $sidebar.removeClass("myToggled");
            $icon.removeClass("mdi-radiobox-blank").addClass("mdi-radiobox-marked");
        }
    });


  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
//     if ($(window).width() < 768) {
//       $('.sidebar .collapse').collapse('hide');
//     };

// //     // Toggle the side navigation when window is resized below 480px
    // if ($(window).width() < 768 && !$(".sidebar").hasClass("toggled")) {
    //     $("body").addClass("sidebar-toggled");
    //     $(".sidebar").addClass("toggled");
    //     $('#overlay').css('display', 'block'); // Hide the overlay after click
    //     // $('.sidebar .collapse').collapse('hide');
    // };
    if ($(window).width() > 768 && $(".sidebar").hasClass("toggled")) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        $('#overlay').css('display', 'none'); // Hide the overlay after click

        // $('.sidebar .collapse').collapse('hide');
    };

  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

})(jQuery); // End of use strict
