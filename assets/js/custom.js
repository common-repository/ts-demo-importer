/**
 * Themeshopy Custom JS
 *
 * @package Themeshopy
 *
 * Distributed under the MIT license - http://opensource.org/licenses/MIT
 */
jQuery(function($){
  "use strict";
    if (window.matchMedia('(min-width: 1025px)').matches)
    {
      jQuery('.menu > ul').superfish({
        delay:       500,
        animation:   {opacity:'show',height:'show'},
        speed:       'fast'
      });
    }

    jQuery('.search-icon > i').click(function(){
        jQuery(".serach_outer").slideDown(700);
    });

    jQuery('.closepop i').click(function(){
        jQuery(".serach_outer").slideUp(700);
    });
});

jQuery(function() {
  //----- OPEN
  jQuery('[data-popup-open]').on('click', function(e) {
    var targeted_popup_class = jQuery(this).attr('data-popup-open');
    jQuery('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

    e.preventDefault();
  });

  //----- CLOSE
  jQuery('[data-popup-close]').on('click', function(e) {
    var targeted_popup_class = jQuery(this).attr('data-popup-close');
    jQuery('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

    e.preventDefault();
  });
});

//Video Popup
jQuery(function() {
  //----- OPEN
  jQuery('[data-popup-open]').on('click', function(e) {
    var targeted_popup_class = jQuery(this).attr('data-popup-open');
    jQuery('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

    e.preventDefault();
  });

  //----- CLOSE
  jQuery('[data-popup-close]').on('click', function(e) {
    var targeted_popup_class = jQuery(this).attr('data-popup-close');
    jQuery('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

    e.preventDefault();
  });
});

function rtl_direction(){
  if (jQuery('body').hasClass("rtl")) {
     return true;
  } else {
     return false;
  }
}

jQuery('document').ready(function(){

    responsive_item =  {
                          0: {
                            items: 1
                          },
                          320: {
                            items: 1
                          },
                          500: {
                            items: 1
                          },
                          600: {
                            items: 2
                          },
                          800: {
                            items: 2
                          },
                          1024: {
                            items: 3
                          },
                          1100: {
                            items: 4
                          }
                        }

    if (ts_demo_importer_customscripts.theme_text_domain == 'advance-training-academy') {
      responsive_item =  {
                          0: {
                            items: 1,
                            margin: 10,
                          },
                          320: {
                            items: 1,
                            margin: 10,
                          },
                          500: {
                            items: 1,
                            margin: 10,
                          },
                          600: {
                            items: 2,
                            margin: 10,
                          },
                          800: {
                            items: 2,
                            navText: false
                          },
                          1024: {
                            items: 3,
                            navText: false
                          }
                        };
                      }


   if (ts_demo_importer_customscripts.theme_text_domain == 'advance-training-academy') {
      var margin = 50;
   }else {
    var margin = 20;
   }
    var owl = jQuery('#our-services .owl-carousel');
      owl.owlCarousel({
      margin: margin,
      nav: jQuery("#our-services").data('nav'),
      autoplay : true,
      lazyLoad: true,
      autoplayTimeout: parseInt(jQuery("#our-services").data('speed')),
      loop: jQuery("#our-services").data('loops'),
      dots:jQuery("#our-services").data('dots'),
      autoplayHoverPause:true,
      rtl:rtl_direction(),
      navText : ['<i class="fas fa-arrow-left"></i>','<i class="fas fa-arrow-right"></i>'],
      responsive: responsive_item,
      autoplayHoverPause : true,
      mouseDrag: true
    });

    var owl = jQuery('#our-projects .owl-carousel');
      owl.owlCarousel({
      // center: true,
      stagePadding: 0,
      margin: 20,
      nav: jQuery("#our-projects").data('nav'),
      autoplay : true,
      lazyLoad: true,
      autoplayTimeout: parseInt(jQuery("#our-projects").data('speed')),
      loop: jQuery("#our-projects").data('loops'),
      rtl:rtl_direction(),
      dots:jQuery("#our-projects").data('dots'),
      autoplayHoverPause:true,
      navText : ['<i class="fas fa-arrow-left"></i>','<i class="fas fa-arrow-right"></i>'],
      responsive: {
        0: {
          items: 1
        },
        480: {
          items: 2
        },
        600: {
          items: 2
        },
        767: {
          items: 2
        },
        860: {
          items: 3
        },
        1000: {
          items: 4
        }
      },
      autoplayHoverPause : true,
      mouseDrag: true
    });

    // upcoming events conference
    var owl = jQuery('#upcoming-events .owl-carousel');
      owl.owlCarousel({
      // center: true,
      stagePadding: 0,
      margin: 20,
      nav: jQuery("#upcoming-events").data('nav'),
      autoplay : true,
      lazyLoad: true,
      autoplayTimeout: parseInt(jQuery("#upcoming-events").data('speed')),
      loop: jQuery("#upcoming-events").data('loops'),
      rtl:rtl_direction(),
      dots:jQuery("#upcoming-events").data('dots'),
      autoplayHoverPause:true,
      navText : ['<i class="fas fa-arrow-left"></i>','<i class="fas fa-arrow-right"></i>'],
      responsive: {
        0: {
          items: 1
        },
        480: {
          items: 2
        },
        600: {
          items: 2
        },
        767: {
          items: 2
        },
        860: {
          items: 3
        },
        1000: {
          items: 3
        }
      },
      autoplayHoverPause : true,
      mouseDrag: true
    });

    var owl = jQuery('#hiring_roles .owl-carousel');
      owl.owlCarousel({
      // center: true,
      stagePadding: 0,
      margin: 20,
      nav: jQuery("#hiring_roles").data('nav'),
      autoplay : true,
      lazyLoad: true,
      autoplayTimeout: parseInt(jQuery("#hiring_roles").data('speed')),
      loop: jQuery("#hiring_roles").data('loops'),
      rtl:rtl_direction(),
      dots:jQuery("#hiring_roles").data('dots'),
      autoplayHoverPause:true,
      navText : ['<i class="fas fa-arrow-left"></i>','<i class="fas fa-arrow-right"></i>'],
      responsive: {
        0: {
          items: 1
        },
        480: {
          items: 2
        },
        600: {
          items: 2
        },
        767: {
          items: 2
        },
        860: {
          items: 3
        },
        1000: {
          items: 4
        }
      },
      autoplayHoverPause : true,
      mouseDrag: true
    });

    //  advance-training-academy counter
    var owl = jQuery('#Personalized-support .owl-carousel');
      owl.owlCarousel({
      // center: true,
      stagePadding: 0,
      margin: 20,
      nav: jQuery("#Personalized-support").data('nav'),
      autoplay : true,
      lazyLoad: true,
      autoplayTimeout: 3000,
      loop: true,
      rtl:rtl_direction(),
      dots:jQuery("#Personalized-support").data('dots'),
      autoplayHoverPause:true,
      // navText : ['<i class="fas fa-arrow-left"></i>','<i class="fas fa-arrow-right"></i>'],
      responsive: {
        0: {
          items: 1
        },
        480: {
          items: 1
        },
        600: {
          items: 2
        },
        767: {
          items: 2
        },
        860: {
          items: 3
        },
        1000: {
          items: 3
        }
      },
      autoplayHoverPause : true,
      mouseDrag: true
    });


    var owl = jQuery('#consult_us .owl-carousel');
      owl.owlCarousel({
      center: true,
      stagePadding: 0,
      margin: 30,
      nav: true,
      autoplay : true,
      lazyLoad: true,
      autoplayTimeout: 10000,
      loop: true,
      rtl:rtl_direction(),
      dots:jQuery("#consult_us").data('dots'),
      autoplayHoverPause:true,
      navText : ['<i class="fas fa-arrow-left"></i>','<i class="fas fa-arrow-right"></i>'],
      responsive: {
        0: {
          items: 1
        },
        480: {
          items: 2
        },
        600: {
          items: 2
        },
        767: {
          items: 2
        },
        860: {
          items: 3
        },
        1000: {
          items: 4
        }
      },
      autoplayHoverPause : true,
      mouseDrag: true
    });

    var owl = jQuery('#business_features .owl-carousel');
      owl.owlCarousel({
      margin: 10,
      nav: jQuery("#business_features").data('nav'),
      autoplay : true,
      lazyLoad: true,
      autoplayTimeout: parseInt(jQuery("#business_features").data('speed')),
      loop: jQuery("#business_features").data('loops'),
      dots:jQuery("#business_features").data('dots'),
      autoplayHoverPause:true,
      rtl:rtl_direction(),
      navText : ['<i class="fas fa-arrow-left"></i>','<i class="fas fa-arrow-right"></i>'],
      responsive: {
        0: {
          items: 1
        },
        320: {
          items: 1
        },
        500: {
          items: 1
        },
        600: {
          items: 2
        },
        800: {
          items: 2
        },
        992: {
          items: 3
        },
        1100: {
          items: 4
        }
      },
      autoplayHoverPause : true,
      mouseDrag: true
    });

    var owl = jQuery('#our-records .owl-carousel');
      owl.owlCarousel({
      margin: 20,
      nav: jQuery("#our-records").data('nav'),
      autoplay : true,
      lazyLoad: true,
      autoplayTimeout: parseInt(jQuery("#our-records").data('speed')),
      loop: jQuery("#our-records").data('loops'),
      dots:jQuery("#our-records").data('dots'),
      autoplayHoverPause:true,
      rtl:rtl_direction(),
      navText : ['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
          items: 1
        },
        500: {
          items: 2
        },
        600: {
          items: 3
        },
        700: {
          items: 3
        },
        900: {
          items: 3
        },
        1024: {
          items: 4
        }
      },
      autoplayHoverPause : true,
      mouseDrag: true
    });

    // new code
    var nav = ['<i class="fas fa-arrow-left"></i>','<i class="fas fa-arrow-right"></i>'];

    if (ts_demo_importer_customscripts.theme_text_domain == 'advance-consultancy') {
      nav =  ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'];
    }

    // new code

    var owl = jQuery('#testimonials .owl-carousel');
      owl.owlCarousel({
      margin: 20,
      nav: jQuery("#testimonials").data('nav'),
      autoplay : true,
      lazyLoad: true,
      autoplayTimeout: parseInt(jQuery("#testimonials").data('speed')),
      loop: jQuery("#testimonials").data('loops'),
      dots:jQuery("#testimonials").data('dots'),
      autoplayHoverPause:true,
      rtl:rtl_direction(),
      navText : nav,
      responsive: {
        0: {
          items: 1
        },
        320: {
          items: 1
        },
        500: {
          items: 1
        },
        600: {
          items: 1
        },
        800: {
          items: 1
        },
        900: {
          items: 1
        },
        1000: {
          items: 1
        }
      },
      autoplayHoverPause : true,
      mouseDrag: true
    });

    var owl = jQuery('#our-brands .owl-carousel');
      owl.owlCarousel({
      margin: 20,
      nav: jQuery("#our-brands").data('nav'),
      autoplay : true,
      lazyLoad: true,
      autoplayTimeout: parseInt(jQuery("#our-brands").data('speed')),
      loop: jQuery("#our-brands").data('loops'),
      dots:jQuery("#our-brands").data('dots'),
      autoplayHoverPause:true,
      rtl:rtl_direction(),
      navText : ['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
          items: 1
        },
        500: {
          items: 2
        },
        600: {
          items: 3
        },
        700: {
          items: 3
        },
        900: {
          items: 4
        },
        1000: {
          items: 5
        }
      },
      autoplayHoverPause : true,
      mouseDrag: true
    });

    //  ts_conference pricing plan
    var owl = jQuery('#pricing-plan .owl-carousel');
      owl.owlCarousel({
      margin: 20,
      // nav: jQuery("#our-brands").data('nav'),
      autoplay : true,
      lazyLoad: true,
      // autoplayTimeout: parseInt(jQuery("#our-brands").data('speed')),
      // loop: jQuery("#our-brands").data('loops'),
      // dots:jQuery("#our-brands").data('dots'),
      autoplayHoverPause:true,
      rtl:rtl_direction(),
      navText : ['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
          items: 1
        },
        500: {
          items: 1
        },
        600: {
          items: 2
        },
        700: {
          items: 2
        },
        900: {
          items: 2
        },
        1000: {
          items: 3
        }
      },
      autoplayHoverPause : true,
      mouseDrag: true
    });

    var owl = jQuery('#achievements .owl-carousel');
      owl.owlCarousel({
      margin: 20,
      nav: jQuery("#achievements").data('nav'),
      autoplay : true,
      lazyLoad: true,
      autoplayTimeout: parseInt(jQuery("#achievements").data('speed')),
      loop: jQuery("#achievements").data('loops'),
      dots:jQuery("#achievements").data('dots'),
      autoplayHoverPause:true,
      rtl:rtl_direction(),
      navText : ['<i class="fas fa-arrow-left"></i>','<i class="fas fa-arrow-right"></i>'],
      responsive: {
        0: {
          items: 1
        },
        320: {
          items: 1
        },
        500: {
          items: 1
        },
        600: {
          items: 1
        },
        800: {
          items: 1
        },
        1024: {
          items: 1
        },
        1100: {
          items: 1
        }
      },
      autoplayHoverPause : true,
      mouseDrag: true
    });

    AOS.init({
        mirror: false,
        once: true,
        disable: function () {
            var maxWidth = 800;
            return window.innerWidth < maxWidth;
        },
    });

    latest_post_responsive_item =  {
                            0: {
                              items: 1
                            },
                            320: {
                              items: 1
                            },
                            500: {
                              items: 1
                            },
                            600: {
                              items: 1
                            },
                            800: {
                              items: 2
                            },
                            1024: {
                              items: 3
                            },
                            1100: {
                              items: 3
                            }
                        }

    if (ts_demo_importer_customscripts.theme_text_domain == 'ts-conference') {
      latest_post_responsive_item =  {
                            0: {
                              items: 1
                            },
                            320: {
                              items: 1
                            },
                            500: {
                              items: 1
                            },
                            600: {
                              items: 2
                            },
                            800: {
                              items: 2
                            },
                            1024: {
                              items: 3
                            },
                            1100: {
                              items: 3
                            }
                        };
                      }


    var owl = jQuery('#latest-news .owl-carousel');
      owl.owlCarousel({
      margin: 20,
      nav: jQuery("#latest-news").data('nav'),
      autoplay : true,
      lazyLoad: true,
      autoplayTimeout:5000,
      loop: jQuery("#latest-news").data('loops'),
      dots:jQuery("#latest-news").data('dots'),
      autoplayHoverPause:true,
      rtl:rtl_direction(),
      navText : ['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: latest_post_responsive_item,
      // autoplayHoverPause : true,
      mouseDrag: true
    });


    jQuery('#upcoming-events .slider-for').slick({
       slidesToShow: 1,
       slidesToScroll: 1,
       arrows: false,
       fade: true,
       asNavFor: '.slider-nav',
       infinite:true
      });
    jQuery('#upcoming-events .slider-nav').slick({
       slidesToShow: 3,
       slidesToScroll: 1,
       arrows: false,
       asNavFor: '.slider-for',
       dots: false,
       centerMode: false,
       focusOnSelect: true,
       vertical: true,
       arrow: false,
       infinite:true,
       autoplay: true,
       responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        vertical: false,
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        vertical: false,
      }
    }
  ]
    });

    if (ts_demo_importer_customscripts.theme_text_domain != 'advance-training-academy') {
      jQuery('#latest-news .owl-nav .owl-prev').append('<span class="latest-news-dots">nav</span>');
      jQuery('#latest-news  .owl-nav .owl-next').append('<span class="latest-news-dots">nav</span>');

      jQuery('#testimonials .owl-nav .owl-prev').append('<span class="testimonial-dots">nav</span>');
      jQuery('#testimonials  .owl-nav .owl-next').append('<span class="testimonial-dots">nav</span>');

      jQuery('#our-services .owl-nav .owl-prev').append('<span class="services-dots">nav</span>');
      jQuery('#our-services  .owl-nav .owl-next').append('<span class="services-dots">nav</span>');

      jQuery('#our-brands .owl-nav .owl-prev').append('<span class="brands-dots">nav</span>');
      jQuery('#our-brands  .owl-nav .owl-next').append('<span class="brands-dots">nav</span>');

      jQuery('#our-records .owl-nav .owl-prev').append('<span class="records-dots">nav</span>');
      jQuery('#our-records .owl-nav .owl-next').append('<span class="records-dots">nav</span>');
    }


    //  advance-training-academy
    jQuery('#myBtn').click(function() {
      jQuery('.video-modal-new').css('display', 'flex');
    });

    jQuery('.close-one').click(function() {
      jQuery('.video-modal-new').css('display', 'none');
    });

    // advance-training-academy count down START
      function countDownTimer(date) {
        var elem = jQuery('#timer');
        var futureTime = new Date(date).getTime();

        setInterval(function() {
          // Time left between future and current time in Seconds
          var timeLeft = Math.floor( (futureTime - new Date().getTime()) / 1000 );
          var days =  Math.floor(timeLeft / 86400);
          timeLeft -= days * 86400;
          var hours = Math.floor(timeLeft / 3600) % 24;
          timeLeft -= hours * 3600;
          var min = Math.floor(timeLeft / 60) % 60;
          timeLeft -= min * 60;
          var sec = timeLeft % 60;
          var timeString = "<span class='days'><b>"+days+"</b> Days "+"</span>"+
                           "<span class='hours'><b>"+hours+"</b> Hours "+"</span>"+
                           "<span class='minutes'><b>"+min+"</b> Minutes "+"</span>"+
                           "<span class='seconds'><b>"+sec+"</b> Seconds "+"</span>";

          elem.html(timeString);

        }, 1000);
      }
       var counter_date = jQuery("#evetns-last-date").attr('value');
       countDownTimer(counter_date);
      // advance-training-academy count down END

});


