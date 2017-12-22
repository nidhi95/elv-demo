$(window).load(function () {

    'use strict';

    /* ==============================================
     PAGE LOADER
     ============================================== */

    $("#pageloader .spinner").delay(0).fadeOut("slow");
    $("#pageloader").delay(300).fadeOut("slow");

    /* ==============================================
     HOME PAGE IMAGE SLIDER (SUPER SLIDES)
     =============================================== */

    /* ==============================================
     TEXT ROTATOR FOR HOME TEXTS
     =============================================== */

    /*    $(".text-rotetor .rotate").textrotator({
     animation: "dissolve",
     speed: 4000,
     separator: ","
     });  */

    /* ==============================================
     NAVIGATION SECTION CHANGEABLE BACKGROUND SCRIPT
     =============================================== */

    $('body').scrollspy({
        target: '.navigation-menu',
        offset: 90
    })


    new WOW().init();

    /* ==============================================
     TOOLTIPS AND POPOVER
     =============================================== */

    //Tooltip Calling
    $('[data-toggle="tooltip"]').tooltip()
    // Popover Calling
    $('[data-toggle="popover"]').popover()

    /* ==============================================
     HEADER 3 ROWS
     =============================================== */

    $('.header-style-3').each(function () {
        var headerWidth = $(this).outerWidth();
        var innerWidth = $('.inner').outerWidth();
        $(this).next('.header_rows').css({'width': innerWidth - headerWidth - 20 + 'px'});
    });

    /* ==============================================
     NAVIGATION LABELS
     =============================================== */

    $('.label').each(function () {
        $(this).append('<span></span>')
        var labelText = $(this).data('label-text');
        var labelColor = $(this).data('label-color');
        $(this).find('span').html(labelText).addClass(labelColor);
    });

    /* ==============================================
     NAVIGATION SCROLL EFFECT
     ===============================================  */

    //Add Navigation Color
    $('.white-nav > .navigation').addClass('white-nav');
    $('.dark-nav > .navigation').addClass('dark-nav');
    $('.colored-nav > .navigation').addClass('colored-nav');

    //Clone Navigation
    $(".double-nav").clone().insertAfter("#navigation");
    //Select Second Nav
    var sMenu = $('#navigation + .double-nav');
    $(sMenu).addClass('second-nav').removeClass('first-nav');

    //Change Logo SRC For White Nav
    $('.second-nav.white-nav .logo a img').each(function () {
        var secondLogo = $(this).data('second-logo');
        $(this).attr('src', secondLogo);
    });

    //AddClass for ScrollSpy
    $('#navigation + .double-nav .nav-menu').addClass('navigation-menu');

    var pagetopHeight = $('#pagetop').outerHeight();
    var headerH = $('nav').outerHeight();
    $('#pagetop + nav').css({'margin-top': pagetopHeight + 'px'});

    //Second Nav Script
    $(window).scroll(function () {
        //Visible Second Nav Scripts
        var y = $(this).scrollTop();
        var homeH = $('body section:nth-of-type(1)').outerHeight();
        var headerH = $('nav').outerHeight();
        var z = $('body section:nth-of-type(1)').offset() ? $('body section:nth-of-type(1)').offset().top + homeH - headerH : 0;
        if (y >= z) {
            $(sMenu).css({top: '0' + 'px'})

        } else {
            $(sMenu).css({top: '-90' + 'px'})
        }
    });// End Scroll Function

    /* ==============================================
     NAVIGATION DROP DOWN MENU
     =============================================== */

    $('.nav-toggle').hover(function () {
        $(this).find('.dropdown-menu').first().stop(true, true).fadeIn(250);
    }, function () {
        $(this).find('.dropdown-menu').first().stop(true, true).fadeOut(0);
    });

    $('.nav a.scroll').on('click', function () {
        $('.dropdown-menu').fadeOut(200);
    })

    $('.dropdown-menu.pull-center').each(function () {
        var menuW = $(this).outerWidth();
        if ($(window).width() > 1000) {
            $(this).css({'left': -menuW / 2 + 40 + 'px'});
        }
    });

    /* ==============================================
     MOBILE NAV BUTTON
     =============================================== */

    $("#navigation .mobile-nav-button").on('click', function () {
        $("#navigation .nav-inner div.nav-menu").slideToggle("medium", function () {
            // Animation complete.
        });
    });

    $("#navigation + .navigation .mobile-nav-button").on('click', function () {
        $("#navigation + .navigation .nav-inner div.nav-menu").slideToggle("medium", function () {
            // Animation complete.
        });
    });

    //Close Navigation For One Pages
    $('nav ul.nav li a.scroll').on('click', function () {
        if ($(window).width() < 1000) {
            $("nav .nav-menu").slideToggle("2000")
        }
    });
    $('nav + .navigation ul.nav li a.scroll').on('click', function () {
        if ($(window).width() < 1000) {
            $("nav + .navigation .nav-menu").slideToggle("2000")
        }
    });
    /* ==============================================
     ALERT CLOSE
     =============================================== */

    $(".alert .close").on('click', function () {
        $(this).parent().animate({'opacity': '0'}, 300).slideUp(300);
        return false;
    });

    /* ==============================================
     CONTENT OPTIONS
     =============================================== */

    $(".content .video").each(function () {
        'use strict';
        // Add video button
        $(this).append("<a class='play mp-video'></a>");
        // Add background image
        $(this).append("<span class='image'></span>");
        var imageBg = $(this).data('image');
        var videoLink = $(this).data('video');
        $(this).find('a.play').attr({'href': videoLink});
        $(this).find("span.image").css({'background-image': 'url(images/' + imageBg + ')'});
    });

    /* ==============================================
     SOFT SCROLL EFFECT FOR NAVIGATION LINKS
     =============================================== */

    $('.scroll').on('click', function (event) {
        var $anchor = $(this);
        var headerH = $('#navigation, #navigation-fixed').outerHeight();

        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - headerH + "px"
        }, 1400, 'easeInOutExpo');

        event.preventDefault();
    });

    /* ==============================================
     FEATURES COLLAPSE
     =============================================== */

    $(".features-button a.f-button").on('click', function () {
        var collapse = $('.f-collapse')
        $(collapse).animate({
            opacity: "toggle",
            height: "toggle"
        }, 700);
    });

    /* ==============================================
     CHANGE BG TONE WITH HOVER
     =============================================== */

    $("#fullpage .feature-boxes").on('hover', function () {
        $(".page_bg").animate({"opacity": 0.8}, 400);
    }, function () {
        $(".page_bg").animate({"opacity": 1}, 400);
    });

    /* ==============================================
     FULL SCREEN FEATURES SCRIPTS
     =============================================== */

    // Translate to Images for FullPage Version Categories
    jQuery('.translated_image').each(function () {
        // Get Window Height
        var wHeight = $(window).height();
        // Get Image Width
        var iWidth = $(this).find('img').width();
        // Add Image Classes
        $('.translated_image[data-image-position]').each(function () {
            var $self = $(this);
            $self.find('img').addClass($self.data('image-position'));
        });
        // Make 100% height for image
        $(this).find('img').css({'height': wHeight + 'px'});
        $('.translated_image').css({'height': wHeight + 'px'});
        // Calculate left value for center class
        $('.translated_image').find('img.center').css({'left': -iWidth / 2 + 'px'});
    });

    /* ==============================================
     MOBILE BACKGROUND FOR VIDEO BACKGROUNDS
     =============================================== */

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $('.mbYTP_wrapper').addClass('mobile-bg');
        $('section , div').addClass('b-scroll');
        $('.animated').addClass('visible');
    }
    else {

        // Select to link
        $('a.ex-link').on('click', function () {
            var Exlink = this.getAttribute('href');
            var emptyLink = jQuery(this).attr("href");

            if (emptyLink === "#") {
            }
            else {

                // Fade In Page Loader
                $('#pageloader').fadeIn(700, function () {
                    document.location.href = Exlink;
                });

            }

            return false;
        });

        //ANIMATED ITEMS
        /*        $('.animated').appear(function() {
         var item = $(this);
         var animation = item.data('animation');
         if ( !item.hasClass('visible') ) {
         var animationDelay = item.data('animation-delay');
         if ( animationDelay ) {
         setTimeout(function(){
         item.addClass( animation + " visible" );
         }, animationDelay);
         } else {
         item.addClass( animation + " visible" );
         }
         }
         });*/

        //Parallax Classes
        /*$('body.parallax .parallax').parallax("50%", 0.3);
         $('body.parallax .parallax1').parallax("50%", 0.3);
         $('body.parallax .parallax2').parallax("50%", 0.3);
         $('body.parallax .parallax3').parallax("50%", 0.3);
         $('body.parallax .parallax4').parallax("50%", 0.3);
         $('body.parallax .parallax5').parallax("50%", 0.3);
         $('body.parallax .parallax6').parallax("50%", 0.3);
         $('body.parallax .parallax7').parallax("50%", 0.3);
         $('body.parallax .parallax8').parallax("50%", 0.3);
         $('body.parallax .parallax9').parallax("50%", 0.3);
         $('body.parallax .parallax10').parallax("50%", 0.3);
         $('body.parallax .parallax11').parallax("50%", 0.3);*/

    }

    /* ==============================================
     CREXIS MARGIN AND PADDING RULER
     =============================================== */

    // Calculate Margin Left
    $('[class*="ml-"]').each(function () {
        var valueRulerPointOne = $(this).attr('class').split("ml-")[1].split("")[0]
        var valueRulerPointTwo = $(this).attr('class').split("ml-")[1].split("")[1]
        $(this).css({'margin-left': valueRulerPointOne + valueRulerPointTwo + 'px'});
    });
    // Calculate Margin Top
    $('[class*="mt-"]').each(function () {
        var valueRulerPointOne = $(this).attr('class').split("mt-")[1].split("")[0]
        var valueRulerPointTwo = $(this).attr('class').split("mt-")[1].split("")[1]
        $(this).css({'margin-top': valueRulerPointOne + valueRulerPointTwo + 'px'});
    });
    // Calculate Margin Right
    $('[class*="mr-"]').each(function () {
        var valueRulerPointOne = $(this).attr('class').split("mr-")[1].split("")[0]
        var valueRulerPointTwo = $(this).attr('class').split("mr-")[1].split("")[1]
        $(this).css({'margin-right': valueRulerPointOne + valueRulerPointTwo + 'px'});
    });
    // Calculate Margin Bottom
    $('[class*="mb-"]').each(function () {
        var valueRulerPointOne = $(this).attr('class').split("mb-")[1].split("")[0]
        var valueRulerPointTwo = $(this).attr('class').split("mb-")[1].split("")[1]
        $(this).css({'margin-bottom': valueRulerPointOne + valueRulerPointTwo + 'px'});
    });
    // Calculate Padding Left
    $('[class*="pl-"]').each(function () {
        var valueRulerPointOne = $(this).attr('class').split("pl-")[1].split("")[0]
        var valueRulerPointTwo = $(this).attr('class').split("pl-")[1].split("")[1]
        $(this).css({'padding-left': valueRulerPointOne + valueRulerPointTwo + 'px'});
    });
    // Calculate Padding Top
    $('[class*="pt-"]').each(function () {
        var valueRulerPointOne = $(this).attr('class').split("pt-")[1].split("")[0]
        var valueRulerPointTwo = $(this).attr('class').split("pt-")[1].split("")[1]
        $(this).css({'padding-top': valueRulerPointOne + valueRulerPointTwo + 'px'});
    });
    // Calculate Padding Right
    $('[class*="pr-"]').each(function () {
        var valueRulerPointOne = $(this).attr('class').split("pr-")[1].split("")[0]
        var valueRulerPointTwo = $(this).attr('class').split("pr-")[1].split("")[1]
        $(this).css({'padding-right': valueRulerPointOne + valueRulerPointTwo + 'px'});
    });
    // Calculate Padding Bottom
    $('[class*="pb-"]').each(function () {
        var valueRulerPointOne = $(this).attr('class').split("pb-")[1].split("")[0]
        var valueRulerPointTwo = $(this).attr('class').split("pb-")[1].split("")[1]
        $(this).css({'padding-bottom': valueRulerPointOne + valueRulerPointTwo + 'px'});
    });

    /* ==============================================
     CHECK FOR INTERNET EXPLORER
     =============================================== */

    //Check if browser is IE or not
    if (navigator.userAgent.search("MSIE") >= 0) {
        $('br').addClass('iebr');
        var logoH = $('.logo img').outerHeight();
        $('.logo').css({"margin-top": -logoH / 2 + 'px'});
    } else {
    }

    /* ==============================================
     NAVIGATION TYPE 2 - NAV CLOSE/OPEN
     =============================================== */

    // Navigation Type 2 Scripts
    var navt = $('#navigation-type2 .nav-menu');
    $(navt).append('<span class="fa fa-bars"></span>');

    $('#navigation-type2 .nav-menu span').on('click', function () {
        $('#navigation-type2 .nav-menu ul').fadeToggle("slow");
    });
    $('#navigation-type2 .nav-menu a').on('click', function () {
        $('#navigation-type2 .nav-menu ul').fadeOut("slow");
    });

    /* ==============================================
     CALCULATE HOME INNER HEIGHT
     =============================================== */

    // Add .vertical-center Class
    $('.categories_full_screen .boxes .box .texts').addClass('vertical-center');
    $('.home-inner').addClass('vertical-center');
    // Calculate Height and Margin
    $('.vertical-center').each(function () {
        var itemH = $(this).outerHeight();
        $(this).css({"margin-top": -itemH / 2 + 'px'});
    });

