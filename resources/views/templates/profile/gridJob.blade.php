<style type="text/css">
    .products-grid .item .item-inner .item-img {
        height: 200px;
    }
</style>
<div class="category-products clearfix" ng-if="vm.sub_tab == 'jobs' && !vm.list_view">
    <ul class="products-grid">
        <li class="item col-lg-3 col-md-4 col-sm-4 col-xs-6"
            ng-repeat="list in vm.accountList">
            <div class="item-inner" style="height: 100%">

                <div class="item-img">

                    <div class="item-img-info" style="height: 100%">
                        <a class="product-image" style="height: 100%">
                            <img img-cache style="height: 100% !important; width: 100%"
                                 ic-src="<% list.Image_path || list.ImagePath || '../client-assets/img/product-detail.png' %>">
                        </a>
                    </div>
                </div>
                <div class="item-info">
                    <div class="info-inner" ng-if="list.SKUNO">

                        <div class="item-content">
                            <div class="item-price">
                                <div class="price-box">
                                    <span class="regular-price">
                                        <span class="regular-price">
                                            <span class="price left">
                                                <span ng-bind="list.DESIGN"></span>
                                            </span>
                                            <span class="price right">
                                                <span ng-bind="list.SKUNO"></span>
                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-inner" ng-if="list.category">
                        <div class="item-title">
                            <a href title="Retis lapen casen">
                                <span ng-bind="list.designno"></span>
                            </a>
                        </div>
                        <div class="item-content">
                            <div class="item-price">
                                <div class="price-box">
                                    <span class="regular-price">
                                        <span class="price left">
                                            <span
                                                    ng-bind="list.category"></span>
                                        </span>
                                        <span class="price right">
                                            GWT: <span
                                                    ng-bind="list.Grossweight"></span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="item-price">
                                <div class="price-box">
                                    <span class="regular-price">
                                        <span class="price left">
                                            MWT:
                                            <span
                                                    ng-bind="list.MetalWeight"></span>
                                        </span>
                                        <span class="price right">
                                            DWT: <span
                                                    ng-bind="list.totaldiamondweight"></span>
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