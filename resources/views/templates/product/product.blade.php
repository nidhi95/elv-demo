@extends('index')

@section('content')

    <style type="text/css">

        .lessPadding {
            padding: 5px 25px !important;
        }

    </style>

    <div ng-controller="ProductListCtrl as vm">
        <div class="header-vertical-container main tall" data-sticky_column style="background: #f4e7dd;">

            <div class="promo-block-v9 full-width-container">
                <div class="row">
                    {{-- <div class="col-md-12">
                         <% vm.imgUrl %>
                         <img img-cache ic-src="<% vm.imgUrl %>"/>
                     </div>--}}

                    <div class="col-md-12">

                        {{--Product listing--}}
                        <div ng-if="vm.products && vm.products.length" ng-cloak>
                            <div class="tab-v2 text-center m-t-70">
                                {{--  <ul class="nav nav-tabs" role="tablist">
                                      <li role="presentation" class="active">
                                          <a href="#latest" aria-controls="latest" role="tab" data-toggle="tab"
                                             ng-click="vm.isnewarrival = 'yes'; vm.refreshFn(); vm.queryStringToReqFn()">
                                              Latest
                                          </a>
                                      </li>
                                      <li role="presentation">
                                          <a href="#oldest" aria-controls="oldest" role="tab" data-toggle="tab"
                                             ng-click="vm.isnewarrival = 'no'; vm.refreshFn(); vm.queryStringToReqFn()">
                                              Oldest
                                          </a>
                                      </li>
                                      <li role="presentation">
                                          <a href="#theme" aria-controls="theme" role="tab" data-toggle="tab"
                                             ng-click="vm.isnewarrival = null; vm.refreshFn(); vm.queryStringToReqFn()">
                                              Theme
                                          </a>
                                      </li>
                                  </ul>--}}
                                <div class="tab-content">

                                    <div role="tabpanel" class="tab-pane tab-pane-space-around fade in active"
                                         id="latest">

                                        <div class="date-sticy" id="fix-date">
                                            {{--<span class="left">Oct 2016</span>--}}
                                            <span class="left margin-t-10"> Count: <% vm.totalCount%>

                                            </span>
                                            <span class="right">
                                                <button class="btn btn-default"
                                                        style="padding:7px 25px !important;"
                                                        ng-click=" vm.searchByStockFn()">
                                                    Search By Stock
                                                </button>
                                            </span>
                                            <span class="right" ng-if="vm.searchByStockResultData"
                                                  style="margin: 0.5% 2%">
                                                Search By Stock Products
                                            </span>

                                            <div class="clearfix"></div>
                                        </div>
                                        {{--tagged-infinite-scroll="vm.getMore()"
                                        tagged-infinite-scroll-disabled="vm.fetching || vm.disabled"
                                        tagged-infinite-scroll-distance="100"--}}
                                        <div class="category-products">
                                            <ul class="products-grid" tagged-infinite-scroll="vm.getMore()"
                                                tagged-infinite-scroll-disabled="vm.fetching || vm.disabled"
                                                tagged-infinite-scroll-distance="50">

                                                <li class="item col-lg-3 col-md-4 col-sm-4 col-xs-6"
                                                    ng-repeat="product in vm.products">

                                                    {{--
                                                    change by : Tejaswi Tandel
                                                    for simple product list --}}

                                                    <div class="item-inner" ng-if="!vm.is_album">
                                                        <div class="ribbon"
                                                             ng-show="product.isInCart && !product.alreadyInCart">
                                                            <span>in cart</span>
                                                        </div>
                                                        <div class="alredy_in_cart" ng-show="product.alreadyInCart">
                                                            <span>Already in cart</span>
                                                        </div>
                                                        <div class="item-img">
                                                            <div class="cart_select"
                                                                 style="cursor: pointer"
                                                                 ng-if="product.checked"
                                                                 ng-click="product.checked = !product.checked; vm.addToCartFn(product)">

                                                                <div class="icon"></div>

                                                            </div>
                                                            <div class="item-img-info">
                                                                <a ng-show="!product.isInCart"
                                                                   ng-click="product.checked = !product.checked; vm.addToCartFn(product)"
                                                                   class="product-image">
                                                                    <img img-cache
                                                                         ic-src="<% product.ThumbImagePath || '../client-assets/img/product-detail.png' %>">
                                                                </a>
                                                                <a ng-show="product.isInCart"
                                                                   ng-click="vm.alreadyInCartFn($index)"
                                                                   class="product-image">
                                                                    <img img-cache
                                                                         ic-src="<% product.ThumbImagePath || '../client-assets/img/product-detail.png' %>">
                                                                </a>

                                                                <div class="box-hover">
                                                                    <ul class="add-to-links">
                                                                        <li>
                                                                            <a data-toggle="modal"
                                                                               data-target="#product-detail"
                                                                               ng-click="vm.productDetailFn(product.designno,$event)"
                                                                               class="link-compare">Quick View</a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="link-wishlist"
                                                                               ng-class="{'in_wishlist' : product.isInWishlist}"
                                                                               ng-click="vm.addToWishlistFn(product.designno)">
                                                                                <span ng-if="product.isInWishlist">
                                                                                    In </span> Wishlist
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title">
                                                                    <a href title="Retis lapen casen">
                                                                        <span ng-bind="product.designno"></span>
                                                                    </a>
                                                                </div>
                                                                <div class="item-content">
                                                                    <div class="item-price">
                                                                        <div class="price-box">
                                                                            <span class="regular-price">
                                                                                <span class="price left">
                                                                                    <span
                                                                                            ng-bind="product.category"></span>
                                                                                </span>
                                                                                <span class="price right">
                                                                                    Pcs: <span
                                                                                            ng-bind="product.diamondpcs"></span>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-price">
                                                                        <div class="price-box">
                                                                            <span class="regular-price">
                                                                                <span class="price left">
                                                                                    GWT:
                                                                                    <span
                                                                                            ng-bind="product.MetalWeight"></span>
                                                                                </span>
                                                                                <span class="price right">
                                                                                    DWT: <span
                                                                                            ng-bind="product.diamondweight"></span>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{--<div class="text-box">
                                                            <input type="text" maxlength="3" value="1">
                                                        </div>--}}
                                                    </div>

                                                    {{--for album product list
                                                    which is comes from dashboard page of album explore button
                                                    --}}
                                                    <div class="item-inner" ng-if="vm.is_album">
                                                        <div class="ribbon"
                                                             ng-show="product.isInCart && !product.alreadyInCart">
                                                            <span>in cart</span>
                                                        </div>
                                                        <div class="alredy_in_cart" ng-show="product.alreadyInCart">
                                                            <span>Already in cart</span>
                                                        </div>
                                                        <div class="item-img">
                                                            <div class="cart_select"
                                                                 style="cursor: pointer"
                                                                 ng-if="product.checked"
                                                                 ng-click="product.checked = !product.checked; vm.productDetailFn(product.designno,$event,true);">

                                                                <div class="icon"></div>

                                                            </div>
                                                            <div class="item-img-info">
                                                                <a ng-show="!product.isInCart"
                                                                   ng-click="product.checked = !product.checked;vm.productDetailFn(product.designno,$event,true);"
                                                                   class="product-image">
                                                                    <img img-cache
                                                                         ic-src="<% product.ThumbImagePath || '../client-assets/img/product-detail.png' %>">
                                                                </a>
                                                                <a ng-show="product.isInCart"
                                                                   ng-click="vm.alreadyInCartFn($index)"
                                                                   class="product-image">
                                                                    <img img-cache
                                                                         ic-src="<% product.ThumbImagePath || '../client-assets/img/product-detail.png' %>">
                                                                </a>

                                                                <div class="box-hover">
                                                                    <ul class="add-to-links">
                                                                        <li>
                                                                            <a data-toggle="modal"
                                                                               data-target="#product-detail"
                                                                               ng-click="vm.productDetailFn(product.designno,$event)"
                                                                               class="link-compare">Quick View</a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="link-wishlist"
                                                                               ng-class="{'in_wishlist' : product.isInWishlist}"
                                                                               ng-click="vm.addToWishlistFn(product.designno)">
                                                                                <span ng-if="product.isInWishlist">
                                                                                    In </span> Wishlist
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title">
                                                                    <a href title="Retis lapen casen">
                                                                        <span ng-bind="product.designno"></span>
                                                                    </a>
                                                                </div>
                                                                <div class="item-content">
                                                                    <div class="item-price">
                                                                        <div class="price-box">
                                                                            <span class="regular-price">
                                                                                <span class="price left">
                                                                                    <span
                                                                                            ng-bind="product.category"></span>
                                                                                </span>
                                                                                <span class="price right">
                                                                                    Pcs: <span
                                                                                            ng-bind="product.diamondpcs"></span>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-price">
                                                                        <div class="price-box">
                                                                            <span class="regular-price">
                                                                                <span class="price left">
                                                                                    GWT:
                                                                                    <span
                                                                                            ng-bind="product.MetalWeight"></span>
                                                                                </span>
                                                                                <span class="price right">
                                                                                    DWT: <span
                                                                                            ng-bind="product.diamondweight"></span>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{--<div class="text-box">
                                                            <input type="text" maxlength="3" value="1">
                                                        </div>--}}
                                                    </div>
                                                </li>


                                                <div class="clearfix"></div>
                                            </ul>
                                            {{-- <div class="expand">
                                                 <a class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md">
                                                     Expand All
                                                 </a>
                                             </div>--}}
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- /Product listing--}}

                        {{--Loading area--}}
                        <div loader id="loadingArea"></div>

                        {{--No data found--}}
                        <div ng-if="(!vm.products || !vm.products.length) && !vm.fetching && vm.noData" ng-cloak>
                            <div class="no-reselt-found">
                                <img src="/client-assets/img/error-no-search-results.png" alt="">

                                <h3>Sorry, no results found!</h3>

                                {{--<p>Please check the spelling or try searching for something else</p>--}}

                                <button class="btn btn-lg btn-md btn-sm btn-default" ng-click="vm.clearFilterFn()">
                                    View All Products
                                </button>
                            </div>
                        </div>
                        {{-- /No data found--}}

                    </div>
                </div>
            </div>


            <div class="bootom-fix" ng-class="(vm.cartItems.length && vm.products.length) ? 'showBlock' : 'hideBlock'"
                 style="z-index: 9999 !important; padding-left: 0" ng-cloak>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3 text-center">
                            {{--<a class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag"
                               ng-click="vm.removeFromCart()">
                                Remove
                            </a>--}}
                            <a class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag"
                               data-toggle="modal"
                               data-target="#cart-review"
                               ng-class="{ 'lessPadding' : vm.cartItems && vm.cartItems.length}"
                               ng-click="vm.cartReviewFn()">
                                Review
                                <span ng-if="vm.cartItems && vm.cartItems.length" style="font-size: 18px">
                                    (<% vm.cartItems.length %>) </span>
                            </a>
                        </div>
                        <div class="col-sm-5 text-center">
                            <div class="total-count">
                                {{--<span ng-bind="'GWT : ' + vm.cartDetai.totalGoldWeight | number: 2"></span>
                                <span ng-bind="'DWT : ' + vm.cartDetai.totalDiamondWeight | number: 2"></span>--}}

                                <span> Total Gold Weight: <b><% vm.cartDetai.totalGoldWeight | number: 2 %></b> </span>
                                <span> Total Diamond Weight: <b><% vm.cartDetai.totalDiamondWeight | number: 2 %></b>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-4 text-center">
                            <a class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag"
                               ng-click="vm.submitCartFn()">
                                Add to cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('templates.product.product-detail-error-popup')
        @include('templates.product.searchByStock')
        {{--Detail view modal--}}
        @include('templates.product.product-detail-popup')
        {{-- /Detail view modal--}}


        {{--Detail view modal--}}
        @include('templates.product.review-cart')
        {{-- /Detail view modal--}}

        {{--ng-show="vm.cartItems.length"--}}

    </div>

@endsection