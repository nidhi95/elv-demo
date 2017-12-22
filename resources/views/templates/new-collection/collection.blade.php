@extends('index')

@section('content')

    <style type="text/css">
        span.state3 {
            color: #fff !important;
            background: transparent !important;
            border: 1px solid #fff !important;
        }

        span.state4 {
            color: #000 !important;
            background: #fff !important;
        }

    </style>
    {{--<script src="/client-assets/modules/collection.js"></script>--}}
    {{--ng-controller="CollectionCtrl as vm"--}}

    <div {{--ng-init="vm.collections={{isset($collection) ? json_encode($collection) : []}}"--}}>

        <div class="header-vertical-container">


            {{--angular code--}}
            {{--   <div ng-repeat="collection in vm.collections | orderBy:'sequence'"
                    class="collections-main-banner-<% $even ? 'left' : 'right' %>">
                   <div class="banner-inner">
                       <div class="banner-overly">
                           <div class="banner-over-content">
                               <div class="collection-logo-banner">
                                   <img ng-src="<%  collection.prefix_by  + collection.logo %>" class="max-width-img"
                                        alt="">
                               </div>
                               <div class="collection-logo-banner">
                                   <p ng-bind="collection.shortDescription">

                                   </p>
                               </div>
                               <div class="button2 text-center margin-t-20">
                                   <a href="/collection-detail/<% collection.slug %>"
                                      style="transform-origin: center center 0px; transform: none; opacity: 1;">
                                       <span class="state3"
                                             style="transform-origin: center bottom 0px; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, -0.00166, 0, 0, 0, 1);">
                                           <b>Explore</b>
                                       </span>
                                       <span class="state4"
                                             style="transform-origin: center top 0px; transform: matrix3d(1, 0, 0, 0, 0, 0, -1, 0.00166, 0, 1, 0, 0, 0, 0, 0, 1); visibility: hidden;">
                                           <b>Explore</b>
                                       </span>
                                   </a>
                               </div>
                           </div>
                           <img ng-src="<% $odd ? '/client-assets/img/collections/hover-overly-right.png' : '/client-assets/img/collections/hover-overly.png'%>"
                                alt="<% collection.slug %>">
                       </div>
                       <img --}}{{--src="/client-assets/img/collections/encircle/banner.jpg"--}}{{--
                            ng-src="<%collection.prefix_by + collection.headerImage %>"
                            alt="<% collection.title %>">
                   </div>
               </div>--}}
            {{--ELVEE_ADMIN_URL--}}
            @if(isset($collections) && count($collections))
                <?php
                $collect_index = 0;
                ?>
                @foreach($collections as $collect)
                    <?php
                    $collect_index++;
                    $collect['indx'] = $collect_index?>
                    <div class="collections-main-banner-{{(($collect['indx'] % 2)==1) ? 'left' :'right' }}">
                        <div class="banner-inner">
                            <div class="banner-overly">
                                <div class="banner-over-content">
                                    <div class="collection-logo-banner">
                                        <img src="{{isset($collect['logo']) ? (ELVEE_ADMIN_URL.$collect['logo']) :'/client-assets/img/collections/lattice/logo.png'}}"
                                             alt="{{$collect['title']}}"
                                             class="max-width-img">
                                    </div>
                                    <div class="collection-logo-banner">
                                        <p>
                                            {{$collect['shortDescription']}}
                                        </p>
                                    </div>
                                    <div class="button2 text-center margin-t-20">
                                        <a href="/collection-detail/{{$collect['slug']}}"
                                           style="transform-origin: center center 0px; transform: none; opacity: 1;">
                                            <span class="state3"
                                                  style="transform-origin: center bottom 0px; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, -0.00166, 0, 0, 0, 1);">
                                                <b>Explore</b>
                                            </span>
                                            <span class="state4"
                                                  style="transform-origin: center top 0px; transform: matrix3d(1, 0, 0, 0, 0, 0, -1, 0.00166, 0, 1, 0, 0, 0, 0, 0, 1); visibility: hidden;">
                                                <b>Explore</b>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <img alt="{{$collect['title']}}"
                                     src="/client-assets/img/collections/hover-overly{{(($collect['indx'] % 2)==1) ? '' :'-right' }}.png">
                            </div>
                            <img alt="{{$collect['title']}}"
                                 src="{{$collect['headerImage'] ? (ELVEE_ADMIN_URL.$collect['headerImage']) : '/client-assets/img/collections/lattice/banner.jpg'}}">
                        </div>
                    </div>
                @endforeach
            @endif
            {{--


             <div class="collections-main-banner-left">
                 <div class="banner-inner">
                     <div class="banner-overly">
                         <div class="banner-over-content">
                             <div class="collection-logo-banner">
                                 <img src="/client-assets/img/collections/lime-light/logo.png" class="max-width-img"
                                      alt="">
                             </div>
                             <div class="collection-logo-banner">
                                 <p>
                                     Stylish and trendy , the LIMELIGHT collection draws inspiration from new generation.
                                 </p>
                             </div>
                             <div class="button2 text-center margin-t-20">
                                 <a href="/collection-detail/limelight"
                                    style="transform-origin: center center 0px; transform: none; opacity: 1;">
                                     <span class="state3"
                                           style="transform-origin: center bottom 0px; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, -0.00166, 0, 0, 0, 1);">
                                         <b>Explore</b>
                                     </span>
                                     <span class="state4"
                                           style="transform-origin: center top 0px; transform: matrix3d(1, 0, 0, 0, 0, 0, -1, 0.00166, 0, 1, 0, 0, 0, 0, 0, 1); visibility: hidden;">
                                         <b>Explore</b>
                                     </span>
                                 </a>
                             </div>
                         </div>
                         <img src="/client-assets/img/collections/hover-overly.png" alt="">
                     </div>
                     <img src="/client-assets/img/collections/lime-light/banner.jpg" alt="">
                 </div>
             </div>
             <div class="collections-main-banner-right">
                 <div class="banner-inner">
                     <div class="banner-overly">
                         <div class="banner-over-content">
                             <div class="collection-logo-banner">
                                 <img src="/client-assets/img/collections/stella/logo.png" class="max-width-img" alt="">
                             </div>
                             <div class="collection-logo-banner">
                                 <p>
                                     Elvee presents the selective Stella collection - a bespoke accumulation of gems
                                     characterized by preeminent baguette craftsmanship and Glanz artfulness .
                                 </p>
                             </div>
                             <div class="button2 text-center margin-t-20">
                                 <a href="/collection-detail/stella"
                                    style="transform-origin: center center 0px; transform: none; opacity: 1;">
                                     <span class="state3"
                                           style="transform-origin: center bottom 0px; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, -0.00166, 0, 0, 0, 1);">
                                         <b>Explore</b>
                                     </span>
                                     <span class="state4"
                                           style="transform-origin: center top 0px; transform: matrix3d(1, 0, 0, 0, 0, 0, -1, 0.00166, 0, 1, 0, 0, 0, 0, 0, 1); visibility: hidden;">
                                         <b>Explore</b>
                                     </span>
                                 </a>
                             </div>
                         </div>
                         <img src="/client-assets/img/collections/hover-overly-right.png" alt="">
                     </div>
                     <img src="/client-assets/img/collections/stella/banner.jpg" alt="">
                 </div>
             </div>
             <div class="collections-main-banner-left">
                 <div class="banner-inner">
                     <div class="banner-overly">
                         <div class="banner-over-content">
                             <div class="collection-logo-banner">
                                 <img src="/client-assets/img/collections/sweet-heart/logo.png" class="max-width-img"
                                      alt="">
                             </div>
                             <div class="collection-logo-banner">
                                 <p>
                                     My heart is yours. Today and always. Our bond is pure and true. When the arrow
                                     struck,
                                     from the cupid's bow. I knew it was sent from you.
                                 </p>
                             </div>
                             <div class="button2 text-center margin-t-20">
                                 <a href="/collection-detail/the-sweet-heart"
                                    style="transform-origin: center center 0px; transform: none; opacity: 1;">
                                     <span class="state3"
                                           style="transform-origin: center bottom 0px; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, -0.00166, 0, 0, 0, 1);">
                                         <b>Explore</b>
                                     </span>
                                     <span class="state4"
                                           style="transform-origin: center top 0px; transform: matrix3d(1, 0, 0, 0, 0, 0, -1, 0.00166, 0, 1, 0, 0, 0, 0, 0, 1); visibility: hidden;">
                                         <b>Explore</b>
                                     </span>
                                 </a>
                             </div>
                         </div>
                         <img src="/client-assets/img/collections/hover-overly.png" alt="">
                     </div>
                     <img src="/client-assets/img/collections/sweet-heart/banner.jpg" alt="">
                 </div>
             </div>--}}
        </div>
    </div>
@endsection