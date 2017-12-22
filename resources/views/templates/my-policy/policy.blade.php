<style>
    .m-t-md {
        margin-top: 15px;
    }

    strong.policy {
        color: #3a3a44;
    }
</style>

<div class="table-wrap-body  btn-tab" ng-if="vm.type == 'gold' || vm.type == 'diamond'|| vm.type == 'stone'"
     ng-init="vm.shape='All'">
    <div>
        <button class=" btn btn-default <% (vm.type == 'gold') ? 'btn-tab-active' : '' %>"
                ng-class="(vm.show_loading || vm.type == 'gold') ? 'disabled' : ''"
                ng-click="vm.type='gold'; vm.search = null;vm.filterFn();">
            Gold
        </button>
        <button class="btn btn-default <% (vm.type == 'diamond') ? 'btn-tab-active' : '' %>"
                ng-class="(vm.show_loading || vm.type == 'diamond') ? 'disabled' : ''"
                ng-click="vm.type='diamond'; vm.search = null;vm.filterFn();">
            Diamond
        </button>
        <button class="btn btn-default <% (vm.type == 'stone') ? 'btn-tab-active' : '' %>"
                ng-class="(vm.show_loading || vm.type == 'stone') ? 'disabled' : ''"
                ng-click="vm.type='stone'; vm.search = null;vm.filterFn();">
            Color Stone
        </button>
    </div>
    <div ng-show="vm.type != 'gold'" class="table-responsive">
        <!-- Table Striped -->
        <table class="table table-hover margin-t-10">

            <thead>
            <tr>
                <td colspan="2" class="margin-b-10">
                    <div class="input-group" style="width: 100%">
                        <span class="input-group-addon" id="basic-addon1">Shape</span>
                        <select class="form-control" ng-model="vm.shape"
                                ng-change="vm.filterFn(vm.shape)">
                            {{--<option value=""></option>--}}
                            <option ng-value="<%item.Shape%>" ng-repeat="item in vm.shapes"><%item.Shape%></option>
                        </select>
                    </div>
                </td>
                <td colspan="2" class="margin-b-10">
                    <form ng-submit="vm.filterFn()">
                        <div class="input-group">

                            <input type="text"
                                   class="form-control"
                                   placeholder="Search"
                                   ng-model="vm.search"
                                   ng-disabled="vm.show_loading"
                                   aria-describedby="basic-addon2">
                            <span class="input-group-addon"
                                  ng-click="vm.filterFn()"
                                  id="basic-addon2"><i class="fa fa-search"></i></span>

                        </div>
                    </form>

                </td>

                <td class="text-right" style="padding-right: 7%;"
                    colspan="<% (vm.type=='diamond') ? 4 : 3 %>">
                    Policy Due Date : <strong class="policy" ng-bind="vm.policyDueDate"></strong>
                </td>

            </tr>
            <tr ng-if="vm.policy_list.length">
                <th>Sr#</th>
                <th>Shape</th>
                <th>Quality</th>
                <th>Color</th>
                <th>Size</th>
                <th>Rate/Ctw</th>
            </tr>
            </thead>
            <tbody ng-if="vm.policy_list.length">
            <tr ng-repeat="policy in vm.policy_list">
                <td ng-bind="policy.SrNo"></td>
                <td ng-bind="policy.Shape"></td>
                <td ng-bind="policy.Quality"></td>
                <td ng-bind="policy.Color"></td>
                <td ng-bind="policy.PointersFrom + ' - ' + policy.PointersTo">
                </td>

                <td>
                    <i class="fa fa-inr"></i><span ng-bind="policy.Price"></span>
                </td>

            </tr>

            {{--     <tr ng-if="vm.show_loading">
                   --}}{{--  <td colspan="<% vm.type=='diamond' ? 6 : 5 %>">
                         @include('common.loading')
                     </td>--}}{{--
                 </tr>--}}


            </tbody>
        </table>
        <div ng-if="!vm.policy_list.length">
            @include('common.loading')
            {{--<div loader id="loadingArea"></div>--}}
        </div>
        @include('common.error')

        <div class="text-center margin-t-10"
             ng-if="vm.policy_list.length && !vm.disabled && vm.total_count != vm.policy_list.length">
            <button class="btn btn-default" ng-click="vm.getPolicyDataFn()">
                <img ng-if="vm.show_loading" src="/client-assets/img/load-xs.gif"> Load more
            </button>

        </div>
        <!-- End Table Striped -->
    </div>

    <div class="row  m-t-md" ng-if="vm.type == 'gold'">
        <span class="pull-right" ng-if="vm.policyDueDate">

            Policy Due Date : <strong class="policy" ng-bind="vm.policyDueDate"></strong>
        </span>

        <div class="col-sm-12 no-pad">

            <div class="border-box-account left-first text-left">
                Gold Rate 24 K : <i class="fa fa-inr"></i> <strong ng-bind="vm.gold_rates || 0"></strong>
            </div>
        </div>

    </div>
</div>

