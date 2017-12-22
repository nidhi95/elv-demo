@extends('index')

@section('content')
    <script src="/client-assets/modules/search-product.js"></script>
    <div ng-controller="SearchProductCtrl as vm">
        <div class="header-vertical-container margin-t-30" style="background: #f4e7dd;">
            <div class="promo-block-v9 full-width-container"
                 ng-if="!vm.showErr && vm.productDetail.designno"
                 id="product-content">

                <div class="top-left-shadow"></div>
                <div class="col-sm-12 product-detail-v-middle margin-l-0 margin-b-30 margin-r-0">
                    <div class="col-sm-1" ng-if="!vm.nextPrevHide">
                        <div ng-click="vm.nextPrevProductFn(vm.productDetail.designno, 'prev')"
                             class="product-left-arrow"></div>
                    </div>
                    <div ng-if="vm.productDetail.highResImages"
                         ng-class="vm.nextPrevHide ? 'col-sm-5' : 'col-sm-9'">
                        <img ng-src="<% vm.productDetail.highResImages.length ? vm.productDetail.highResImages[0].imageUrl : '' %> "
                             class="p-detail-img"
                             alt="">
                    </div>
                    <div class="col-sm-6 margin-t-80">
                        <div class="product-detail col-md-12 col-sm-12">
                            <h1 class="margin-t-0">
                                <span ng-bind="vm.productDetail.designno"></span>
                            </h1>

                            <p ng-bind="'Set in '+ vm.productDetail.metalDetails.type + ' ' +
                                         vm.productDetail.metalDetails.color + ' (' +
                                          vm.productDetail.metalDetails['metal wt'] + ' gms) with Diamonds (' +
                                          vm.productDetail.diamondDetails.carats +' Ct, ' +
                                           vm.productDetail.diamondDetails.quality + '-' +
                                           vm.productDetail.diamondDetails.color + ')'">
                            </p>

                            <div class="details margin-b-20">
                                <div class="gold-detail">
                                    <span class="gold_color yellow"></span>
                                    {{--metalDetails--}}
                                    <span class="purity">
                                        <% vm.productDetail.metalDetails ?
                                        vm.productDetail.metalDetails.type : '-' %>
                                    </span>
                                    {{-- /metalDetails--}}
                                </div>

                                {{--Diamond--}}
                                <div class="gold-detail">
                                    <span class="diamond_icon"></span>
                                    <span class="purity">
                                        <% vm.productDetail.diamondDetails ?
                                        vm.productDetail.diamondDetails.quality : '' %> -
                                        <% vm.productDetail.diamondDetails ?
                                        vm.productDetail.diamondDetails.color : '' %>
                                    </span>
                                </div>
                                {{-- /Diamond--}}

                                {{--Metal--}}
                                <div class="gold-detail">
                                    <span class="metal_icon"></span>
                                    <span class="purity">
                                        <% vm.productDetail.metalDetails ?
                                        vm.productDetail.metalDetails.color : '-' %>
                                    </span>
                                </div>
                                {{-- /Metal--}}
                            </div>
                            <div class="margin-b-20">

                                {{--Add/Remove Cart--}}
                                <a class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag"
                                   ng-if="!vm.productDetail.isInCart"
                                   ng-click="vm.submitCartFn(vm.productDetail)">
                                    Add to cart
                                </a>
                                <a class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag"
                                   ng-if="vm.productDetail.isInCart"
                                   ng-click="vm.removeFromCartWishlistFn(vm.productDetail.designno, 'cart', 'isInCart')">
                                    Remove from cart
                                </a>

                                {{-- Add/Remove Wishlist--}}
                                <a class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag"
                                   ng-if="!vm.productDetail.isInWishlist"
                                   ng-click="vm.addToWishlistFn(vm.productDetail.designno)">
                                    Add to wishlist
                                </a>
                                <a class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag"
                                   ng-if="vm.productDetail.isInWishlist"
                                   ng-click="vm.removeFromCartWishlistFn(vm.productDetail.designno, 'wishlist', 'isInWishlist')">
                                    Remove from wishlist
                                </a>
                            </div>

                            <div class="details margin-b-20">
                                <div class="gold-detail margin-b-10">
                                    <span class="certified_icon"></span>
                                    <span class="purity">Certified Jewellery</span>
                                </div>
                                <div class="gold-detail margin-b-10">
                                    <span class="on_time_icon"></span>
                                    <span class="purity">On Time Delivery</span>
                                </div>
                                <div class="gold-detail margin-b-10">
                                    <span class="cod_icon"></span>
                                    <span class="purity">Cash-on-Delivery</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-1" ng-if="!vm.nextPrevHide">
                        <div ng-click="vm.nextPrevProductFn(vm.productDetail.designno, 'next')"
                             class="product-right-arrow"></div>
                    </div>
                </div>

                <div class="row margin-l-0 margin-r-0">


                    <div class="col-sm-6">
                        <div class="product_details_container" ng-if="vm.productDetail.description">
                            <h6 class="product_heading">Product Details</h6>
                            <hr>
                            <table class="product_details" cellspacing="0">
                                <tr>
                                    <td>Item Code</td>
                                    <td> <% vm.productDetail.description['item code'] %></td>
                                </tr>
                                <tr>
                                    <td>Jewellery Type</td>
                                    <td><% vm.productDetail.description['jewellery type'] %></td>
                                </tr>
                                <tr>
                                    <td>Collection</td>
                                    <td><% vm.productDetail.description['collection'] %></td>
                                </tr>
                                <tr>
                                    <td>Category</td>
                                    <td><% vm.productDetail.description['category'] %></td>
                                </tr>
                                <tr>
                                    <td>SubCategory</td>
                                    <td><% vm.productDetail.description['sub category'] %></td>
                                </tr>
                                <tr>
                                    <td>Gross Wt</td>
                                    <td><% vm.productDetail.description['gross wt'] %> (Approx)</td>
                                </tr>
                            </table>
                            <hr>
                        </div>
                        <div class="product_details_container" ng-if="vm.productDetail.metalDetails">
                            <h6 class="product_heading">Metal Details</h6>
                            <hr>
                            <table class="product_details" cellspacing="0">
                                <tr>
                                    <td>Type</td>
                                    <td><% vm.productDetail.metalDetails.type %></td>
                                </tr>
                                <tr>
                                    <td>Color</td>
                                    <td><% vm.productDetail.metalDetails.color %></td>
                                </tr>
                                <tr>
                                    <td>Metal Wt</td>
                                    <td><% vm.productDetail.metalDetails['metal wt'] %> (Approx)</td>
                                </tr>
                            </table>
                            <hr>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="product_details_container" ng-if="vm.productDetail.diamondDetails">
                            <h6 class="product_heading">Diamond Details</h6>
                            <hr>
                            <table class="product_details" cellspacing="0">
                                <tr>
                                    <td>Shape</td>
                                    <td> <% vm.productDetail.diamondDetails.shape %></td>
                                </tr>
                                <tr>
                                    <td>Quality</td>
                                    <td> <% vm.productDetail.diamondDetails.quality %></td>
                                </tr>
                                <tr>
                                    <td>Color</td>
                                    <td> <% vm.productDetail.diamondDetails.color %></td>
                                </tr>
                                <tr>
                                    <td>Pieces</td>
                                    <td> <% vm.productDetail.diamondDetails.pieces %></td>
                                </tr>
                                <tr>
                                    <td>Carats</td>
                                    <td> <% vm.productDetail.diamondDetails.carats %> (Approx)</td>
                                </tr>
                                <tr>
                                    <td>Setting Type</td>
                                    <td> <% vm.productDetail.diamondDetails['setting type'] %></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <div class="promo-block-v9 margin-t-80 full-width-container"
                 ng-if=" vm.showErr"
                 id="product-content">
                <h3>No Data Found !!</h3>
            </div>
        </div>
    </div>
@endsection