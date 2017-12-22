<!DOCTYPE html>
<html ng-app="appModule" ng-controller="appController as vm">

<head>
    <?php
    if (isset($_SERVER['REQUEST_URI'])) {
        $d = strtoupper($_SERVER['REQUEST_URI']);
        $seo = substr($d, 1);
    }
    ?>
    {{--{{dd($_SERVER)}}--}}
    <base href="/"/>

    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <meta http-equiv="pragma" content="no-cache"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent"/>

    <!-- Meta -->
    <meta charset="utf-8">
    {{--<meta name="keywords"
          content="{{(isset($seo) && isset($seo['keywords'])) ? $seo['keywords'] : 'cake, wedding cake, birthday cake, donuts, flowers'}}"/>--}}
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--<title>Elvee</title>--}}
    <title>
        <?php
        if (isset($seo) && defined($seo)) {
            echo constant($seo) . ' | Elvee Jewels';
        } else {
            echo 'Elvee Jewels';
        }
        ?>
    </title>


    <meta name="description" content=""/>
    <meta name='copyright' content=''>
    <meta name='language' content='EN'>
    <meta name='subject' content="">
    <meta name='pagename' content="">
    <meta name='subtitle' content="">
    <meta name='keywords' content=''>

    <meta itemprop="name" content="">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="http://www.elvee.in/client-assets/img/logo-default.png">

    <meta name="twitter:card" content="">
    <meta name="twitter:site" content="">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:creator" content="">

    <meta name="twitter:image" content="http://www.elvee.in/client-assets/img/logo-default.png">

    <meta property="og:title" content="">
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="http://www.elvee.in"/>
    <meta property="og:image" content="http://www.elvee.in/client-assets/img/logo-default.png"/>
    <meta property="og:description" content=""/>
    <meta property="og:site_name" content="Elvee"/>
    <meta name="description" content=""/>
    <meta name="DC.title" content=""/>
    <meta name="geo.region" content="IN-GJ"/>
    <meta name="geo.placename" content="Surat"/>
    <meta name="geo.position" content="21.216272, 72.836441"/>
    <meta name="ICBM" content="21.216272, 72.836441"/>
    <meta name="author" content="Elvee">
    <meta name="robots" content="noodp"/>
    <meta name="revisit-after" content="2 days">
    <meta name="language" content="English">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700,700italic' rel='stylesheet'
          type='text/css'>
    <!-- GLOBAL MANDATORY STYLES -->
    <link href="/client-assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/client-assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="/client-assets/css/et-line.css" rel="stylesheet" type="text/css"/>
    <link href="/client-assets/css/themify.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME PLUGINS STYLE -->
    <link href="/client-assets/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>
    <link href="/client-assets/css/animate.css" rel="stylesheet" type="text/css"/>
    {{--<link href="/client-assets/css/magnific-popup.css" rel="stylesheet" type="text/css"/>--}}
    <link href="/client-assets/css/owl.carousel.css" rel="stylesheet" type="text/css"/>
    <link href="/client-assets/css/cubeportfolio.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME PLUGINS STYLE -->

    <!-- THEME STYLES -->
    <link href="/client-assets/css/global.css" rel="stylesheet" type="text/css"/>
    <link href="/client-assets/css/component.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="../app/common/js/bower_components/AngularJs-Toaster/toaster.css">

    <style>
        .pre-desc {
            /*white-space: -moz-pre-wrap;
            white-space: -pre-wrap;
            white-space: -o-pre-wrap;
            white-space: pre-wrap;*/
            white-space: -moz-pre-line;
            white-space: -pre-line;
            white-space: -o-pre-line;
            white-space: pre-line;
            word-wrap: break-word;
            word-break: break-word;
            background-color: transparent;
            border: none;
            font-family: 'ProximaNova-Light' !important;
            padding: 0;
            margin: auto;
        }
    </style>

    <script type="text/javascript" src="/client-assets/js/modernizr-custom.js"></script>
    {{--<script type="text/javascript" src="/client-assets/js/jquery.min.js"></script>--}}

    {{--<script type="text/javascript" src="/client-assets/js/jquery-scrolltofixed-min.js"></script>--}}

    {{--<script type="text/javascript" src="/client-assets/js/sticky-kit.js"></script>--}}

    <script type="text/javascript" src="/client-assets/js/jquery-2.1.3.min.js"></script>

    <script type="text/javascript" src="/client-assets/js/plugins.js"></script>

    <script src="/app/common/js/bower_components/angular/angular.js"></script>
    <script src="/app/common/js/bower_components/angular-animate/angular-animate.min.js"></script>
    <script src="/app/common/js/bower_components/underscore/underscore-min.js"></script>

    <script src="/app/common/js/bower_components/angular-sanitize/angular-sanitize.js"></script>
    <script src="/app/common/js/bower_components/AngularJS-Toaster/toaster.js"></script>
    <article id="pageloader" class="white-loader">
        <div class="spinner">
            <img src="/client-assets/img/logo-default.png" alt="logo"/>
        </div>
    </article>

    <script>
        document.getElementById("uploadBtn").onchange = function () {
            document.getElementById("uploadFile").value = this.value;
        };
    </script>
    <link rel="stylesheet" href="/app/common/js/bower_components/font-awesome/css/font-awesome.min.css"
          type="text/css"/>
    <link rel="stylesheet" href="/app/common/js/bower_components/simple-line-icons/css/simple-line-icons.css"
          type="text/css"/>
    <link rel="stylesheet" href="/app/common/js/bower_components/select2/select2.css" type="text/css"/>
    <link rel="stylesheet" href="/app/common/js/bower_components/angular-ui-select/dist/select.css" type="text/css"/>
    {{--<script type="text/javascript" src="/client-assets/js/example.js"></script>--}}
    <script src="/app/common/js/bower_components/moment/min/moment.min.js"></script>

    <script src="/client-assets/modules/app.js"></script>
    <script src="/client-assets/modules/directives.js"></script>
    <script src="/client-assets/modules/commonServices.js"></script>

    <script src="/client-assets/modules/authentication.js"></script>
    <script src="/client-assets/modules/product.js"></script>
