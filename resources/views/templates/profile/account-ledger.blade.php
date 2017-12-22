<style>

    table td, table th {
        padding: 5px !important;
        font-size: 14px !important;
    }

    table.ledger td, table.ledger th {
        border: none !important;

    }

    table.ledger th.header {
        font-size: 23px !important;
        font-weight: 600;
    }

    span.btn.btn-sm.btn-default.margin-r-10 {
        pointer-events: none;
    }


    .text-bold{
        font-weight: bold !important;
    }

</style>
<div ng-if="vm.tab=='ledger'" class="table-wrap-body ">
    @include('templates.profile.filter')

    <div class="row margin-t-20 margin-l-10 text-left" ng-if="vm.ledger_list && vm.ledger_list.length">
        <label>Balance Gold : </label> <span class="btn btn-sm btn-default margin-r-10"
                                             ng-bind="vm.count.balanceGold"></span>
        <label>Balance Diamond : </label> <span class="btn btn-sm btn-default margin-r-10"
                                                ng-bind="vm.count.balanceDiamond"></span>
        <label>Balance Amount : </label> <span class="btn btn-sm btn-default margin-r-10"
                                               ng-bind="vm.count.balanceAmt"></span>
    </div>
    <div class="table-responsive margin-t-10" ng-if="vm.ledger_list && vm.ledger_list.length"
         style="background: rgba(255, 255, 255, 0.5);">
        <!-- Table Striped -->
        <table class="table table-hover ledger">
            <thead>
            <tr>
                <th class="header" colspan="<% vm.selected_sub_tab.header.length %>">
                    Credit
                </th>
                <th class="header" colspan="<% vm.selected_sub_tab.header.length %>">
                    Debit
                </th>
            </tr>
            <tr>
                <th style="padding: 6px !important;" ng-repeat="h in vm.selected_sub_tab.header" ng-bind="h"></th>
                <th style="padding: 6px !important;" ng-repeat="h in vm.selected_sub_tab.header" ng-bind="h"></th>
            </tr>
            {{-- <tr>
                <th colspan="3">
                    <strong>Opening</strong>
                </th>
                <th>
                    <strong></strong>
                </th>
                <th><strong></strong></th>
                <th colspan="2"><strong></strong></th>
                <th colspan="3">
                    <strong>Opening</strong>
                </th>
                <th>
                    <strong></strong>
                </th>
                <th><strong></strong></th>
                <th colspan="2"></th>
            </tr> --}}

            </thead>
            <tr ng-repeat="list in vm.ledger_list track by $index">

                <td style="white-space: nowrap" ng-bind="list.credit.date"
                ng-class="{'text-bold': !list.credit.date}">
                </td>
                <td ng-bind="list.credit.particular"
                    ng-class="{'text-bold': !list.credit.date}"></td>
                <td style="color: #4646f9;"
                    ng-class="{'text-bold': !list.credit.date}">
                    <a href="<% list.credit.print %>" target="_blank" class="text-primary"
                       ng-bind="list.credit.voucherno" ng-if="list.credit.print != ''"></a>
                    <a ng-bind="list.credit.voucherno" ng-if="list.credit.print == ''"></a>
                </td>
                <td ng-bind="list.credit.metal" ng-class="{'text-bold': !list.credit.date}"></td>
                <td ng-bind="list.credit.diamond"
                    ng-class="{'text-bold': !list.credit.date}"></td>
                <td ng-bind="list.credit.amount"
                    ng-class="{'text-bold': !list.credit.date}"></td>
                <td>
                    <span ng-if="list.credit!=null && list.credit.date">
                        <i style="color: #228222" ng-if="list.credit.verified=='true'" class="ti-check"></i>
                        <i ng-if="list.credit.verified !='true'" class="ti-close"></i>
                    </span>
                </td>
                <td style="white-space: nowrap" ng-bind="list.debit.date"
                    ng-class="{'text-bold': !list.debit.date}">
                </td>
                <td ng-bind="list.debit.particular"
                    ng-class="{'text-bold': !list.debit.date}"></td>
                <td style="color: #4646f9;"
                    ng-class="{'text-bold': !list.debit.date}">
                    <a href="<% list.debit.print %>" target="_blank" class="text-primary"
                       ng-if="list.debit.print != ''"
                       ng-bind="list.debit.voucherno"></a>
                    <a ng-if="list.debit.print == ''" ng-bind="list.debit.voucherno"></a>

                </td>
                <td ng-bind="list.debit.metal"
                    ng-class="{'text-bold': !list.debit.date}"></td>
                <td ng-bind="list.debit.diamond"
                    ng-class="{'text-bold': !list.debit.date}"></td>
                <td ng-bind="list.debit.amount"
                    ng-class="{'text-bold': !list.debit.date}"></td>
                <td>
                    <span ng-if="list.debit!=null && list.debit.date">
                        <i style="color: #228222" ng-if="list.debit.verified=='true'" class="ti-check"></i>
                        <i ng-if="list.debit.verified !='true'" class="ti-close"></i>
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="3">

                </td>
                <td><strong ng-bind="vm.cr_metals | number : 3"></strong></td>
                <td><strong ng-bind="vm.cr_diamonds | number : 3"></strong></td>
                <td><strong ng-bind="vm.cr_amount"></strong></td>
                <td></td>
                <td colspan="3">

                </td>
                <td><strong ng-bind="vm.dr_metals | number : 3"></strong></td>
                <td><strong ng-bind="vm.dr_diamonds | number : 3"></strong></td>
                <td><strong ng-bind="vm.dr_amount"></strong></td>
                <td></td>
            </tr>
            <tbody>

            </tbody>
        </table>


        {{-- OLD TABLE

          <table class="table table-hover" ng-if="vm.accountList.length">
              <thead>
              <tr>
                  <th ng-repeat="h in vm.selected_sub_tab.header" ng-bind="h"></th>
              </tr>
              </thead>
              <tbody>
              <tr ng-repeat="list in vm.accountList">
                  <td ng-bind="$index + 1"></td>
                  <td style="white-space: nowrap" ng-bind="list.date">
                  </td>
                  <td ng-bind="list.diamond "></td>
                  <td ng-bind="list.metal "></td>
                  <td ng-bind="list.voucherno "></td>
                  <td ng-bind="list.particular "></td>
                  <td ng-bind="list.amount "></td>
                  <td ng-bind="list.transaction "></td>

                  <td>
                      <i ng-if="list.verified=='true'" class="ti-check"></i>
                      <i ng-if="list.verified !='true'" class="ti-close"></i>
                  </td>
              </tr>


              </tbody>
          </table>--}}
        {{--                                @include('common.loading')--}}


        <!-- End Table Striped -->
    </div>
    @include('common.loading')
    @include('common.error')
</div>