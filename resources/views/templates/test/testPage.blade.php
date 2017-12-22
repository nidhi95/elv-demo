@extends('index')

@section('content')

    <style type="text/css">
        body {
            margin: 0;
            font-family: sans-serif;
            font-size: 16px;
        }

        h1 {
            font-size: 30px;
            margin: 10px;
        }

        .content {
            overflow: hidden;
        }

        .content.right .sidebar {
            float: right;
            margin: 10px;
            margin-left: 0;
        }

        .content.right .main {
            margin: 10px;
            margin-right: 220px;
        }

        .content.double .main {
            margin-left: 434px;
        }

        .content .sidebar {
            width: 200px;
            height: 66px;
            margin: 10px;
            margin-right: 0;
            border: 1px solid red;
            float: left;
            overflow: hidden;
            font-family: sans-serif;
        }

        .content .sidebar.alt {
            height: 133px;
        }

        .content .sidebar.tall {
            height: 400px;
        }

        .content .sidebar.medium {
            height: 300px;
        }

        .content .sidebar.flat {
            border: 0;
            height: auto;
        }

        .content .inner {
            border: 1px solid red;
            height: 66px;
            margin: 10px 0;
        }

        .content .inner.static {
            margin-top: 0;
            border: 1px solid blue;
        }

        .content .item {
            display: inline-block;
            vertical-align: top;
            width: 120px;
            border: 1px solid blue;
            font-size: 16px;
            margin: 10px;
            overflow: hidden;
        }

        .content .item.sticky {
            border: 1px solid red;
            height: 100px;
        }

        .content .inline_columns {
            font-size: 0;
        }

        .content .main {
            margin: 10px;
            margin-left: 222px;
            border: 1px solid blue;
            height: 400px;
            overflow: hidden;
        }

        .content .main.short {
            height: 133px;
        }

        .content .main.tall {
            height: 600px;
        }

        .footer {
            margin: 10px;
            text-align: center;
            font-size: 13px;
            border-top: 1px dashed #dadada;
            color: #666;
            padding-top: 10px;
            min-height: 133px;
        }

        .sub {
            color: #999;
        }

        @media all and (max-width: 500px) {
            .content .sidebar {
                width: 100px;
            }

            .content .item {
                width: 60px;
            }

            .content .main {
                margin-left: 122px;
            }

            .content.double .main {
                margin-left: 234px;
            }

            .content.right .main {
                margin-right: 120px;
            }
        }
    </style>
    <div class="header-vertical-container" style="background: #f4e7dd;">

        <div class="promo-block-v9 full-width-container">
            <h1>My Last Site</h1>
            <div class="content" data-sticky_parent>
                <div class="sidebar medium" data-sticky_column>
                    Very tall sidebar
                    <ul class="sub">
                        <li>backorder</li>
                        <li>lozenge</li>
                        <li>shipper</li>
                        <li>roach</li>
                        <li>range</li>
                        <li>parke</li>
                        <li>reliever</li>
                        <li>incorrectness</li>
                        <li>schemed</li>
                        <li>philosophically</li>
                        <li>chopped</li>
                        <li>loggerhead</li>
                        <li>hosts</li>
                    </ul>
                </div>

                <div class="main tall" data-sticky_column>
                    This is the main column
                    <p class="sub">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tempus id
                        leo et aliquam. Proin consectetur ligula vel neque cursus laoreet. Nullam
                        dignissim, augue at consectetur pellentesque, metus ipsum interdum
                        sapien, quis ornare quam enim vel ipsum.
                    </p>
                    <p class="sub">
                        In congue nunc vitae magna
                        tempor ultrices. Cras ultricies posuere elit. Nullam ultrices purus ante,
                        at mattis leo placerat ac. Nunc faucibus ligula nec lorem sodales
                        venenatis. Curabitur nec est condimentum, blandit tellus nec, semper
                        arcu. Nullam in porta ipsum, non consectetur mi. Sed pharetra sapien
                        nisl. Aliquam ac lectus sed elit vehicula scelerisque ut vel sem. Ut ut
                        semper nisl.
                        </span>
                    </p>
                    <p class="sub">
                        Curabitur rhoncus, arcu at placerat volutpat, felis elit sollicitudin ante, sed
                        tempus justo nibh sed massa. Integer vestibulum non ante ornare eleifend. In
                        vel mollis dolor. Curabitur sed est felis. Nam luctus dapibus leo, vitae porta
                        erat feugiat id. Nullam nulla diam, laoreet a nisl nec, porta sodales quam.
                        Aenean in sem vitae neque aliquam commodo vitae sit amet sem. Ut commodo
                        imperdiet lorem non lacinia. Suspendisse fringilla mi enim, at imperdiet sem
                        tincidunt et. Vivamus sit amet aliquam leo. Nullam cursus ante sed urna
                        bibendum blandit. Quisque fringilla metus et nisi vehicula, et ultricies ante
                        ultrices.
                    </p>
                </div>
            </div>
            <div class="footer">
                My very tall footer!
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript">
    // Generated by CoffeeScript 1.9.2
    (function () {
        var reset_scroll;

        $(function () {
            return $("[data-sticky_column]").stick_in_parent({
                parent: "[data-sticky_parent]"
            });
        });

        reset_scroll = function () {
            var scroller;
            scroller = $("body,html");
            scroller.stop(true);
            if ($(window).scrollTop() !== 0) {
                scroller.animate({
                    scrollTop: 0
                }, "fast");
            }
            return scroller;
        };

        window.scroll_it = function () {
            var max;
            max = $(document).height() - $(window).height();
            return reset_scroll().animate({
                scrollTop: max
            }, max * 3).delay(100).animate({
                scrollTop: 0
            }, max * 3);
        };

        window.scroll_it_wobble = function () {
            var max, third;
            max = $(document).height() - $(window).height();
            third = Math.floor(max / 3);
            return reset_scroll().animate({
                scrollTop: third * 2
            }, max * 3).delay(100).animate({
                scrollTop: third
            }, max * 3).delay(100).animate({
                scrollTop: max
            }, max * 3).delay(100).animate({
                scrollTop: 0
            }, max * 3);
        };

        $(window).on("resize", (function (_this) {
            return function (e) {
                return $(document.body).trigger("sticky_kit:recalc");
            };
        })(this));

    }).call(this);
</script>

<script type="text/javascript">
    scroll_it = scroll_it_wobble
</script>
