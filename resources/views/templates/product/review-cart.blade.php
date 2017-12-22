<div class="modal fade" id="cart-review" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close col-md-1 pull-right text-right" data-dismiss="modal">&times;</button>
                <h2 class="modal-title col-md-3" id="myModalLabel">

                    <span class="pull-left"> Cart Review </span>
                </h2>
            </div>
            <div id="reviewCartBodyId" class="modal-body" style="overflow: auto; padding: 0">
                <div class="promo-block-v9 full-width-container" ng-if="(vm.cartItems && vm.cartItems.length)" ng-cloak>
                    <div class="category-products">
                        <ul class="products-grid">
                            <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6"
                                ng-repeat="product in vm.cartItems">
                                <div class="item-inner">
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
                    </div>
                </div>

                <div ng-if="(!vm.cartItems || !vm.cartItems.length)" ng-cloak>
                    <div class="pd_empty">
                        <div class="cart_empty_msg">There are no items in this Cart.</div>
                        <div class="margin-t-20 text-center">
                            <a href data-dismiss="modal"
                               class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer" style="padding: 0" ng-if="(vm.cartItems && vm.cartItems.length)">
                <div class="total-count text-left col-md-5" style="top: 10px">
                    <span> Total Gold Weight: <b><% vm.cartDetai.totalGoldWeight | number: 2 %></b> </span> &nbsp;
                    <span> Total Diamond Weight: <b><% vm.cartDetai.totalDiamondWeight | number: 2 %></b> </span>
                </div>
                <div class="col-sm-4 pull-right">
                    <a class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag"
                       ng-click="vm.submitCartFn()" ng-class="{ 'lessPadding' : vm.cartItems && vm.cartItems.length}">
                        Add to cart
                        <span ng-if="vm.cartItems && vm.cartItems.length" style="font-size: 18px">
                            (<% vm.cartItems.length %>) </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>