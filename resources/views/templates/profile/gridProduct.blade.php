<style type="text/css">
    .products-grid .item .item-inner .item-img {
        height: 200px;
    }
</style>
<div class="category-products clearfix" ng-if="vm.sub_tab == 'product' && !vm.list_view">

    <ul class="products-grid">
        <li class="item col-lg-3 col-md-4 col-sm-4 col-xs-6"
            ng-repeat="list in vm.data_list">
            <div class="item-inner" style="height: 100%">

                <div class="item-img">

                    <div class="item-img-info" style="height: 100%">
                        <a class="product-image" style="height: 100%">
                            <img img-cache style="height: 100% !important; width: 100%"
                                 ic-src="<% list.imageThumb || '../client-assets/img/product-detail.png' %>">
                        </a>
                    </div>
                </div>
                <div class="item-info">
                    <div class="info-inner">

                        <div class="item-content">
                            <div class="item-price">
                                <div class="price-box">
                                    <span class="regular-price">
                                        <span class="regular-price">
                                            <span class="price left">
                                                <span ng-bind="list.Design"></span>
                                            </span>
                                            <span class="price right">
                                                <span ng-bind="list.Bill"></span>
                                            </span>
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

    </ul>
    {{-- <div class="expand">
         <a class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md">
             Expand All
         </a>
     </div>--}}
</div>