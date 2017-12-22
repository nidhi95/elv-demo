@extends('index')

@section('content')
    <script src="/client-assets/modules/dashboard.js"></script>

    <div class="header-vertical-container" ng-controller="DashboardCtrl as vm" loader id="loadingArea">


        <div class="bloack_spacing">
            {{-- <div class=" owl-carousel owl-theme">



             </div>--}}

            {{--<div class="owl-carousel">
                <div class="item"><img src="/client-assets/img/01-log.jpg" alt="The Last of us"></div>
                <div class="item"><img src="/client-assets/img/02-log.jpg" alt="GTA V"></div>
                <div class="item"><img src="/client-assets/img/03-log.jpg" alt="Mirror Edge"></div>
            </div>--}}


            <div class="bloack_spacing" ng-if="vm.orders.length">
                <div class="col-sm-12">
                    <div class="dashboard_title">
                        <h2>Recent Order</h2>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="recent-order-main">
                        <div class="dashborad_recent_order" ng-repeat="order in vm.orders">
                            <div class="top-left-shadow-dashboard"></div>
                            <div class="bottom-right-shadow-dashboard"></div>
                            <div class="count-profile">
                                <a href="<% order.Detail %>" target="_blank"
                                   class="text-info" ng-bind="order.bill"></a>
                                <span>Bill No.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            {{--<div class="bloack_spacing">
                <div>
                    <div class="dashboard_title">
                        <h2>Collection</h2>
                    </div>
                </div>
            </div>
            <div>
                @include('templates.collection-icons')
                <div class="clearfix"></div>
            </div>--}}

            <div class="bloack_spacing" ng-if="vm.new_arrivals.length">
                <div class="col-sm-12">
                    <div class="dashboard_title">
                        <h2>new arrival</h2>

                        <a href="/product#?newarrivalid=all"
                           class="pull-right text-info"
                           style="margin-top: -6%">
                            Explore All>>
                        </a>
                    </div>
                </div>
                <div class="col-sm-12">
                    <ul class="products-grid">
                        <!-- ngRepeat: product in vm.products -->
                        <li class="item col-lg-3 col-md-4 col-sm-4 col-xs-12" ng-repeat="n in vm.new_arrivals">
                            <div class="item-inner">
                                <div class="item-img">
                                    <div class="item-img-info">
                                        <a class="product-image">
                                            <img src="<% n.ThumbImagePath %>">
                                        </a>

                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                <li>
                                                    <a data-toggle="modal" data-target="#product-detail"
                                                       ng-click="vm.productDetailFn(n.designno)"
                                                       class="link-compare">Quick View</a>
                                                </li>
                                                {{--<li>
                                                    <a class="link-wishlist"
                                                       ng-class="{'text-danger' : n.isInWishlist}"
                                                       ng-click="vm.addToWishlistFn(n.designno)">
                                                        Wishlist
                                                    </a>
                                                </li>--}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-info">
                                    <div class="info-inner">
                                        <div class="item-title">
                                            <a href="">
                                                <span ng-bind="n.designno"></span>
                                            </a>
                                        </div>
                                        <div class="item-content">
                                            <div class="item-price">
                                                <div class="price-box">
                                                    <span class="regular-price">
                                                        <span class="price left">
                                                            GWT: <span ng-bind="n.MetalWeight"></span>
                                                        </span>
                                                        <span class="price right">
                                                            DWT: <span ng-bind="n.diamondweight"></span>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <div class="clearfix"></div>
                    </ul>

                    <a href="/product#?newarrivalid=all" class="pull-right text-info"
                       ng-if="vm.new_arrivals.length > 4">
                        Explore All>>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>

            <div ng-if="vm.newArrivalCategoryGroup">
                <div class="bloack_spacing" ng-repeat="album in vm.newArrivalCategoryGroup">
                    <div class="col-sm-12">
                        <div class="dashboard_title">
                            <h2 ng-bind="album.Album"></h2>

                            <a href="/product#?album=<% album.Album %>"
                               class="pull-right text-info "
                               style="margin-top: -6%">
                                Explore All>>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <ul class="products-grid">
                            <!-- ngRepeat: product in vm.products -->
                            <li class="item col-lg-3 col-md-4 col-sm-4 col-xs-12"
                                ng-repeat="n in album.designs | limitTo: 8">
                                <div class="item-inner">
                                    <div class="item-img">
                                        <div class="item-img-info">
                                            <a class="product-image">
                                                <img src="<% n.ThumbImagePath %>">
                                            </a>

                                            <div class="box-hover">
                                                <ul class="add-to-links">
                                                    <li>
                                                        <a {{-- data-toggle="modal" data-target="#product-detail"--}}
                                                           ng-click="vm.productDetailFn(n.designno,'is_album')"
                                                           class="link-compare">Quick View</a>
                                                    </li>
                                                    {{--<li>
                                                        <a class="link-wishlist"
                                                           ng-class="{'text-danger' : n.isInWishlist}"
                                                           ng-click="vm.addToWishlistFn(n.designno)">
                                                            Wishlist
                                                        </a>
                                                    </li>--}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-info">
                                        <div class="info-inner">
                                            <div class="item-title">
                                                <a href="">
                                                    <span ng-bind="n.designno"></span>
                                                </a>
                                            </div>
                                            <div class="item-content">
                                                <div class="item-price">
                                                    <div class="price-box">
                                                        <span class="regular-price">
                                                            <span class="price left">
                                                                GWT: <span ng-bind="n.MetalWeight"></span>
                                                            </span>
                                                            <span class="price right">
                                                                DWT: <span ng-bind="n.totaldiamondweight"></span>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <div class="clearfix"></div>
                        </ul>

                        <a href="/product#?newarrivalid=all" class="pull-right text-info"
                           ng-if="vm.new_arrivals.length > 4">
                            Explore All>>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="bloack_spacing" ng-if="vm.recent_products.length">
                <div class="col-sm-12">
                    <div class="dashboard_title">
                        <h2>Recently View</h2>
                    </div>
                </div>
                <div class="col-sm-12">
                    <ul class="products-grid">
                        <!-- ngRepeat: product in vm.products -->
                        <li class="item col-lg-3 col-md-4 col-sm-4 col-xs-12" ng-repeat="p in vm.recent_products"
                            ng-if="$index < 4">
                            <div class="item-inner">
                                <div class="item-img">
                                    <div class="item-img-info">
                                        <a class="product-image">
                                            <img src="<% p.thumbImages && p.thumbImages[0] ? p.thumbImages[0]['imageUrl'] : '' %>">
                                        </a>

                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                <li>
                                                    <a data-toggle="modal" data-target="#product-detail"
                                                       ng-click="vm.productDetailFn(p.designno)"
                                                       class="link-compare">Quick View</a>
                                                </li>
                                                <li>
                                                    <a class="link-wishlist"
                                                       ng-class="{'text-danger' : p.isInWishlist}"
                                                       ng-click="vm.addToWishlistFn(p.designno)">
                                                        Wishlist
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-info">
                                    <div class="info-inner">
                                        <div class="item-title">
                                            <a href="">
                                                <span ng-bind="p.designno"></span>
                                            </a>
                                        </div>
                                        <div class="item-content">
                                            <div class="item-price">
                                                <div class="price-box">
                                                    <span class="regular-price">
                                                        <span class="price left">
                                                            GWT: <span
                                                                    ng-bind="p.metalDetails['metal wt'] | number: 2"></span>
                                                        </span>
                                                        <span class="price right">
                                                            DWT: <span
                                                                    ng-bind="p.diamondDetails['carats'] | number: 2"></span>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <div class="clearfix"></div>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>

            @include('templates.product.product-detail-popup')
            @include('templates.product.product-detail-error-popup')
        </div>

    </div>


@endsection