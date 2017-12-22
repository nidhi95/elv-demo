<style>
    .tab-content-ledger {
        min-height: auto !important;
    }
</style>
<div role="tabpanel" class="tab-pane tab-pane-space-around fade" id="account">
    <div>
        <div class="tab-v5 margin-t-40">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-left" role="tablist">
                <li role="presentation" class="active">
                    <a href="#transactions"
                       ng-click="vm.sub_tab='transaction';vm.accountList=[];vm.sub_of_sub_tab='cash';vm.page=1;vm.tabChangeFn()"
                       aria-controls="transactions" role="tab" data-toggle="tab">
                        Transactions
                    </a>
                </li>
                <li role="presentation">
                    <a href="#ledger"
                       ng-click="vm.sub_tab='ledger';vm.accountList=[];vm.page=1;vm.tabChangeFn()"
                       aria-controls="ledger" role="tab" data-toggle="tab">
                        Ledger
                    </a>
                </li>
                <li role="presentation">
                    <a href="#party_balance"
                       ng-click="vm.sub_tab='party';vm.accountList=[];vm.page=1;vm.tabChangeFn()"
                       aria-controls="party_balance" role="tab" data-toggle="tab">
                        Party Balance
                    </a>
                </li>
            </ul>
            <!-- End Nav tabs -->

            <!-- Tab panes -->
            <div class="tab-content <% (vm.sub_tab=='ledger') ? 'tab-content-ledger' : '' %>">
                <div class="col-md-12 transaction-tab margin-b-20" ng-if="vm.sub_tab=='transaction'">


                    <a href class="t-tab <% (vm.sub_of_sub_tab=='cash' ? 'active' : '') %>"
                       ng-click="vm.accountList=[];vm.page=1;vm.tab = 'account';vm.sub_tab='transaction';vm.sub_of_sub_tab='cash';vm.tabChangeFn()">
                        Cash
                    </a>


                    <a class="t-tab <% (vm.sub_of_sub_tab=='bank' ? 'active' : '')%>"
                       ng-click="vm.accountList=[];vm.page=1;vm.tab = 'account';vm.sub_tab='transaction';vm.sub_of_sub_tab='bank';vm.tabChangeFn();"
                       aria-controls="status" role="tab" data-toggle="tab">
                        Bank
                    </a>


                    <a class="t-tab <% (vm.sub_of_sub_tab=='contra' ? 'active' : '')%>"
                       ng-click="vm.accountList=[];vm.page=1;vm.tab = 'account';vm.sub_tab='transaction';vm.sub_of_sub_tab='contra';vm.tabChangeFn();"
                       role="tab" data-toggle="tab">
                        Contra
                    </a>


                </div>
                <div role="tabpanel" class="tab-pane fade in active padding-tb-10" id="transactions">
                    <div class="row">

                        <div class="col-sm-12">
                            @include('templates.profile.filter')
                            <div class="table-wrap-body margin-t-30">
                                <div class="table-responsive">
                                    <!-- Table Striped -->
                                    <table class="table table-hover" ng-if="vm.accountList.length">
                                        <thead>
                                        <tr>
                                            <th ng-repeat="h in vm.selected_sub_tab.header" ng-bind="h"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="list in vm.accountList" ng-if="vm.sub_of_sub_tab!='contra'">
                                            <td ng-bind="$index + 1"></td>
                                            <td style="white-space: nowrap" ng-bind="list.Entrydate || '-'"></td>
                                            <td>
                                                <a href="<% link.voucherpath %>"
                                                   ng-bind="list.voucherno"
                                                   target="_blank" ></a>
                                            </td>

                                            <td ng-bind="list.AccountName || '-'"></td>
                                            <td ng-if="list.BankName"
                                                style="white-space: nowrap"
                                                ng-bind="list.BankName || '-'">
                                            </td>
                                            <td ng-bind="list.transaction || '-'"></td>
                                            <td ng-bind="list.amount || '-'"></td>
                                            <td ng-bind="list.Waiver || '-'"></td>
                                            <td ng-bind="list.taxamount || '-'"></td>

                                            <td ng-bind="list.status || '-'"></td>
                                            <td ng-bind="list.Remark || '-'"></td>
                                            <td>
                                                <a class="print" href="<% link.Download %>" download>
                                                    <i class="glyphicon glyphicon-download-alt">
                                                    </i>

                                                </a>
                                            </td>
                                            <td>
                                                <a class="print" href="<% link.View %>" target="_blank">
                                                    <i class="glyphicon glyphicon-eye-open"></i>
                                                    {{--<% list.View | truncate : 10 %>--}}
                                                </a>
                                            </td>
                                            <td>
                                                <i ng-if="list.VerifiedStatus=='Verified'" class="ti-check"></i>
                                                <i ng-if="list.VerifiedStatus !='Verified'" class="ti-close"></i>
                                            </td>
                                        </tr>

                                        <tr ng-repeat="list in vm.accountList" ng-if="vm.sub_of_sub_tab=='contra'">
                                            <td ng-bind="$index + 1">
                                            </td>
                                            <td ng-bind="list.Entrydate || '-'">
                                            </td>
                                            <td ng-bind="list.vouchernov|| '-'">
                                            </td>
                                            <td ng-bind="list.DrAccountName || '-'">
                                            </td>
                                            <td ng-bind="list.DrAmount || '-'">
                                            </td>
                                            <td ng-bind="list.CrAccountName || '-'">
                                            </td>
                                            <td ng-bind="list.CrAmount || '-'">
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                {{--                                @include('common.loading')--}}
                                @include('common.error')
                                @include('common.loading')
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
                    <!--// end row -->
                </div>


                <div role="tabpanel" class="tab-pane fade in active padding-tb-10" ng-if="vm.sub_tab=='ledger'"
                     id="ledger">
                    <div class="row margin-b-30">
                        <div class="col-sm-4 no-pad">
                            <div class="border-box-account border-t-b-0 left-first">
                                <div class="count-profile-sales">
                                    <span ng-bind=" vm.count.balanceGold || '-'">
                                        {{--<% vm.count.balanceGold || '-' %>--}}
                                    </span>
                                    Balance Gold
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 no-pad">
                            <div class="border-box-account border-t-b-0 center-first">
                                <div class="count-profile-sales">
                                    <span ng-bind=" vm.count.balanceDiamond || '-'">
                                        {{--<% vm.count.balanceDiamond || '-' %>--}}
                                    </span>
                                    Balance Diamond
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 no-pad">
                            <div class="border-box-account border-t-b-0 right-first">
                                <div class="count-profile-sales">
                                    <span>
                                        <div class="sub-box"
                                             ng-bind="vm.count.balanceAmt || '-'">{{-- <% vm.count.balanceAmt || '-' %>--}}</div>

                                    </span>
                                    Balance Amount
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            @include('templates.profile.filter')

                        </div>
                    </div>
                    <!--// end row -->
                </div>

                <div role="tabpanel" class="tab-pane fade padding-tb-10" id="party_balance">
                    <div class="row">
                        <div class="col-sm-12">
                            @include('templates.profile.filter')
                            <div class="table-wrap-body margin-t-30">
                                <div class="table-responsive">
                                    <!-- Table Striped -->
                                    <table class="table table-hover account" ng-if="vm.accountList.length">
                                        <thead>
                                        <tr>
                                            <th colspan="2">CUSTOMER INFO</th>
                                            <th colspan="3">DEBIT</th>
                                            <th colspan="3">CREDIT</th>
                                        </tr>
                                        <tr>
                                            <th>SR#</th>
                                            <th>Customer</th>
                                            <th>Metal</th>
                                            <th>Diamond</th>
                                            <th>Amount</th>
                                            <th>Metal</th>
                                            <th>Diamond</th>
                                            <th>Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="list in vm.accountList">
                                            <td ng-bind="$index+1"></td>
                                            <td ng-bind="list.Customer || '-'"></td>
                                            <td ng-bind="list.DrMetal || '-'"></td>
                                            <td ng-bind="list.DrDiamond || '-'"></td>
                                            <td ng-bind="list.DrAmount || '-'"></td>
                                            <td ng-bind="list.CrMetal || '-'"></td>
                                            <td ng-bind="list.CrDiamond || '-'"></td>
                                            <td ng-bind="list.CrAmount || '-'"></td>

                                        </tr>

                                        </tbody>
                                    </table>
                                {{--                                @include('common.loading')--}}

                                @include('common.error')
                                @include('common.loading')
                                <!-- End Table Striped -->
                                </div>
                                {{--<div loader id="loadingArea"></div>--}}
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- End Tab panes -->

            @include('templates.profile.account-ledger')
        </div>
    </div>
</div>