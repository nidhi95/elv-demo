/**
 * Created by alpesh.gevariya on 5/25/2017.
 */
var selectPickerInit = function () {
    var selectpicker = selectpicker || {};
    $('.fake-select').find('select').selectpicker();
    $("nav .change-lang-div select").selectpicker();

    $body.on('shown.bs.select', '.fake-select select', function (e) {
        var relatedDropdown = $('.btn-group.bootstrap-select.open').find('ul.dropdown-menu');
        //var relatedDropdown = $(e.delegateTarget).find('ul.dropdown-menu');
        var railOpacity = $(this).parents('.fake-select').hasClass('dark') ? 6 : 3;
        relatedDropdown.niceScroll({
            cursorcolor: "#858585",
            cursorwidth: "7px",
            cursorborder: "1px solid #858585",
            background: "rgba(0,0,0,0.0" + railOpacity + ")",
            railpadding: {left: 3, right: 3},
            autohidemode: false,
            hidecursordelay: 0
        });
        $(this).one('hidden.bs.select', function (e) {
            relatedDropdown.getNiceScroll().remove();
        });
    });

    if (!isIE && !isIE10_11) {

        $body.on("selectpickerRefresh", function (e, el) {
            $(el).selectpicker("refresh");
        });
    } else {
        //selectPickerInit();

        $body.on("selectpickerRefresh", function (e, el) {
            $(el).selectpicker("refresh");
            $(el).selectpicker('deselectAll');
            $(el).selectpicker("refresh");
        });
    }
};

var windw = this;

$.fn.followTo = function () {
    var $this = $('.bootom-fix'),
        $window = $(windw);

    $window.scroll(function (e) {

        setTimeout(function () {
            var footerPosition = $('#footer').position();
            var footerTop = footerPosition ? footerPosition.top : 0;

//                console.log('footerTop', footerTop);
            var pos = footerTop - $window.height();
            var scrollTop = $window.scrollTop();
//                    var scrollTop = $('.header-vertical-container').height();
//                console.log('pos', pos);
//                console.log('scrollTop', scrollTop);

            if (scrollTop > pos) {
                $this.css({
                    position: 'inherit',
                    bottom: '',
                    "padding-right": 0
                });

            } else {
                $this.css({
                    position: 'fixed',
                    bottom: 0,
                    "padding-right": "15%"
                });
            }
        }, 1);

    });
};
$('.bootom-fix').followTo();

$('.owl-carousel').owlCarousel({
    // loop: true,
    margin: 10,
    nav: false,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: false,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
});

(function () {
    var menuEl = document.getElementById('ml-menu'),
        mlmenu = new MLMenu(menuEl, {
            // breadcrumbsCtrl : true, // show breadcrumbs
            // initialBreadcrumb : 'all', // initial breadcrumb text
            backCtrl: false, // show back button
            // itemsDelayInterval : 60, // delay between each menu item sliding animation
            onItemClick: loadDummyData // callback: item that doesn´t have a submenu gets clicked - onItemClick([event], [inner HTML of the clicked item])
        });

    // mobile menu toggle
    var openMenuCtrl = document.querySelector('.action--open'),
        closeMenuCtrl = document.querySelector('.action--close');
    openMenuCtrl.addEventListener('click', openMenu);
    closeMenuCtrl.addEventListener('click', closeMenu);

    function openMenu() {
        console.log('menu--open');
        classie.add(menuEl, 'menu--open');
    }

    function closeMenu() {
        classie.remove(menuEl, 'menu--open');
    }

    var gridWrapper = document.querySelector('.content');

    function loadDummyData(ev, itemName) {
        console.log('itemName', itemName);
        ev.preventDefault();
        closeMenu();
        gridWrapper.innerHTML = '';
        classie.add(gridWrapper, 'content--loading');
        setTimeout(function () {
            classie.remove(gridWrapper, 'content--loading');
            gridWrapper.innerHTML = '<ul class="products">' + dummyData[itemName] + '<ul>';
        }, 700);
    }
})();

$('#fix-date').scrollToFixed({marginTop: 0});
$('#fix-date-oldest').scrollToFixed({marginTop: 0});
$('#fix-date-theme').scrollToFixed({marginTop: 0});

var fakePlaceholder = function (fakeElement) {
    $(fakeElement).addClass('fieldWriting');
    $(fakeElement).find('.fake-placeholder').addClass('inputEdited');
    if (!$(fakeElement).find("input").is(":focus")) {
        $(fakeElement).find("input").focus();
    }
    ;
    if (!$(fakeElement).find("textarea").is(":focus")) {
        $(fakeElement).find("textarea").focus();
    }
    ;
}
var fakePlaceholderOut = function (fakeElement) {
    $(fakeElement).removeClass('fieldWriting');
    if ((($('input', fakeElement).val()) == '') || (($('select', fakeElement).val()) == '')) {
        $('.fake-placeholder', fakeElement).removeClass('inputEdited');
    }
    ;
}
var fakePlaceholderInit = function (target) {
    var tg = target || '.fake-input input, .fake-input select';
    $(tg).each(function () {
        if ($(this).val() != '') {
            $(this).addClass('fd-visible');
            ($(this).parent().find('.fake-placeholder')).addClass('inputEdited');
        }
    });
    $('.fake-placeholder').addClass('fastTransition fadeIn');
    if (isIE9) {
        $('.fake-input * ').css({opacity: "1", visibility: "visible"})
    }
}
$(window).load(function () {
    fakePlaceholderInit();
});
$('body').on('click tap', '.fake-input', function () {
    $(this).find('input').addClass('fd-visible');
    $(this).find('select').addClass('fd-visible');
    fakePlaceholder(this);
});
$(".fd-textmessage").on('click tap', function () {
    $(this).find("textarea").focus();
});
$('.fake-input input, .fake-input select').on('focusin', function () { //focusin
    $(this).addClass('fd-visible');
    $(this).addClass('fd-visible');
    fakePlaceholder($(this).parent());
});
$('.fake-input').on('focusout', function () {
    if ($(this).find('input').val() == '' && $(this).find('select').val() == '') {
        $(this).find('input').removeClass('fd-visible');
        $(this).find('select').removeClass('fd-visible');
    }
});
$('.fake-input, .fd-textmessage').on('focusout', function () {
    fakePlaceholderOut(this);
});


$(".button2 a").hover(function () {
        $(this).find(".state3").css({transform: "matrix3d(1, 0, 0, 0, 0, 0, 1, -0.00166, 0, -1, 0, 0, 0,-32, 0, 1)"});
        $(this).find(".state4").css({
            transform: "matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, -0.00166, 0, -32, 0, 1)", "visibility": "visible"
        });
    },
    function () {
        $(this).find(".state3").css({transform: "matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, -0.00166, 0, 0, 0, 1)"});
        $(this).find(".state4").css({
            transform: "matrix3d(1, 0, 0, 0, 0, 0, -1, 0.00166, 0, 1, 0, 0, 0, 0, 0, 1)", "visibility": "hidden"
        });
    });

$(document).ready(function () {
    $('#collection').click(function () {
        window.location.replace('/collections');
    });

    $('#the-company').click(function () {
        window.location.replace('/the-company/about');
    });

    $('.menu-module-with-submenu').on("click", function () {
        var clickedBtnID = $(this).attr('id'); // or var clickedBtnID = this.id
        var liEle = $("#submenu-id-" + clickedBtnID + " li").first();
        if (liEle) {
            var redirectionLink = $("#submenu-id-" + clickedBtnID + " li a").first().attr('href');
            window.location.replace(redirectionLink);
        }
    });

});