</head>
<body class="scroll-assist" data-spy="scroll" data-target=".scrollspy">
<toaster-container toaster-options="{'position-class': 'toast-bottom-left', 'close-button':false}"></toaster-container>

<div ng-show="flashMsgShow && flashMessage" ng-cloak>
    <div class="<% flashMessageClass %>">
        <i class="flaticon-<% flashMessageClass %>"></i>
        <p>
            <span ng-bind="flashMessage"></span>
            <a href class="close" ng-click="flashMsgShow = false">&times;</a>
        </p>
    </div>
</div>
<div id="page">
    @include('common.header')
    @yield('content')
    @include('common.footer')
</div>
<!-- ADDTHIS -->
{{-- /Right click disabled--}}
<script type="text/javascript" src="/client-assets/js/menu-slide.js"></script>
<script>
    var slideRight = new Menu({
        wrapper: '#o-wrapper',
        type: 'slide-right',
        menuOpenerClass: '.c-button',
        maskId: '#c-mask'
    });
    var slideRightBtn = document.querySelector('#c-button--slide-right');
    slideRightBtn.addEventListener('click', function (e) {
        e.preventDefault;
        slideRight.open();
    });
</script>

{{--@include('common.auth')--}}
<a href="javascript:void(0);" class="js-back-to-top back-to-top-theme"></a>
<script type="text/javascript" src="/client-assets/js/jquery.migrate.min.js"></script>
<script type="text/javascript" src="/client-assets/js/bootstrap.min.js"></script>
<!-- END CORE PLUGINS -->
<!-- PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="/client-assets/js/jquery.back-to-top.js"></script>
<script type="text/javascript" src="/client-assets/js/jquery.smooth-scroll.js"></script>
<script type="text/javascript" src="/client-assets/js/jquery.animsition.min.js"></script>
<script type="text/javascript" src="/client-assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="/client-assets/js/jquery.wow.min.js"></script>
<script type="text/javascript" src="/client-assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="/client-assets/js/jquery-scrolltofixed.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="/client-assets/js/app.js"></script>
<script type="text/javascript" src="/client-assets/js/animsition.js"></script>
<script type="text/javascript" src="/client-assets/js/scrollbar.js"></script>

<script type="text/javascript" src="/client-assets/js/header-vertical-dropdown-toggle.js"></script>
<script type="text/javascript" src="/client-assets/js/wow.js"></script>
<script type="text/javascript" src="/client-assets/js/owl-carousel.js"></script>
<script type="text/javascript" src="/client-assets/js/classie.js"></script>
<script type="text/javascript" src="/client-assets/js/menu.js"></script>
<script type="text/javascript" src="/client-assets/js/jquery.smartWizard.min.js"></script>
<script type="text/javascript" src="/client-assets/js/bootstrap-select.min.js"></script>

<script src="/app/common/js/bower_components/tagged-infinite-scroll/taggedInfiniteScroll.js"></script>

<script type='text/javascript' src="/app/common/plugin/angularjs-crypto/rollups-aes.js"></script>
<script type='text/javascript' src="/app/common/plugin/angularjs-crypto/mode-ecb.js"></script>
{{--Encryption - Decryption -- END --}}

{{--Local storage -- BEGIN--}}
<script src="/app/common/js/bower_components/angular-local-storage/dist/angular-local-storage.min.js"></script>
{{--Local storage -- END --}}

