{{--loader id="loadingArea"--}}
<div class="header-vertical scrollbar" data-spy="affix" data-offset-top="0" data-offset-bottom="216">
    <header class="bp-header cf">
        <div class="navbar-logo">
            <a class="navbar-logo-wrap" href="/dashboard">
                <img class="navbar-logo-img logo2-disply mCS_img_loaded" src="/client-assets/img/logo-default.png"
                     alt="Ark">
                <img class="navbar-logo-img logo-disply mCS_img_loaded" src="/client-assets/img/logo-default2.png"
                     alt="Ark">
            </a>
            {{--<a class="navbar-logo-wrap" href="/dashboard" ng-if="(loginUser && userId)">--}}
            {{--<img class="navbar-logo-img" src="/client-assets/img/logo-default.png">--}}
            {{--</a>--}}
        </div>
    </header>

    <button class="action action--open" aria-label="Open Menu"><span class="icon icon--menu"></span></button>
    {{--data-ng-init="vm.initFn()"--}}
    <nav id="ml-menu" class="menu scroll-style-4" ng-controller="FilterCtrl as vm">

        <div class="filter_content">
            <h5 class="col-md-12">
                FILTER
                {{--<pre> <% vm.filterParentIndex %> , <% vm.currentOpen %></pre>--}}
                <a href class="pull-right clear_all" ng-if="vm.showClearFilter"
                   ng-click="vm.clearFilterFn()"> Clear All</a>
            </h5>

            <div class="accordion-v5">
                {{--<pre> <% categoryListMaster | json %></pre>--}}
                <div class="panel-group" id="accordion-v5" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default"
                         ng-repeat="category in categoryListMaster | orderBy: 'sequence'">
                        <div class="panel-heading" role="tab" id="heading<% $index %>">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion-v5"
                                   href="#accordionV5Collapse<% $index %>" aria-expanded="true"
                                   aria-controls="accordionV5Collapse<% $index %>"
                                   ng-click="vm.filterToggleFn(category.reqKey, $index);">
                                    <span ng-bind="category.name"></span> <br>

                                    <span ng-show="vm.filter[category.reqKey] && vm.currentOpen != category.reqKey"
                                          style="font-size: 12px;" ng-bind="vm.filter[category.reqKey]">
                                        {{--<% vm.filter[category.reqKey] %> &nbsp;--}}
                                        {{--<span ng-click=""> x </span>--}}
                                    </span>
                                </a>
                            </h4>
                        </div>

                        <div id="accordionV5Collapse<% $index %>" class="panel-collapse collapse"
                             ng-class="{'in' : ($index == (vm.filterParentIndex || 0) && vm.isProductPageIndex >= 0)}"
                             role="tabpanel"
                             aria-labelledby="heading<% $index %>">

                            <div class="include_all">
                                <a ng-class="{'select' : category.exclude_all}"
                                   ng-click="vm.filterFn(category.reqKey, $index, 'exclude')">
                                    Exclude All
                                </a>
                                <a ng-class="{'select' : category.include_all}"
                                   ng-click="vm.filterFn(category.reqKey, $index, 'include_all')">
                                    Include All
                                </a>
                            </div>
                            <div class="panel-body">
                                <div class="fd-fieldcontainer filter">
                                    <div ng-repeat="subCat in category['sub-categories']">
                                        {{--<label class="checkbox" for="<% category.name %><% subCat.name %>">--}}
                                        {{--<input type="radio" name="<% category.name %><% $parent.$index %>"--}}
                                        {{--ng-model="vm.filter[category.reqKey]"--}}
                                        {{--ng-change="vm.filterFn(category.reqKey)"--}}
                                        {{--value="<% subCat.name %>"--}}
                                        {{--id="<% category.name %><% subCat.name %>">--}}
                                        {{--<% subCat.name %>--}}
                                        {{--</label>--}}

                                        <div class="check_input_box">
                                            <input type="checkbox" id="<% category.name %><% subCat.name %>"
                                                   ng-model="subCat.checked"
                                                   class="chk price-chk"
                                                   ng-change="vm.clearOtherFn(category.reqKey, $index, $parent.$index)"
                                                   style="display: block;">

                                            <div class="check_input chk" style="display: inline-block;"></div>
                                        </div>
                                        &nbsp;
                                        <label for="<% category.name %><% subCat.name %>"
                                               ng-bind="subCat.name"> </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            {{--Search by stock--}}
            <div class="panel panel-default">
                {{--DO NOT DELETE--}}
                {{--Search by stock -- (UI : New state)--}}
                {{--<div class="panel-heading" id="headingSbs">
                    <h4 class="panel-title">
                        <a class="text-primary" href="/search-by-stock" --}}{{--ng-click="vm.searchByStockFn();"--}}{{-->
                            <span> Search by stock </span>
                        </a>
                    </h4>
                </div>--}}
                {{--Result--}}
                {{--<div class="panel-heading" id="headingSbs">
                    <h4 class="panel-title">
                        <a class="text-primary" href ng-click="vm.searchByStockResFilterFn()">
                            <span> Stock result </span>
                        </a>
                    </h4>
                </div>--}}
                {{--Result--}}
                {{--/ DO NOT DELETE--}}

                {{--Search by stock -- (UI : Popup)--}}
                <div class="panel-heading" id="headingSbs">
                    <h4 class="panel-title">
                        <a class="text-primary" href
                           ng-click="vm.searchByStockRequestFn()">
                            <span> Search by stock </span>
                        </a>
                    </h4>
                </div>


            </div>
            {{-- /Search by stock--}}

        </div>
    </nav>
</div>