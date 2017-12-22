<style>
    div#serch-box {
        padding: 10px;
        position: fixed;
    }

    a.serc {
        margin: 10px;
    }
</style>
<div class="fd-header">
    <div class="fd-headerInner">
        <span class="fd-welcome-login" ng-if="loginUser.FirstName">
            <a id="login-header">
                <span ng-bind="'Hi, ' + loginUser.FirstName + ' ' + loginUser.LastName"></span>
            </a>
        </span>
        <span class="fd-welcome-login" ng-if="!loginUser.FirstName">
            {{--<a id="login-header" class="hidden-xs hidden-sm" href="/login">Log in</a>--}}
            <a id="login-header" class="hidden-xs hidden-sm" href="/login">Log in/Register</a>
            <a id="login-header"
               class="visible-sm-inline-block visible-xs-inline-block" onclick="DetectAndServe()">Log
                in</a>
        </span>
        <span class="fd-commerce-icons" ng-if="(loginUser && userId)">

            <a data-toggle="collapse" data-target="#serch-box">
                <i class="ti-search"></i>
            </a>
            <a href="/wishlist">
                <span class="cartQuantity" ng-bind="wishListCount" ng-show="wishListCount"></span>
                <i class="ti-heart"></i>
                {{--<sup>(<% cartCount %>)</sup>--}}
            </a>
            <a href="/cart">
                <span class="cartQuantity" ng-bind="cartCount" ng-show="cartCount"></span>
                <i class="ti-shopping-cart"></i>
                {{--<sup>(<% wishListCount %>)</sup>--}}
            </a>
            <a href="/profile">
                <i class="ti-user"></i>
            </a>
            <a href ng-click="logoutFn()">
                <i class="ti-power-off"></i>
            </a>
        </span>
        <form name="searchForm">
            <div id="serch-box" class="collapse">
                <ui-select style="width: 90%; display: inline-block" id="js_search_key"
                           uiselect-autofocus
                           ng-model="globalSearch"
                           ng-change="productDetailViewFn(globalSearch)"
                           name="search"
                           theme="bootstrap">
                    <!--on-select="vm.changeType(vm.user.type)"-->
                    <ui-select-match allow-clear="true"
                                     placeholder="Type what you are looking">
                        <% $select.selected %>
                    </ui-select-match>
                    {{--minimum-input-length="2" refresh-delay="100"
                            refresh="vm.refreshUsersFn($select.search)"--}}
                    <ui-select-choices
                            minimum-input-length="3"
                            refresh-delay="100"
                            refresh="globalSearchFn($select.search)"
                            repeat="searchRes in vm.searchResultlist | filter: $select.search">
                        <div ng-bind-html="searchRes | highlight: $select.search"
                             ng-class="{'searching-in-progress': searchLoading}"></div>
                    </ui-select-choices>
                </ui-select>

                {{-- <input type="text" id="js_search_key"
                        ng-model="globalSearch"
                        name="search"
                        class="fd-searchInput"
                        placeholder="Type what you are looking" autocomplete="off">--}}

                <a class="serc pull-right" data-toggle="collapse" data-target="#serch-box">
                    <i class="ti-close"></i>
                </a>
            </div>
        </form>
    </div>
</div>

{{--Header menu display -- BEGIN--}}
{{--ng-show="headerView"--}}
<div ng-show="(!loginUser || !userId)">
    @include('common.header_left_content')
</div>
{{--Header menu display -- END--}}

{{--Product Filter -- BEGIN--}}
{{--ng-show="!headerView"--}}
<div ng-show="loginUser && userId">
    @include('templates.product.filter')
</div>
{{--Product Filter -- END--}}
{{--@include('templates.product.product-detail-popup')--}}
