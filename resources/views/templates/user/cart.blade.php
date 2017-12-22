@extends('index')

@section('content')
    <script src="/client-assets/modules/cart.js"></script>
    <style>
        .diss {
            pointer-events: none;
            background-color: white;
            color: black;
        }

        .btn.btn-sm.btn-dark-bg-slide.btn-slide.btn-slide-right.btn-base-sm.move-to-bag {
            min-width: 90px;
        }

        .countBox {
            background: #ffffff;
            padding: 10px 0px;
            color: #333 !important;
            box-shadow: 3px -1px 5px -2px rgba(0, 0, 0, 0.3);
        }

        .section_loader {
            height: auto;
        }

        .section_loader:before {
            position: absolute;
            width: 80%;
            left: 20%;
        }
    </style>
    <div ng-controller="CartCtrl as vm">
        <div class="header-vertical-container">
            <div class="content" style="padding-bottom: 0 !important;">
                <div class="fd-bordered-container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1>Cart</h1>
                        </div>
                    </div>
                </div>
            </div>
            {{--loader id="loadingArea"--}}
            <div class="content">
                <div ng-if="vm.cart && vm.cart.length" ng-cloak>
                    <div class="top-left-shadow"></div>
                    <div class="bottom-right-shadow"></div>

                    <div class="fd-sub-head">
                        <div class="row">
                            <div class="col-sm-2" ng-if="vm.cart.length">
                                <div class="check_input_box">
                                    <input type="checkbox"
                                           ng-model="vm.check_all"
                                           ng-change="vm.checkAllFn(vm.check_all)"
                                           id="select_all" value="price1" class="chk price-chk"
                                           style="display: block;" data-min-price="0" data-max-price="10000">

                                    <div class="check_input chk  " style="display: inline-block;"></div>
                                </div>
                                <label for="select_all" class="fr-label">Select All</label>
                            </div>
                            <div class="col-sm-3">
                                <p>You have <% vm.cart.length %> items in cart</p>
                            </div>
                            <div class="col-sm-7 text-right" ng-if="vm.cart.length">


                                <button ng-click="showModal=!showModal;" class="btn-link btn-cross">
                                    Remove all items
                                </button>
                                <confirm-delete
                                        message="Are you sure want to delete all item ?"
                                        uib-data-toggle="tooltip"
                                        uib-tooltip="Delete"
                                        visible="showModal"
                                        confirm-delete-fn="vm.removeItemFn()"
                                        cancel-delete-fn="">
                                </confirm-delete>
                            </div>
                        </div>

                    </div>

                    <div class="fd-wishlist-product" ng-repeat="c in vm.cart" ng-if="vm.cart.length">
                        <div class="row">
                            <div class="col-sm-12">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="text-center">
                                            <div class="check_input_box">
                                                <input type="checkbox"
                                                       ng-model="c.checked"
                                                       ng-change="vm.checkFn(c.checked)"
                                                       id="price1" value="price1" class="chk price-chk"
                                                       style="display: block;" data-min-price="0"
                                                       data-max-price="10000">

                                                <div class="check_input chk  " style="display: inline-block;"></div>
                                            </div>

                                        </td>
                                        <td class="col-xs-2 text-center quantity-padding-0">
                                            <img src="<% c.ThumbImagePath %>" alt="">
                                        </td>
                                        <td class="col-xs-6">
                                            <div class="fd-product-info">
                                                <span class="title">
                                                    <strong><% c.designno %></strong>
                                                </span>
                                                <span class="color">
                                                    <strong><% c.mastermanagement_metaltypename %></strong>
                                                    <strong><% c.mastermanagement_metalcolorname %></strong>
                                                    <strong><% c.mastermanagement_metalpurityname %></strong>
                                                </span>
                                                <span class="color">
                                                    Diamond : <strong><% c.diamondquality %> Quality with <%
                                                        c.diamondcolorname
                                                        %> Color</strong>
                                                </span>
                                                <span class="color">
                                                    Gross Weight : <strong><% c.Grossweight %></strong> (Approx)
                                                </span>
                                                {{--<pre> <% c | json %></pre>--}}
                                                <a class="fd-wishlist-btnLink remove"
                                                   ng-click="vm.instructionPopupFn(c.designno, c.remark)">
                                                    Add Special Instructions
                                                </a>
                                                {{--<a style="margin: 0px 10px;" class="devider">|</a>--}}
                                                {{--<a class="fd-wishlist-btnLink remove ">
                                                    Add Voice note
                                                </a>--}}
                                            </div>
                                        </td>
                                        <td class="col-xs-2 text-center">
                                            <div class="quantity">
                                                <input type="button" class="minus"
                                                       ng-click="c.qty=c.qty-1;vm.updateCartFn({qty : c.qty,designno:c.designno});"
                                                       value="-">
                                                <input type="text" class="input-text qty text"
                                                       ng-change="vm.updateCartFn({qty : (c.qty*1),designno:c.designno});"
                                                       title="Qty" ng-model="c.qty"
                                                       name="quantity">
                                                <input type="button" class="plus"
                                                       ng-click="c.qty=c.qty+1;vm.updateCartFn({qty : c.qty,designno:c.designno});"
                                                       value="+">
                                            </div>
                                        </td>
                                        <td class="col-xs-2 text-center">
                                            <a class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag"
                                               {{--ng-click="vm.removeItemFn(c.designno)"--}}
                                               ng-click="showModal=!showModal;">
                                                Remove From cart
                                            </a>
                                            {{--  <a data-toggle="tooltip"
                                                 ng-click="showModal=!showModal;"
                                                 class="text-danger small-btn">
                                                  <i class="text-danger  fa fa-trash-o"></i>
                                              </a>--}}
                                            <confirm-delete
                                                    message="Are you sure want to delete this item ?"
                                                    description="<% c.designno %>" uib-data-toggle="tooltip"
                                                    uib-tooltip="Delete"
                                                    visible="showModal"
                                                    confirm-delete-fn="vm.removeItemFn(c.designno)"
                                                    cancel-delete-fn="">
                                            </confirm-delete>

                                            <a ng-if="!c.IsInWishlist"
                                               ng-click="vm.addToWishlistFn(c.designno)"
                                               class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag">
                                                <img ng-if="vm.wishlistLoading" src="/client-assets/img/load-xs.gif"> Add to wishlist
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{--@include('common.loading')--}}
                    @include('common.error')

                    <div class="row" style="padding-right: 15px">
                        <div class="col-sm-12 margin-t-50 text-right">
                            <a class="fd-wishlist-btnLink remove"
                               ng-click="vm.instructionPopupFn('all', vm.cartRemark)">
                                Add Special Instructions
                            </a>

                            <div id="o-wrapper" style="display: inline-block;">
                                <a id="c-button--slide-right"
                                   ng-click="vm.customizeOpenFn()"
                                   class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag <% !vm.is_customize ? 'diss' : '' %>"
                                   href="javascript:void(0);">
                                    customize Products
                                </a>
                            </div>
                            <a href="/checkout"
                               class="<% !vm.cart.length ? 'diss' : '' %> btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag">
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>

                    <div class="row" ng-if="vm.cart.length" ng-cloak>
                        <div class="col-md-12 countBox">
                            <div class="col-sm-1 text-center">
                            </div>
                            <div class="col-sm-10 text-center">
                                <div class="total-count">
                                    <span> Total Net Weight: <b><% vm.cartDetai.TotalNetWeight | number: 2 %></b>
                                    </span>&nbsp;
                                    <span> Total Diamond Weight: <b><% vm.cartDetai.TotalDiamondWeight | number: 2
                                            %></b>
                                    </span>&nbsp;
                                    <span> Total Gross Weight: <b><% vm.cartDetai.TotalGrossWeight | number: 2
                                            %></b>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div ng-if="(!vm.cart || !vm.cart.length) && vm.no_data" ng-cloak>
                    <div class="pd_empty">
                        <div class="cart_empty_msg">There are no items in this Cart.</div>
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
        @include('templates.user.customize')

        <div class="modal fade" id="instructions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Add Special Instructions</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Instructions:</label>
                                <textarea class="form-control" rows="5" id="message-text"
                                          ng-model="vm.specialInstructionRemark"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag"
                           ng-click="vm.addSpecialInstructionFn(vm.specialInstructionRemark)">
                            <img ng-if="vm.subLoading" src="/client-assets/img/load-xs.gif"> ADD
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

