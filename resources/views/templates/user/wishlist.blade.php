@extends('index')

@section('content')

    <style type="text/css">

        .section_loader {
            height: auto;
        }

        .section_loader:before {
            position: absolute;
            width: 80%;
            left: 20%;
        }
    </style>

    <div class="header-vertical-container" ng-controller="WishlistController as vm">
        <div class="content" style="padding-bottom: 0 !important;">
            <div class="fd-bordered-container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>WishList</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content" loader id="loadingArea">

            <div ng-if="vm.products && vm.products.length" ng-cloak>
                <div class="top-left-shadow"></div>
                <div class="bottom-right-shadow"></div>

                <div ng-if="vm.products && vm.products.length">
                    <div class="fd-sub-head">
                        <div class="row">
                            <div class="col-sm-3">
                                <p>
                                    You have saved <span ng-bind="vm.products.length"></span> items
                                </p>
                            </div>
                            <div class="col-sm-9 text-right" ng-if="vm.products.length">

                                <a data-toggle="tooltip"
                                   uib-tooltip="Delete"
                                   ng-click="showModal = !showModal;"
                                   class="btn-link btn-cross">
                                    Remove all items
                                </a>
                                &nbsp;
                                <confirm-delete
                                        message="Are you sure you want to remove this product?"
                                        visible="showModal"
                                        confirm-delete-fn="vm.removeFromWishlistFn('all')"
                                        cancel-delete-fn="">
                                </confirm-delete>
                            </div>
                        </div>
                    </div>

                    <div class="fd-wishlist-product" ng-repeat="product in vm.products">
                        <div class="row">
                            <div class="col-sm-12">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="col-xs-3 text-center">
                                            <img ng-src="<% product.ThumbImagePath %>" alt="">
                                        </td>
                                        <td class="col-xs-5">
                                            <div class="fd-product-info">
                                                <span class="title">
                                                    <strong ng-bind="product.designno "> </strong>
                                                </span>
                                                <span class="color">
                                                    <strong ng-bind="product.mastermanagement_metaltypename"> </strong>
                                                    <strong ng-bind="product.mastermanagement_metalpurityname"> </strong>
                                                    <strong ng-bind="product.mastermanagement_metalcolorname"> </strong>
                                                </span>
                                                <span class="color">
                                                    Diamond : <strong
                                                            ng-bind="product.diamondquality + 'Quality with' + product.diamondcolorname + 'Color'"></strong>
                                                </span>
                                                <span class="color">
                                                    Gross Weight : <strong ng-bind="product.Grossweight"> </strong>
                                                    (Approx)
                                                </span>

                                                <a data-toggle="tooltip"
                                                   uib-tooltip="Delete"
                                                   ng-click="showModal = !showModal;"
                                                   class="fd-wishlist-btnLink remove">
                                                    Remove
                                                </a>
                                                &nbsp;
                                                <confirm-delete
                                                        message="Are you sure you want to remove from wishlist ?"
                                                        visible="showModal"
                                                        confirm-delete-fn="vm.removeFromWishlistFn(product.designno)"
                                                        cancel-delete-fn="">
                                                </confirm-delete>
                                            </div>
                                        </td>
                                        <td class="col-xs-4 text-center">
                                            <a class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag"
                                               ng-if="!product.IsInCart"
                                               ng-click="vm.moveToCartFn(product.designno)">
                                                Move to Cart
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-right: 15px">
                        <div class="col-sm-12 margin-t-50 text-right">

                            <a data-toggle="tooltip"
                               uib-tooltip="Delete"
                               ng-click="showModalAll = !showModalAll;"
                               class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag">
                                Clear Wishlist
                            </a>
                            &nbsp;
                            <confirm-delete
                                    message="Are you sure you want to remove all products ?"
                                    visible="showModalAll"
                                    confirm-delete-fn="vm.removeFromWishlistFn('all')"
                                    cancel-delete-fn="">
                            </confirm-delete>

                            <a class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag"
                               ng-click="vm.moveToCartFn('all')">
                                Add all item to cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div ng-if="(!vm.products || !vm.products.length) && vm.noData" ng-cloak>
                <div class="pd_empty">
                    <div class="cart_empty_msg">There are no items in this WishList.</div>
                    <div class="margin-t-20 text-center">
                        <a href="/product"
                           class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag">
                            Continue Shopping
                        </a>
                    </div>
                    {{--<div class="bloack_spacing margin-t-30">
                        <div class="col-sm-12">
                            <div class="dashboard_title">
                                <h2>Explore the Collection</h2>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            @include('templates.collection-icons')
                        </div>
                        <div class="clearfix"></div>
                    </div>--}}
                </div>
            </div>

        </div>
    </div>

    <script src="/client-assets/modules/cartWishlist.js"></script>
@endsection