{{--Image cache--}}
<script src="/app/common/js/bower_components/imgcache.js/js/imgcache.js"></script>
<script src="/app/common/js/bower_components/angular-imgcache/angular-imgcache.js"></script>
{{-- /Image cache--}}

<script src="/app/common/js/bower_components/tagged-infinite-scroll/taggedInfiniteScroll.js"></script>
<script src="/app/common/js/bower_components/angular-ui-select/dist/select.js"></script>
<script src="/app/common/js/bower_components/select2/select2.js"></script>
<script src="/app/common/js/bower_components/angular-ui-select2/src/select2.js"></script>

<script src="/app/common/js/constants.js"></script>

<script type="text/javascript" src="/client-assets/js/custom.js"></script>
<!--========== END JAVASCRIPTS ==========-->
<script>
    $(document).ready(function () {
        setTimeout(function () {
            $(".collections-main-banner-left .banner-over-content, .collections-main-banner-right .banner-over-content, .collections-main-banner-left .banner-overly, .collections-main-banner-right .banner-overly").css('position', 'absolute');
        }, 500);
    });


</script>
<script type="text/javascript">
    $(document).ready(function () {
        var stepPosition;
        // Step show event
        $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection, stepPosition) {
            //alert("You are on step "+stepNumber+" now");
            stepPosition = stepPosition;
            $('.sw-btn-next.disabled').text('Next');
            $(".sw-btn-next").addClass('disabled');
            $(".sw-btn-next").attr('disabled', true);
            if (stepPosition === 'first') {
                $("#prev-btn").addClass('disabled');
                $(".sw-btn-next").addClass('disabled');
                $(".sw-btn-next").attr('disabled', true);
            } else if (stepPosition === 'final') {
                $('.sw-btn-next.disabled').text('Submit');
                $('.sw-btn-next').addClass('formSubmit');
                $("#next-btn").addClass('disabled');
            } else {
                $("#prev-btn").removeClass('disabled');
                $("#next-btn").removeClass('disabled');
            }
        });

        // Toolbar extra buttons
        var btnFinish = $('.sw-btn-next:last').on('click', function () {
            alert('Finish Clicked');
        });
        var btnCancel = $('<button></button>').text('Cancel')
            .addClass('btn btn-danger')
            .on('click', function () {
                $('#smartwizard').smartWizard("reset");
            });


        // Smart Wizard
        $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'default',
            keyNavigation: false,
            noForwardJumping: false,
            transitionEffect: 'fade',
            showStepURLhash: true,
            labelNext: 'Next', // label for Next button
            labelPrevious: 'Previous', // label for Previous button
            labelFinish: 'Submit',  // label for Finish button
            toolbarSettings: {
                toolbarPosition: 'both',
                toolbarExtraButtons: [btnFinish, btnCancel]
            }
        });

        // External Button Events
        $("#reset-btn").on("click", function () {
            // Reset wizard
            $('#smartwizard').smartWizard("reset");
            return true;
        });

        $("#prev-btn").on("click", function () {
            // Navigate previous
            $('#smartwizard').smartWizard("prev");
            return true;
        });

        $("#next-btn").on("click", function () {
            $('#smartwizard').smartWizard("next");
            return true;
        });

        $("#theme_selector").on("change", function () {
            $('#smartwizard').smartWizard("theme", $(this).val());
            return true;
        });
        $("#theme_selector").change();
    });
</script>

{{--Login analytics (Session Log)--}}
<script>
    var start;
    var end;

    $(document).ready(function () {

        var getLocalData = localStorage;
        start = moment();

        // Check login
        if (getLocalData['pd.token'] && getLocalData['pd.userData']) {
            var userData = JSON.parse(getLocalData['pd.userData']);

            // For session manage
            if (!getLocalData['pd.webStartTime']) {
                localStorage.setItem('pd.webStartTime', start);
            }

            $(window).unload(function () {
                end = moment();
                var sessionLogMin = (end).diff(localStorage.getItem('pd.webStartTime'), 'minute');

                // Remove time from local storage when unload
                localStorage.removeItem('pd.webStartTime');

                // Call API to store session log
                $.ajax({
                    method: "POST",
                    url: "https://api.optigoapps.com/elvee/pgzb-sxjf-rqcg-xnde/v1003/apps/loginSessions",
                    headers: {
                        'Authorization': 'Bearer ' + getLocalData['pd.token']
                    },
                    data: {
                        userid: userData.userid,
                        "data": [{
                            "date": moment().format('DD MMM YYYY'),
                            "web": sessionLogMin
                        }]
                    }
                })
                    .done(function (msg) {
                        console.log('Closed');
                    });

            });
        }
    });
</script>
{{-- /Login analytics (Session Log)--}}

</body>
</html>
