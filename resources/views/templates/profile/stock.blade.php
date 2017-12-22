<div role="tabpanel" class="tab-pane tab-pane-space-around fade" id="raw_material_stock">
    <div class="tab-v5 margin-t-40">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-left" role="tablist">
            <li role="presentation" class="active">
                <a href="#metal"
                   ng-class="(vm.show_loading || vm.sub_tab == 'metal') ? 'disabled' : ''"
                   ng-click="vm.sub_tab='metal';vm.sub_of_sub_tab='all';vm.tabChangeFn()"
                   aria-controls="metal" role="tab" data-toggle="tab">
                    Metal
                </a>
            </li>
            <li role="presentation">
                <a href="#diamond"
                   ng-class="(vm.show_loading || vm.sub_tab == 'diamond') ? 'disabled' : ''"
                   ng-click="vm.sub_tab='diamond';vm.sub_of_sub_tab='all';vm.tabChangeFn()"
                   aria-controls="diamond" role="tab" data-toggle="tab">
                    Diamond
                </a>
            </li>
            <li role="presentation">
                <a href="#stone"
                   ng-class="(vm.show_loading || vm.sub_tab == 'stone') ? 'disabled' : ''"
                   ng-click="vm.sub_tab='stone';vm.sub_of_sub_tab='all';vm.tabChangeFn()"
                   aria-controls="wip" role="tab" data-toggle="tab">
                    Color Stone
                </a>
            </li>
        </ul>
        <!-- End Nav tabs -->

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="col-md-12 transaction-tab margin-b-20">

                <a href class="btn-tab btn btn-default <% (vm.sub_of_sub_tab == 'all') ? 'btn-tab-active' : '' %>"
                   ng-class="(vm.show_loading || vm.sub_of_sub_tab == 'all') ? 'disabled' : ''"
                   ng-click="vm.accountList=[];vm.page=1;vm.sub_of_sub_tab='all';vm.tabChangeFn()">
                    All
                </a>
                <a href class="btn-tab btn btn-default <% (vm.sub_of_sub_tab == 'stock') ? 'btn-tab-active' : '' %>"
                   ng-class="(vm.show_loading || vm.sub_of_sub_tab == 'stock') ? 'disabled' : ''"
                   ng-click="vm.accountList=[];vm.page=1;vm.sub_of_sub_tab='stock';vm.tabChangeFn()">
                    Stock
                </a>
                <a href class="btn-tab btn btn-default <% (vm.sub_of_sub_tab == 'wip') ? 'btn-tab-active' : '' %>"
                   ng-class="(vm.show_loading || vm.sub_of_sub_tab == 'wip') ? 'disabled' : ''"
                   ng-click="vm.accountList=[];vm.page=1;vm.sub_of_sub_tab='wip';vm.tabChangeFn()">
                    WIP
                </a>

                {{--<span class="h3 margin-r-10 margin-t-0 pull-right" ng-if="vm.sub_tab=='metal'">
                    <i ng-click="vm.list_view=true"
                       class="glyphicon glyphicon-list"></i>
                    <i ng-click="vm.list_view=false"
                       class="glyphicon  glyphicon-th-large"></i>
                </span>--}}


                {{-- <a class="t-tab <% (vm.sub_of_sub_tab=='bank' ? 'active' : '')%>"
                    ng-click="vm.accountList=[];vm.page=1;vm.tab = 'account';vm.sub_tab='transaction';vm.sub_of_sub_tab='bank';vm.tabChangeFn();"
                    aria-controls="status" role="tab" data-toggle="tab">
                     Stock
                 </a>


                 <a class="t-tab <% (vm.sub_of_sub_tab=='contra' ? 'active' : '')%>"
                    ng-click="vm.accountList=[];vm.page=1;vm.tab = 'account';vm.sub_tab='transaction';vm.sub_of_sub_tab='contra';vm.tabChangeFn();"
                    role="tab" data-toggle="tab">
                     WIP
                 </a>--}}


            </div>
            <div role="tabpanel" class="tab-pane fade in active padding-tb-10">
                <div class="row">
                    <div class="col-sm-12">
                        @include('templates.profile.filter')

                        {{-- Total Count panel--}}
                        <div class="margin-t-10 h4 text-center" ng-if="vm.total_count">
                            <span class="text-center"> Total
                                <b ng-if="vm.count.totalDiamondWeight"
                                   ng-bind="vm.count.totalDiamondWeight + ' Cts'"> </b>
                                <b ng-if="vm.count.totalStoneWeight"
                                   ng-bind="vm.count.totalStoneWeight + ' gm'"> </b>
                            </span>
                            <span class="margin-l-40">
                                <b ng-bind="vm.total_count + ' Products'"></b>
                            </span>
                        </div>
                        {{-- / Total Count panel--}}

                        <div class="table-wrap-body margin-t-20">
                            <div class="table-responsive">
                                <!-- Table Striped -->

                                <table class="table table-hover" ng-if="vm.accountList.length">
                                    <thead>
                                    <tr>
                                        <th ng-repeat="h in vm.selected_sub_tab.header"><% h %></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr ng-repeat="list in vm.accountList">
                                        <td ng-if="vm.sub_tab=='stone'" ng-bind="list.Shape || '-'"></td>
                                        <td ng-if="vm.sub_tab=='stone'"
                                            ng-bind="(list.Color || list.Quality) ? (list.Quality + ' - ' +list.Color) : '-'"></td>
                                        <td ng-if="vm.sub_tab!='metal'" ng-bind="list.Size || '-'"></td>
                                        <td ng-if="vm.sub_tab!='metal'" ng-bind="list.Pcs || '-'"></td>
                                        <td ng-if="vm.sub_tab=='metal'" ng-bind="list.Purity || '-'"></td>
                                        <td ng-if="vm.sub_tab=='metal'" ng-bind="list.Type || '-'"></td>
                                        <td ng-bind="list.weight || list.Weight || '-'"></td>
                                    </tr>

                                    </tbody>
                                </table>

                                @include('common.error')


                                        <!-- End Table Striped -->
                            </div>
                            <div loader id="loadingArea" ng-show="!vm.accountList.length"></div>
                            <div class="row text-center margin-t-10"
                                 ng-if="vm.accountList.length && !vm.disabled && vm.total_count != vm.accountList.length">
                                <button class="btn btn-default" ng-click="vm.getDataListFn()">
                                    <img ng-if="vm.show_loading" src="/client-assets/img/load-xs.gif"> Load more
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
                <!--// end row -->
            </div>


        </div>
        <!-- End Tab panes -->
    </div>
</div>