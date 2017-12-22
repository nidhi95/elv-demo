<style>
    .img_wrp {
        display: inline-block;
        position: relative;
    }

    .banner-close {
        position: absolute;
        top: 0;
        right: 0;
    }
</style>

@extends('index')

@section('content')
    {{--<div class="site_launch">

    </div>--}}
    <div class="header-vertical-container">

        {{--Slider block--}}
        <div class="slide-home-full">
            <div id="home-one-image-slide" class="owl-carousel owl-theme home-one-slide">
                @if(isset($collections) && count($collections))
                    @foreach($collections as $collection_banner)
                        @if(isset($collection_banner) && $collection_banner != null && isset($collection_banner['isBanner']) && $collection_banner['isBanner'])
                            <div class="item">
                                <div class="explore-btn-in-slider-main button2">
                                    <a href="/collection-detail/{{$collection_banner['slug']}}"
                                       style="transform-origin: center center 0px; transform: none; opacity: 1;">
                                        <span class="state3"
                                              style="transform-origin: center bottom 0px; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, -0.00166, 0, 0, 0, 1);">
                                            <b>Explore</b>
                                        </span>
                                        <span class="state4"
                                              style="transform-origin: center top 0px; transform: matrix3d(1, 0, 0, 0, 0, 0, -1, 0.00166, 0, 1, 0, 0, 0, 0, 0, 1);visibility:hidden;">
                                            <b>Explore</b>
                                        </span>
                                    </a>
                                </div>
                                <img alt="{{$collection_banner['title']}}"
                                     src="{{isset($collection_banner['bannerImage']) ? (ELVEE_ADMIN_URL.$collection_banner['bannerImage']) : ''}}">
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="item">
                        <div class="explore-btn-in-slider-main button2">
                            <a href="/collection-detail/encircle"
                               style="transform-origin: center center 0px; transform: none; opacity: 1;">
                                <span class="state3"
                                      style="transform-origin: center bottom 0px; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, -0.00166, 0, 0, 0, 1);">
                                    <b>Explore</b>
                                </span>
                                <span class="state4"
                                      style="transform-origin: center top 0px; transform: matrix3d(1, 0, 0, 0, 0, 0, -1, 0.00166, 0, 1, 0, 0, 0, 0, 0, 1);visibility:hidden;">
                                    <b>Explore</b>
                                </span>
                            </a>
                        </div>
                        <img src="/client-assets/img/slider/Encircle.jpg">
                    </div>
                    <div class="item">
                        <div class="explore-btn-in-slider-main button2">
                            <a href="/collection-detail/lattice"
                               style="transform-origin: center center 0px; transform: none; opacity: 1;">
                                <span class="state3"
                                      style="transform-origin: center bottom 0px; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, -0.00166, 0, 0, 0, 1);">
                                    <b>Explore</b>
                                </span>
                                <span class="state4"
                                      style="transform-origin: center top 0px; transform: matrix3d(1, 0, 0, 0, 0, 0, -1, 0.00166, 0, 1, 0, 0, 0, 0, 0, 1);visibility:hidden;">
                                    <b>Explore</b>
                                </span>
                            </a>
                        </div>
                        <img src="/client-assets/img/slider/Lattice.jpg">
                    </div>
                    <div class="item">
                        <div class="explore-btn-in-slider-main button2">
                            <a href="/collection-detail/limelight"
                               style="transform-origin: center center 0px; transform: none; opacity: 1;">
                                <span class="state3"
                                      style="transform-origin: center bottom 0px; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, -0.00166, 0, 0, 0, 1);">
                                    <b>Explore</b>
                                </span>
                                <span class="state4"
                                      style="transform-origin: center top 0px; transform: matrix3d(1, 0, 0, 0, 0, 0, -1, 0.00166, 0, 1, 0, 0, 0, 0, 0, 1);visibility:hidden;">
                                    <b>Explore</b>
                                </span>
                            </a>
                        </div>
                        <img src="/client-assets/img/slider/Limelight.jpg">
                    </div>
                    <div class="item">
                        <div class="explore-btn-in-slider-main button2">
                            <a href="/collection-detail/stella"
                               style="transform-origin: center center 0px; transform: none; opacity: 1;">
                                <span class="state3"
                                      style="transform-origin: center bottom 0px; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, -0.00166, 0, 0, 0, 1);">
                                    <b>Explore</b>
                                </span>
                                <span class="state4"
                                      style="transform-origin: center top 0px; transform: matrix3d(1, 0, 0, 0, 0, 0, -1, 0.00166, 0, 1, 0, 0, 0, 0, 0, 1);visibility:hidden;">
                                    <b>Explore</b>
                                </span>
                            </a>
                        </div>
                        <img src="/client-assets/img/slider/stella.jpg">
                    </div>
                    <div class="item">
                        <div class="explore-btn-in-slider-main button2">
                            <a href="/collection-detail/the-sweet-heart"
                               style="transform-origin: center center 0px; transform: none; opacity: 1;">
                                <span class="state3"
                                      style="transform-origin: center bottom 0px; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, -0.00166, 0, 0, 0, 1);">
                                    <b>Explore</b>
                                </span>
                                <span class="state4"
                                      style="transform-origin: center top 0px; transform: matrix3d(1, 0, 0, 0, 0, 0, -1, 0.00166, 0, 1, 0, 0, 0, 0, 0, 1);visibility:hidden;">
                                    <b>Explore</b>
                                </span>
                            </a>
                        </div>
                        <img src="/client-assets/img/slider/The Sweet Heart.jpg">
                    </div>
                @endif

            </div>
        </div>
        {{-- /Slider block--}}

        {{--Web modules--}}
        @if(isset($homePageModules) && count($homePageModules))

            @foreach($homePageModules as $key=>$module)
                <section class="collection">
                    <div class="row">
                        {{--Image Block--}}
                        @if ($key % 2 == 0)
                            <div class="col-sm-6">
                                <div class="collection-img">
                                    <img src="{{isset($module['mainImageWeb']) ? (ELVEE_ADMIN_URL.$module['mainImageWeb']) : ''}}">
                                </div>
                            </div>
                        @endif
                        {{-- /Image Block--}}

                        {{--Content description--}}
                        <div class="col-sm-6">
                            <div class="content-inside">
                                <h1>{{isset($module['title']) ? $module['title'] : ''}}</h1>

                                @if(isset($module['description']))
                                    <div class="desc craft-margin">
                                        <pre class="pre-desc">
                                            <p>
                                                {{$module['description']}}
                                            </p>
                                        </pre>
                                    </div>
                                @endif

                                @if(isset($module['subMenu']))
                                    <a href="web-content/{{$module['subMenu']['code']}}?module={{$module['code']}}"
                                       class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md">Explore</a>
                                @else
                                    <a href="web-content/{{$module['code']}}"
                                       class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md">Explore</a>
                                @endif
                            </div>
                        </div>
                        {{-- /Content description--}}

                        {{--Image Block--}}
                        @if ($key % 2 != 0)
                            <div class="col-sm-6">
                                <div class="collection-img">
                                    <img src="{{isset($module['mainImageWeb']) ? (ELVEE_ADMIN_URL.$module['mainImageWeb']) : ''}}">
                                </div>
                            </div>
                        @endif
                        {{-- /Image Block--}}
                    </div>
                </section>
            @endforeach
        @else
            <section class="collection">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="collection-img">
                            <img src="../client-assets/img/essence-of-beauty.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="content-inside">
                            <h1>ESSENCE OF BEAUTY</h1>

                            <div class="desc">
                                <p class="text_justify">Jewellery is the work of true artists; it involves individually
                                    sculpting and refining the adjustments to house the stones perfectly. The shaping of
                                    the
                                    invisible parts is essential to ensure that the visible parts are as beautiful and
                                    radiant as possible. This is the sign of the greatest jewellers.
                                </p>

                                <p class="text_justify">
                                    Our designers continually revisit the themes that Elvee holds. They draw inspiration
                                    from a strong historical legacy and modern themes with a wide range of styles
                                    reminiscent of the many facets.
                                </p>

                                <p class="text_justify">
                                    Each Elvee design plays on the fluidity of materials and the radiance of light,
                                    thanks
                                    to the exceptional talent of our team and gem-setters. Each Elvee design gives way
                                    to a
                                    new emotion: from diamond drops that trickle down the neck, quivering foliage that
                                    embellish and frame the face and the firework-like explosion of gems.
                                </p>
                            </div>
                            <a class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md"
                               href="/essence-of-beauty">Explore</a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="collection">
                <div class="row">

                    <div class="col-sm-6 display">
                        <div class="collection-img">
                            <img src="../client-assets/img/our-craft.jpg" alt="">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="content-inside">
                            <h1>OUR CRAFT</h1>

                            <div class="desc craft-margin">
                                <p class="text_justify">The ELVEE philosophy for craftsmanship centres on minimalism.
                                    With
                                    meticulous research and diligent persistence we have perfected the art of using the
                                    least amount of metal in our designs so that the precisely hand-picked diamonds
                                    shine to
                                    their best advantage.
                                </p>

                                <p class="text_justify">
                                    Manpower works on Elvee Jewels at each step of the diamond jewellery making process
                                    to
                                    guarantee consistently supreme quality and finishing on every part of the jewel.
                                </p>
                            </div>
                            <a href="/our-craft"
                               class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md">Explore</a>
                        </div>
                    </div>

                    <div class="col-sm-6 display2">
                        <div class="collection-img">
                            <img src="../client-assets/img/our-craft.jpg" alt="">
                        </div>
                    </div>
                </div>
            </section>
            <section class="collection">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="collection-img">
                            <img src="../client-assets/img/drive-de-elvee.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="content-inside">
                            <h1>DRIVE DE ELVEE</h1>

                            <div class="desc">
                                <p>Our products are unique in representing art, design and culture. Our key mission is
                                    to
                                    introduce the finest, upscale jewellery to customers worldwide, maintaining the
                                    essence
                                    of both traditional and innovative designs coupled with superb handcraft and quality
                                    with the latest technology. </p>
                            </div>
                            <a href="/the-company/about"
                               class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md">Explore</a>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        {{-- /Web modules--}}
    </div>

    <div id="video_popup" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <div class="responsive-video">
                        <iframe src="https://www.youtube.com/embed/-1MW-KxI1jU?rel=0&amp;controls=0&amp;showinfo=0"
                                style="width: 100%; height: 100%; border: none;" allowfullscreen></iframe>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="video_popup_one" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <div class="responsive-video">
                        <iframe src="https://www.youtube.com/embed/PZFbPRiLn14?rel=0&amp;controls=0&amp;showinfo=0"
                                style="width: 100%; height: 100%; border: none;" allowfullscreen></iframe>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{--TODO - Do not deleet--}}
    <div id="loadPopup" class="modal pageload-popup fade">

        {{--If => Only main image added from admin panel then show single image view--}}
        @if(isset($bannerImage) && $bannerImage['image'] &&
        (!isset($bannerImage['attachments']) || !count($bannerImage['attachments'])))
            <div class="modal-dialog" style="width: 60%">
                <div class="modal-content">
                    {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>--}}
                    <div class="modal-body" style="padding: 0">
                        <div class="row">
                            <div class="clearfix img_wrp">
                                @if(isset($bannerImage))
                                    <img src="{{ELVEE_ADMIN_URL . '' . $bannerImage['image']}}" class="max-width-popup"
                                         alt="">
                                @else
                                    <img src="../client-assets/img/popup_1.jpg" class="max-width-popup" alt="">
                                @endif
                                <a class="pull-right-xs close banner-close"
                                   data-dismiss="modal" aria-hidden="true">
                                    <b> X </b>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="modal-dialog modal-dialog2 training-popup">
                <div class="modal-content modal-content2">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 popup-padding">
                                @if(isset($bannerImage))
                                    <img src="{{ELVEE_ADMIN_URL . '' . $bannerImage['image']}}" class="max-width-popup"
                                         alt="">
                                @else
                                    <img src="../client-assets/img/popup_1.jpg" class="max-width-popup" alt="">
                                @endif

                            </div>
                            <div class="col-md-6 col-sm-12 popup-padding-left">
                                @if(isset($bannerImage) && isset($bannerImage['attachments']) && count($bannerImage['attachments']))
                                    <img src="{{ELVEE_ADMIN_URL . '' . $bannerImage['attachments'][0]['path']}}"
                                         class="max-width-popup" alt="">
                                @else
                                    <img src="../client-assets/img/popup_2.jpg" class="max-width-popup" alt="">
                                @endif
                                <div class="col-sm-12 fd-foot-social popup-link">
                                    <div class="fd-foot-baguetteApp1">
                                        <span>Download our application on :</span>
                                        <ul class="fd-social-list">
                                            <li>
                                                <a href="https://itunes.apple.com/in/app/elvee/id1198123795?mt=8"
                                                   target="_blank" class="sprite sprite-social-app-store"></a>
                                            </li>
                                            <li>
                                                <a href="https://play.google.com/store/apps/details?id=com.coruscate.elvee&amp;hl=it"
                                                   target="_blank" class="sprite sprite-social-android"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{--TODO - Do not deleet--}}

    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $("#loadPopup").modal('show');
            }, 500);
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#home-one-image-slide").owlCarousel({
                navigation: true, // Show next and prev buttons
                slideSpeed: 300,
                paginationSpeed: 400,
                autoPlay: false,
                items: 1,
                itemsDesktop: false,
                itemsDesktopSmall: false,
                itemsTablet: false,
                itemsMobile: false
            });

        });
    </script>
@endsection

