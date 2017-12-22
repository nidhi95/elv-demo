@extends('index')

@section('content')
    <style>
        .transaction-tab a.t-tab {
            margin-right: 17px;
            color: #686777;
        }

        .transaction-tab a.t-tab.active {
            margin-right: 19px;
            color: #160000;
            text-decoration: underline;
        }

        .tab-content {
            min-height: 430px;
        }

        .none {
            color: none;
            text-decoration: none;
        }
    </style>

    <link rel="stylesheet" href="/client-assets/date-picker/ui-bootstrap-custom-2.1.4-csp.css">
    <script src="/client-assets/date-picker/ui-bootstrap-custom-tpls-2.1.4.js"
            type="text/javascript"></script>
    <script src="/client-assets/modules/profile.js"></script>

    <style>
        .uib-daypicker table tr td {
            padding: 0px !important;
            vertical-align: middle;
        }

        .uib-daypicker .btn-group-sm > .btn, .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
            line-height: 0.5;
            border-radius: 3px;
        }

        .uib-daypicker .btn-group-sm > .btn, .btn-sm {
            padding: 10px 10px;
            font-size: 12px;
            line-height: 0.5;
            border-radius: 0px;
        }

        .tab-v5 .tab-content .tab-pane {
            font-size: 15px;
            color: #606060;
            background: transparent;
            padding: 0px 25px 20px 25px;
        }

        td a.print {

            font-family: "ProximaNova-Regular";
            color: #5d6465;
            outline: 0;
            cursor: pointer;

        }

        span.margin-r-10.pull-right i.glyphicon {

            cursor: pointer;
        }

        a.inr-font {
            font-family: "ProximaNova-Regular";
            color: #040404 !important;
            outline: 0;
            cursor: default;
        }

        .btn-tab-active {
            color: #333 !important;
            background-color: #fff !important;
            pointer-events: none;
        }

        a.btn.btn-tab {
            padding: 6px 15px !important;
        }
    </style>

    <div class="header-vertical-container" ng-controller="ProfileCtrl as vm">
        <div class="content" style="padding-bottom: 0 !important;">
            <div class="fd-bordered-container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>My Account</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">

            <div class="top-left-shadow"></div>
            <div class="bottom-right-shadow"></div>


            <div class="row">
                {{-- Function Params : vm.tabChangeClickFn(mainTab, subTab, subSubTab) --}}
                <ul class="nav nav-tabs my-account-tab" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#my-profile"
                           ng-class="(vm.show_loading || vm.tab == 'profile') ? 'disabled' : ''"
                           ng-click="vm.tabChangeClickFn('profile');vm.getUserDetailFn()"
                           aria-controls="my-profile" role="tab" data-toggle="tab">
                            My Profile
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#my_policy"
                           ng-class="(vm.show_loading || vm.tab == 'my_policy') ? 'disabled' : ''"
                           ng-click="vm.tabChangeClickFn('my_policy', 'raw_material', 'gold');vm.tabChangeFn();vm.getDiamondStock()"
                           aria-controls="stock" role="tab" data-toggle="tab">
                            My Policy
                        </a>
                    </li>

                    <li role="presentation">
                        <a href="#quotation"
                           ng-class="(vm.show_loading || vm.tab == 'quotation') ? 'disabled' : ''"
                           ng-click="vm.tabChangeClickFn('quotation', 'quotes');vm.tabChangeFn();"
                           aria-controls="status" role="tab" data-toggle="tab">
                            Quotation
                        </a>
                    </li>

                    <li role="presentation">
                        <a href="#orders"
                           ng-class="(vm.show_loading || vm.tab == 'orders') ? 'disabled' : ''"
                           ng-click="vm.tabChangeClickFn('orders', 'orders');vm.tabChangeFn();"
                           aria-controls="orders" role="tab" data-toggle="tab">
                            Orders
                        </a>
                    </li>


                    {{--  <li role="presentation">
                          <a ng-click="vm.tab = 'status';vm.sub_tab='quotes';vm.tabChangeFn();"
                             href="#status" aria-controls="status" role="tab" data-toggle="tab">
                              Status
                          </a>
                      </li>--}}
                    <li role="presentation">
                        <a href="#sales"
                           ng-class="(vm.show_loading || vm.tab == 'sales') ? 'disabled' : ''"
                           ng-click="vm.tabChangeClickFn('sales', 'invoice'); vm.tabChangeFn();"
                           aria-controls="sales" role="tab" data-toggle="tab">
                            Sales
                        </a>
                    </li>
                    {{-- <li role="presentation">
                         <a href="#account"
                            ng-click="vm.tab = 'account';vm.sub_tab='transaction';vm.sub_of_sub_tab='cash';vm.tabChangeFn();"
                            aria-controls="account" role="tab" data-toggle="tab">
                             Account
                         </a>
                     </li>--}}
                    {{-- <li role="presentation">
                         <a href="#stock"
                            ng-click="vm.tab = 'stock';vm.sub_tab='diamond';vm.tabChangeFn();vm.getDiamondStock()"
                            aria-controls="stock" role="tab" data-toggle="tab">
                             Stock
                         </a>
                     </li>
 --}}
                    <li role="presentation">
                        <a href="#raw_material_stock"
                           ng-class="(vm.show_loading || vm.tab == 'raw_material_stock') ? 'disabled' : ''"
                           ng-click="vm.tabChangeClickFn('raw_material_stock', 'metal', 'all');vm.tabChangeFn();vm.getDiamondStock()"
                           aria-controls="stock" role="tab" data-toggle="tab">
                            Raw Material Stock
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#ledger"
                           ng-class="(vm.show_loading || vm.tab == 'ledger') ? 'disabled' : ''"
                           ng-click="vm.tabChangeClickFn('ledger', 'ledger');vm.tabChangeFn();"
                           aria-controls="ledger" role="tab" data-toggle="tab">
                            Ledger
                        </a>
                    </li>

                </ul>

                <div class="tab-content my-account">
                    <div ng-if="vm.tab=='profile'">
                        @include('templates.profile.profile')
                    </div>
                    <div ng-if="vm.tab=='quotation'">
                        @include('templates.profile.quotation')
                    </div>
                    <div ng-if="vm.tab=='orders'">
                        @include('templates.profile.orders')
                    </div>
                    {{--<div ng-if="vm.tab=='status'">
                        @include('templates.profile.status')
                    </div>--}}
                    <div ng-if="vm.tab=='sales'">
                        @include('templates.profile.sales')
                    </div>
                    <div ng-if="vm.tab=='ledger'">
                        @include('templates.profile.account-ledger')
                    </div>
                    <div ng-if="vm.tab=='raw_material_stock'">
                        @include('templates.profile.stock')
                    </div>
                    <div ng-if="vm.tab=='my_policy'">
                        @include('templates.profile.policy')
                    </div>


                </div>
            </div>

        </div>

    </div>

@endsection