// End Window Load Function
});

/* ==============================================
 COUNT FACTORS
 =============================================== */

// Count Scripts
(function ($) {
    $.fn.countTo = function (options) {
        // merge the default plugin settings with the custom options
        options = $.extend({}, $.fn.countTo.defaults, options || {});

        // how many times to update the value, and how much to increment the value on each update
        var loops = Math.ceil(options.speed / options.refreshInterval),
            increment = (options.to - options.from) / loops;

        return $(this).each(function () {
            var _this = this,
                loopCount = 0,
                value = options.from,
                interval = setInterval(updateTimer, options.refreshInterval);

            function updateTimer() {
                value += increment;
                loopCount++;
                $(_this).html(value.toFixed(options.decimals));

                if (typeof(options.onUpdate) == 'function') {
                    options.onUpdate.call(_this, value);
                }

                if (loopCount >= loops) {
                    clearInterval(interval);
                    value = options.to;

                    if (typeof(options.onComplete) == 'function') {
                        options.onComplete.call(_this, value);
                    }
                }
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 0,  // the number the element should start at
        to: 100,  // the number the element should end at
        speed: 1000,  // how long it should take to count between the target numbers
        refreshInterval: 100,  // how often the element should be updated
        decimals: 0,  // the number of decimal places to show
        onUpdate: null,  // callback method for every time the element is updated,
        onComplete: null  // callback method for when the element finishes updating
    };

    // Count Options
    /*$(".fact").appear(function(){
     dataperc = $(this).attr('data-perc'),
     //Count Factors Options
     $(this).find('.factor').delay(0).countTo({
     from: 0,
     to: dataperc,
     speed: 3000,
     refreshInterval: 50
     });
     });*/

})(jQuery);

/* ==============================================
 ANIMATED SKILL BARS
 =============================================== */

/*jQuery('.progress-bar').appear(function(){
 datavl = $(this).attr('data-value'),
 // Add Data Value to Width
 $(this).animate({ "width" : datavl + "%"}, 300);
 // Create Span
 $(this).append( "<span></span>" );
 // Add value to Span
 $(this).find("span").html( datavl + "%");
 });*/

/* ==============================================
 CATEGORIES FULL SCREEN - DATA TEXT AREAS
 =============================================== */

$('.categories_full_screen .box').each(function () {
    // Find data-text
    var itemText = $(this).find('a.read_more').data('text');
    // Add Span with data-text
    $(this).find('.texts').append('<span>' + itemText + '</span>');
});

/* ==============================================
 FEATURES WITH MOBILE SCRIPTS
 =============================================== */

jQuery('.strips').each(function () {
    dataWidth = $(this).attr('data-width'),
        dataHeight = $(this).attr('data-height'),
        // Change Width
        $(this).css({"width": dataWidth + "px"});
    // Change Height
    $(this).css({"height": dataHeight + "px"});
});

/* ==============================================
 SKROLLR SCRIPT
 =============================================== */

/*    skrollr.init({
 forceHeight: false,
 mobileCheck: function() {
 //hack - forces mobile version to be off
 return false;
 }
 });*/

/* ==============================================
 TIMELINE
 =============================================== */

// Move Timeline Line Strip
$(".timeline_line").insertAfter(".timeline_items_wrapper");
// Add Titles
$('#timeline .item').each(function () {
    var imageTitle = $(this).attr('title')
    $(this).find('.image-link').attr('title', imageTitle);
});
// ALL OPTIONS IN js/jquery.timeline.js file

/* ==============================================
 BACK TO TOP BUTTON
 =============================================== */

// hide #back-top first
$("#back-top").hide();
// fade in #back-top
$(window).scroll(function () {
    if ($(this).scrollTop() > 500) {
        $('#back-top').fadeIn();
    } else {
        $('#back-top').fadeOut();
    }
});
// Go to Top
$(".back-top").on('click', function () {
    $("html, body").animate({scrollTop: 0}, 1400, 'easeInOutExpo');
    return false;
});

/* ==============================================
 BLOG DATES FOR MOBILE
 =============================================== */

$('#blog .post').each(function () {
    var newPosition = $(this).find('.post-header');
    $(this).find('.dates').clone().insertAfter(newPosition).addClass('for-mobile');
});

