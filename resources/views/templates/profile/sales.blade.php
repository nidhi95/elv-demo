<div role="tabpanel" class="tab-pane tab-pane-space-around fade" id="sales">
    <div class="tab-v5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-left" role="tablist">
            <li role="presentation" class="<% vm.sub_tab=='invoice' ? 'active' : ''%>">
                <a href="#tab-v5-1"
                   ng-class="(vm.show_loading || vm.sub_tab == 'invoice') ? 'disabled' : ''"
                   ng-click="vm.tabChangeClickFn(null, 'invoice');vm.tabChangeFn()"
                   aria-controls="tab-v5-1"
                   role="tab"
                   data-toggle="tab">
                    Invoice
                </a>
            </li>
            <li role="presentation" class="<% vm.sub_tab=='product' ? 'active' : ''%>">
                <a href="#tab-v5-2"
                   ng-class="(vm.show_loading || vm.sub_tab == 'product') ? 'disabled' : ''"
                   ng-click="vm.tabChangeClickFn(null, 'product'); vm.tabChangeFn()"
                   aria-controls="tab-v5-2"
                   role="tab"
                   data-toggle="tab">
                    Product
                </a>
            </li>
            {{--  <li role="presentation">
                  <a href="#tab-v5-3" ng-click="vm.sub_tab='orders';vm.page=1;vm.tabChangeFn()"
                     aria-controls="tab-v5-3"
                     role="tab"
                     data-toggle="tab">
                      Orders
                  </a>
              </li>--}}
        </ul>
        <!-- End Nav tabs -->

        <!-- Tab panes -->
        <div class="tab-content" ng-init="vm.list_view=true;">
            <div role="tabpanel" class="tab-pane fade in active">
                <div>
                    <h2 class="font-size-22 color-base" style="text-transform: capitalize;">
                        <span ng-bind="vm.selected_sub_tab.tab"></span>
                        <span class="margin-r-10 pull-right" ng-if="vm.sub_tab=='product'">
                            <i ng-click="vm.list_view=true"
                               ng-class="vm.list_view ? 'text-primary' : ''"
                               class="glyphicon glyphicon-list"></i>
                            <i ng-click="vm.list_view=false"
                               ng-class="!vm.list_view ? 'text-primary' : ''"
                               class="glyphicon  glyphicon-th-large"></i>
                        </span>
                    </h2>
                    <div ng-if="vm.sub_tab=='invoice'">
                        <div class="row">

                            <div class="col-sm-6 no-pad">
                                <div class="border-box-account left-first">
                                    <div class="count-profile-sales">
                                        <span class="sales-tab">

                                            <div class="sub-box"
                                                 ng-bind="vm.count.diamondPcs ? (vm.count.diamondPcs+' Pcs.') : '-'">{{--<% vm.count.diamond ? (vm.count.diamond+' wt.') : '-' %>--}}</div>
                                            <div class="sub-box"
                                                 ng-bind="vm.count.diamond ? (vm.count.diamond+' Cts.') : '-'">{{--<% vm.count.diamond ? (vm.count.diamond+' wt.') : '-' %>--}}</div>
                                            <div class="sub-box"><i class=" fa fa-inr"></i>
                                                <medium ng-bind="vm.count.diamondAmt || '-'"></medium>
                                                {{--<% vm.count.diamondAmt || '-' %>--}}</div>
                                        </span>
                                        Diamond
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 no-pad">
                                <div class="border-box-account center-first">
                                    <div class="count-profile-sales">
                                        <span class="sales-tab">
                                            <div class="sub-box"
                                                 ng-bind="vm.count.colorStonePcs ? (vm.count.colorStonePcs+' Pcs.') : '-'">{{--<% vm.count.colorStoneAmt || '-' %>--}}</div>
                                            <div class="sub-box"
                                                 ng-bind="vm.count.colorStone ? (vm.count.colorStone+' Cts.') : '-'"></div>
                                            <div class="sub-box">
                                                <i class="fa fa-inr"></i>
                                                <medium ng-bind="vm.count.colorStoneAmt || '-'"></medium>
                                                {{--<% vm.count.colorStoneAmt || '-' %>--}}</div>

                                        </span>
                                        Color Stone
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 no-pad">
                                <div class="border-box-account border-t-b-0 center-first">
                                    <div class="count-profile-sales">
                                        <span ng-bind="vm.count.TotalNet24kWeight + ' gm' || '-'">
                                            {{--<% vm.count.TotalNet24kWeight || '-' %>--}}
                                        </span>
                                        Metal Gold Wt. (24k)
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 no-pad">
                                <div class="border-box-account border-t-b-0 left-first">
                                    <div class="count-profile-sales">
                                        <span ng-bind="vm.count.TotalGrossWeight + ' gm' || '-'">
                                            {{--<% vm.count.TotalGrossWeight || '-' %>--}}
                                        </span>
                                        Gold Net Wt.
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 no-pad">
                                <div class="border-box-account border-t-b-0 right-first">
                                    <div class="count-profile-sales">
                                        <span>
                                            <div class="sub-box sm">
                                                <i class="fa fa-inr"></i>
                                                <medium ng-bind="vm.count.TotalMetalAmt || '-'"></medium>
                                                {{--<% vm.count.TotalMetalAmt || '-' %>--}}</div>
                                            <div class="sub-box sm"
                                                 ng-bind="vm.count.TotalNetWeight + ' gm' || '-'"> {{--<% vm.count.TotalNetWeight || '-' %>--}}</div>
                                        </span>
                                        Metal Net Wt.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 no-pad">
                                <div class="border-box-account left-first">
                                    <div class="count-profile-sales">

                                        <span class="fa fa-inr">
                                            <a class="inr-font" ng-bind="vm.count.TotalLabourAmt || '-'"></a>
                                            {{--<% vm.count.TotalLabourAmt || '-' %>--}}
                                        </span>
                                        Labour
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 no-pad">
                                <div class="border-box-account center-first">
                                    <div class="count-profile-sales">

                                        <span class="fa fa-inr">
                                            <a class="inr-font" ng-bind="vm.count.TotalOtherAmt || '-'"></a>
                                            {{--<% vm.count.TotalOtherAmt || '-' %>--}}
                                        </span>
                                        Other
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 margin-t-20">
                            @include('templates.profile.filter')

                            <div class="table-wrap-body margin-t-30" ng-if="vm.sub_tab=='invoice'">
                                <div ng-if="vm.data_list.length && vm.list_view" class="table-responsive">
                                    <!-- Table Striped -->
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            {{-- <th>Sr#</th>
                                             <th>Date</th>
                                             <th>Invoice</th>
                                             <th>Amount</th>
                                             <th>Summary</th>
                                             <th>Detail</th>
                                             <th>VAT Print</th>
                                             <th>Verified</th>--}}

                                            <th ng-repeat="h in vm.selected_sub_tab.header" ng-bind="h"></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="list in vm.data_list">
                                            <td ng-bind="$index + 1"></td>
                                            <td ng-bind="list['outwardDate'] || '-'"></td>
                                            <td>
                                                <a ng-bind="list['bill'] || '-'"
                                                   class="text-primary"
                                                   ng-click="vm.sub_tab='product';vm.page=1;vm.filter.search=list.bill;
                                               vm.tabChangeFn('tab-v5', 1)">
                                                </a>
                                            </td>
                                            <td><span class="heighlite-fnt" ng-bind="list.totalItems || '-'"></span>
                                            </td>
                                            <td>
                                                {{--Print--}}
                                                <a class="print" target="_blank" href="<% list.Summary %>">
                                                    <i class=" glyphicon glyphicon-print"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <i class="<% list.IsVerified ? 'ti-check' : 'ti-close' %>"></i>
                                            </td>
                                        </tr>
                                        {{--   <tr>
                                               <td>01</td>
                                               <td>06/06/2016</td>
                                               <td>JS775(35)</td>
                                               <td><span class="heighlite-fnt">15,155</span></td>
                                               <td>Summary</td>
                                               <td>Detail</td>
                                               <td>Print</td>
                                               <td><i class="ti-check"></i></td>
                                           </tr>--}}

                                        </tbody>
                                    </table>

                                {{--                    @include('common.loading')--}}

                                <!-- End Table Striped -->
                                </div>
                            </div>

                            <div class="table-wrap-body margin-t-30" ng-if="vm.sub_tab=='product' && vm.list_view">
                                {{-- OLD : "url": "getSalesProducts",--}}
                                <div ng-if="vm.data_list.length" class="table-responsive">
                                    <!-- Table Striped -->
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>


                                            <th ng-repeat="h in vm.selected_sub_tab.header" ng-bind="h"></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="list in vm.data_list">
                                            <td ng-bind="$index + 1"></td>
                                            <td ng-bind="list.InDate || '-'"></td>
                                            <td ng-bind="list.Bill || '-'"></td>
                                            <td ng-bind="list.Design || '-'"></td>
                                            <td ng-bind="list.Collection || '-'"></td>
                                        </tr>

                                        </tbody>
                                    </table>

                                {{--                    @include('common.loading')--}}

                                <!-- End Table Striped -->
                                </div>
                            </div>

                            {{--Jobs Grid view--}}
                            @include('templates.profile.gridProduct')
                            {{-- /Jobs Grid view--}}

                            @include('common.error')
                            {{--<pre> <% vm.data_list.length %></pre>--}}
                            <div loader id="loadingArea" ng-show="!vm.data_list.length"></div>
                            <div class="row text-center margin-t-10"
                                 ng-if="vm.data_list.length && !vm.disabled && vm.total_count != vm.data_list.length">
                                <button class="btn btn-default" ng-click="vm.getDataListFn()">
                                    <img ng-if="vm.show_loading" src="/client-assets/img/load-xs.gif"> Load more
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Tab panes -->
        {{--</div>--}}
    </div>


</div>