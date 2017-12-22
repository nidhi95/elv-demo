<div role="tabpanel" class="tab-pane tab-pane-space-around fade" id="status">

    <div class="tab-v5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-left" role="tablist">
            <li role="presentation" class="active">
                <a href="#tab-v5-1" ng-click="vm.sub_tab='quotes';vm.page=1;vm.tabChangeFn()"
                   aria-controls="tab-v5-1"
                   role="tab"
                   data-toggle="tab">
                    Quotes
                </a>
            </li>
            <li role="presentation">
                <a href="#tab-v5-2" ng-click="vm.sub_tab='jobs';vm.page=1;vm.tabChangeFn()" aria-controls="tab-v5-2"
                   role="tab"
                   data-toggle="tab">
                    Jobs
                </a>
            </li>
            <li role="presentation">
                <a href="#tab-v5-3" ng-click="vm.sub_tab='orders';vm.page=1;vm.tabChangeFn()"
                   aria-controls="tab-v5-3"
                   role="tab"
                   data-toggle="tab">
                    Orders
                </a>
            </li>
        </ul>
        <!-- End Nav tabs -->

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active">

                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="font-size-22 color-base" style="text-transform: capitalize;"
                            ng-bind="vm.selected_sub_tab.tab">

                        </h2>
                        @include('templates.profile.filter')

                        <div class="table-wrap-body margin-t-30">
                            <div class="table-responsive">
                                <!-- Table Striped -->
                                <table class="table table-hover" ng-if="vm.accountList.length">
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
                                    <tr ng-repeat="list in vm.accountList">
                                        <td ng-bind="list.SrNo || ($index + 1)"></td>
                                        <td ng-bind="list.Date ? list.Date : (list.date ? list.date : '')">
                                            {{--<% list.Date ? list.Date : (list.date ? list.date : '') %>--}}</td>

                                        <td ng-bind="list.SKU ? list.SKU : (list.SKUNO ? list.SKUNO : '-')">
                                            {{--<% list.SKU ? list.SKU : (list.SKUNO ? list.SKUNO : '-') %>--}}
                                        </td>
                                        <td ng-if="list.TotalDesigns" ng-bind="list.TotalDesigns || '-'"></td>
                                        <td ng-if="list.JOB" ng-bind="list.JOB || '-'"></td>
                                        <td ng-if="list.DESIGN" ng-bind="list.DESIGN || '-'"></td>
                                        <td ng-if="list.category" ng-bind="list.category || '-'"></td>
                                        <td ng-if="list.PO" ng-bind="list.PO || '-'"></td>
                                        <td ng-if="list.orders" ng-bind="list.orders || '-'"></td>
                                        {{--<td ng-if="list.Prom. Date"><% list.Prom. Date %></td>--}}
                                        <td ng-if="list.Status || list.status"
                                            ng-bind="list.Status || list.status"></td>
                                        <td ng-if="list.Stock" ng-bind="(list.Stock | truncate : 15)"></td>
                                        <td>
                                            <a class="print" href="<% list.Print %>" target="_blank">
                                                <i class="glyphicon glyphicon-print">
                                                    {{--<% list.Print | truncate : 15%>--}}
                                                </i>
                                            </a>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            {{--                                @include('common.loading')--}}
                            @include('common.error')
                                <div loader id="loadingArea"></div>
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