jQuery(function() {

  jQuery("#business_skills .progress").each(function() {

    var value = jQuery(this).attr('data-value');
    var left = jQuery(this).find('.progress-left .progress-bar');
    var right = jQuery(this).find('.progress-right .progress-bar');

    if (value > 0) {
      if (value <= 50) {
        right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
      } else {
        right.css('transform', 'rotate(180deg)')
        left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
      }
    }

  })

  function percentageToDegrees(percentage) {

    return percentage / 100 * 360

  }

});


// personalized Counter
jQuery.fn.isInViewport = function() {

    if (!jQuery(this).offset()) {
      return;
    }

    let elementTop = jQuery(this).offset().top;
    let elementBottom = elementTop + jQuery(this).outerHeight();

    let viewportTop = jQuery(window).scrollTop();
    let viewportBottom = viewportTop + jQuery(window).height();

    return elementBottom > viewportTop && elementTop < viewportBottom;
  };
  var a = 0;
  jQuery(window).scroll(function() {
    if ( jQuery('#Personalized-support').isInViewport() && a == 0 ) {
      jQuery('.counter-value').each(function() {
        jQuery(this).prop('Counter', 0).animate({
          Counter: jQuery(this).text()
        }, {
          duration:8000,
          easing: 'swing',
          step: function(now) {
            jQuery(this).text(Math.ceil(now));
          }
        });
      });
      a = 1;
    }
  });

  var b = 0;
  jQuery(window).scroll(function() {
    if ( jQuery('#success-rate').isInViewport() && b == 0 ) {
      jQuery('.progress-value').each(function() {
        jQuery(this).prop('Progress', 0).animate({
          Progress: jQuery(this).text()
        }, {
          duration:8000,
          easing: 'swing',
          step: function(now) {
            jQuery(this).text(Math.ceil(now));
          }
        });
      });
      b= 1;
    }
  });

// video popup
jQuery(".vpop").on('click', function(e) {
  e.preventDefault();
  jQuery("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();

  jQuery("#video-popup-iframe").attr('src', srchref+id+autoplay);

  jQuery("#video-popup-iframe").on('load', function() {
    jQuery("#video-popup-container").show();
  });
});

jQuery("#video-popup-close, #video-popup-overlay").on('click', function(e) {
  jQuery("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
  jQuery("#video-popup-iframe").attr('src', '');
});
