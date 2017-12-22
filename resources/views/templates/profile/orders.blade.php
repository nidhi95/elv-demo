<div role="tabpanel" class="tab-pane tab-pane-space-around fade" id="orders">

    <div class="tab-v5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-left" role="tablist">
            {{--  <li role="presentation" class="active">
                  <a href="#tab-v5-1" ng-click="vm.sub_tab='quotes';vm.page=1;vm.tabChangeFn()"
                     aria-controls="tab-v5-1"
                     role="tab"
                     data-toggle="tab">
                      Quotes
                  </a>
              </li>--}}
            <li role="presentation" class="active">
                <a href="#tab-v5-3"
                   ng-class="(vm.show_loading || vm.sub_tab == 'orders') ? 'disabled' : ''"
                   ng-click="vm.tabChangeClickFn(null, 'orders'); vm.tabChangeFn()"
                   aria-controls="tab-v5-3"
                   role="tab"
                   data-toggle="tab">
                    Orders
                </a>
            </li>
            <li role="presentation">
                <a href="#tab-v5-2"
                   ng-class="(vm.show_loading || vm.sub_tab == 'jobs') ? 'disabled' : ''"
                   ng-click="vm.tabChangeClickFn(null, 'jobs'); vm.tabChangeFn()"
                   aria-controls="tab-v5-2"
                   role="tab"
                   data-toggle="tab">
                    Jobs
                </a>
            </li>

        </ul>
        <!-- End Nav tabs -->

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="font-size-22 color-base" style="text-transform: capitalize;">
                            <span ng-bind="vm.selected_sub_tab.tab"></span>
                            <span class="margin-r-10 pull-right" ng-if="vm.sub_tab=='jobs'">
                                <i ng-click="vm.list_view=true"
                                   ng-class="vm.list_view ? 'text-primary' : ''"
                                   class="glyphicon glyphicon-list"></i>
                                <i ng-click="vm.list_view=false"
                                   ng-class="!vm.list_view ? 'text-primary' : ''"
                                   class="glyphicon  glyphicon-th-large"></i>
                            </span>
                        </h2>
                        @include('templates.profile.filter')

                        <div class="table-wrap-body margin-t-30">
                            <div class="table-responsive">
                                <!-- Table Striped -->
                                <table class="table table-hover" ng-if="vm.accountList.length && vm.list_view">
                                    <thead ng-if="vm.data_list.length">
                                    <tr>
                                        {{-- <th>Sr#</th>
                                         <th>Date</th>
                                         <th>SKU#</th>
                                         <th>Total Design</th>
                                         <th>Stock</th>
                                         <th>Print</th>--}}
                                        <th ng-repeat="h in vm.selected_sub_tab.header" ng-bind="h"></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{--Order List--}}
                                    <tr ng-repeat="list in vm.accountList" ng-if="vm.sub_tab=='orders'">
                                        <td ng-bind="list.SrNo || ($index + 1)"></td>
                                        <td ng-bind="(list.date ? list.date : '')">
                                            {{--<% list.Date ? list.Date : (list.date ? list.date : '') %>--}}</td>
                                        <td>
                                            {{-- Function Params:  vm.tabChangeFn(currTabCls, subTabIndex)--}}
                                            <a ng-bind="(list.SKUNO ? list.SKUNO : '-')"
                                               class="text-primary"
                                               ng-click="vm.sub_tab='jobs';vm.page=1;vm.filter.search=list.SKUNO;
                                               vm.tabChangeFn('tab-v5', 1)">
                                            </a>
                                            {{--<% list.SKU ? list.SKU : (list.SKUNO ? list.SKUNO : '-') %>--}}
                                        </td>

                                        <td ng-bind="list.orders || '-'"></td>
                                        {{--<td ng-if="list.Prom. Date"><% list.Prom. Date %></td>--}}
                                        <td ng-bind="list.status || '-'"></td>

                                        <td>
                                            <a class="print" href="<% list.Print %>" target="_blank">
                                                <i class="glyphicon glyphicon-print">
                                                    {{--<% list.Print | truncate : 15%>--}}
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                    {{-- /Order List--}}

                                    {{--Jobs list--}}
                                    <tr ng-repeat="list in vm.accountList" ng-if="vm.sub_tab=='jobs' && vm.list_view">
                                        <td ng-bind="list.SrNo || ($index + 1)"></td>
                                        <td>
                                            <span ng-bind="(list.Date ? list.Date : '')"></span>
                                        </td>

                                        <td ng-bind="(list['Prom.Date'] ? list['Prom.Date'] : '-')">
                                            {{--<% list.SKU ? list.SKU : (list.SKUNO ? list.SKUNO : '-') %>--}}
                                        </td>

                                        <td ng-bind="list.SKUNO || '-'"></td>
                                        <td ng-bind="list.JOB || '-'"></td>
                                        <td ng-bind="list.DESIGN || '-'"></td>
                                        {{--<td ng-if="list.Prom. Date"><% list.Prom. Date %></td>--}}
                                        <td ng-bind="list.Status || '-'"></td>

                                        <td>
                                            <a class="print" href="<% list.Print %>" target="_blank">
                                                <i class="glyphicon glyphicon-print">
                                                    {{--<% list.Print | truncate : 15%>--}}
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                    {{--/Jobs list--}}
                                    </tbody>
                                </table>

                                {{--Jobs Grid view--}}
                                @include('templates.profile.gridJob')
                                {{-- /Jobs Grid view--}}

                                @include('common.error')
                                <div ng-show="vm.show_loading">
                                    <b> Loading... </b>
                                    {{--                                    @include('common.loading')--}}
                                </div>
                                <!-- End Table Striped -->
                            </div>

                            <div class="row text-center margin-t-10"
                                 ng-if="vm.accountList.length && !vm.disabled && vm.total_count != vm.accountList.length">
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