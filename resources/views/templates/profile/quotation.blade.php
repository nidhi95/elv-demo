<style>
    td.sku:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    span.margin-r-10.pull-right i.glyphicon {

        cursor: pointer;
    }
</style>
<div role="tabpanel" class="tab-pane tab-pane-space-around fade" id="quotation">

    <div class="tab-v5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-left" role="tablist">
            <li role="presentation" class="<% vm.sub_tab=='quotes' ? 'active' : ''%>">
                <a href="#tab-v5-1" ng-click="vm.tabChangeClickFn(null, 'quotes');vm.tabChangeFn()"
                   ng-class="(vm.show_loading || vm.sub_tab == 'quotes') ? 'disabled' : ''"
                   aria-controls="tab-v5-1"
                   role="tab"
                   data-toggle="tab">
                    Quotes
                </a>
            </li>
            <li role="presentation" class="<% vm.sub_tab=='jobs' ? 'active' : ''%>">
                {{--Tab disabled => Jobs only listed when quotation SKU searched--}}
                <a href="#tab-v5-2" ng-click="vm.tabChangeClickFn(null, 'jobs');vm.tabChangeFn()"
                   class="disabled"
                   aria-controls="tab-v5-2"
                   role="tab"
                   data-toggle="tab">
                    Jobs
                </a>
            </li>
            {{--<li role="presentation">
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
                                <table class="table table-hover"
                                       ng-if="vm.accountList.length && vm.list_view">
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
                                    <tr ng-repeat="list in vm.accountList" ng-if="vm.sub_tab=='quotes'">
                                        <td ng-bind="list.SrNo || ($index + 1)"></td>
                                        <td ng-bind="list.Date ? list.Date : (list.date ? list.date : '')">
                                            {{--<% list.Date ? list.Date : (list.date ? list.date : '') %>--}}</td>

                                        {{--OLD - Click on SKU -> open job tab--}}
                                        <td ng-if="vm.sub_tab!='jobs'"
                                            class="sku">
                                            <a ng-click="vm.sub_tab='jobs';vm.page=1;vm.filter.search=list.SKU;vm.tabChangeFn()"
                                               class="text-primary"
                                               ng-bind="list.SKU ? list.SKU : '-'"></a>
                                        </td>
                                        {{-- /OLD - Click on SKU -> open job tab--}}

                                        {{--<td>
                                            <span ng-if="vm.sub_tab!='jobs'" ng-bind="list.SKU ? list.SKU : '-'"></span>
                                            <span ng-if="vm.sub_tab=='jobs'"
                                                  ng-bind="list.SKUNO ? list.SKUNO : '-'"></span>
                                        </td>--}}
                                        {{--<td ng-bind="list.SKU ? list.SKU : (list.SKUNO ? list.SKUNO : '-')">--}}
                                        {{--<% list.SKU ? list.SKU : (list.SKUNO ? list.SKUNO : '-') %>
                                        </td>--}}
                                        <td ng-if="list.TotalDesigns" ng-bind="list.TotalDesigns || '-'"></td>
                                        <td ng-if="list.JOB" ng-bind="list.JOB || '-'"></td>
                                        <td ng-if="list.DESIGN" ng-bind="list.DESIGN || '-'"></td>
                                        <td ng-if="list.category" ng-bind="list.category || '-'"></td>
                                        {{--<td ng-if="list.PO" ng-bind="list.PO || '-'"></td>--}}
                                        <td ng-if="list.orders" ng-bind="list.orders || '-'"></td>
                                        {{--<td ng-if="list.Prom. Date"><% list.Prom. Date %></td>--}}
                                        {{--  <td ng-if="list.Status || list.status"
                                              ng-bind="list.Status || list.status"></td>--}}
                                        <td ng-if="list.Stock">
                                            <a class="print" href="<% list.Stock %>" target="_blank">
                                                <i class="glyphicon glyphicon-print">
                                                    {{--<% list.Print | truncate : 15%>--}}
                                                </i>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="print" ng-if="list.Print" href="<% list.Print %>" target="_blank">
                                                <i class="glyphicon glyphicon-print">
                                                    {{--<% list.Print | truncate : 15%>--}}
                                                </i>
                                            </a>
                                        </td>
                                    </tr>

                                    {{--Jobs list--}}
                                    <tr ng-repeat="list in vm.accountList" ng-if="vm.sub_tab=='jobs' && vm.list_view">
                                        <td ng-bind="list.SrNo || ($index + 1)"></td>
                                        <td>
                                            <span ng-bind="(list.category ? list.category : '')"></span>
                                        </td>

                                        <td ng-bind="list.designno || '-'"></td>
                                        <td ng-bind="list.MetalWeight || '-'"></td>
                                        <td ng-bind="list.Grossweight || '-'"></td>
                                        <td ng-bind="list.totaldiamondweight || '-'"></td>
                                        <td ng-bind="list.totalcolorstoneweight || '-'"></td>

                                    </tr>
                                    {{--/Jobs list--}}
                                    </tbody>
                                </table>

                                {{--Jobs Grid view--}}
                                @include('templates.profile.gridJob')
                                {{-- /Jobs Grid view--}}
                                {{--                                @include('common.loading')--}}
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