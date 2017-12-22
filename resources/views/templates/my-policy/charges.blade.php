<div ng-if="vm.type=='charges'">
    {{-- @include('common.loading')--}}


    <div class="row" ng-repeat="p in vm.policy_list">
        <div class="col-sm-12 margin-b-10 text-right">
            <span class="">
                Policy Due Date : <strong ng-bind="vm.policyDueDate"></strong>
            </span>
        </div>
        <div class="col-sm-4 no-pad">
            <div class="border-box-account left-first">
                <div class="count-profile">
                    <a style="pointer-events: none;color: #000;" ng-bind="p.MetalRateOnOnname || '-'"></a>
                    <span>Make Rate On</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4 no-pad">
            <div class="border-box-account center-first">
                <div class="count-profile">
                    <a style="pointer-events: none;color: #000;" ng-bind="p.MackingChargeOnname || '-'"></a>
                    <span>Making Charge On</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4 no-pad">
            <div class="border-box-account right-first">
                <div class="count-profile">
                    <i class="fa fa-inr" ng-bind="p.makingchargelabour"></i><span>
                        Charge </span>
                </div>
            </div>
        </div>
    </div>
    @include('common.loading')
    @include('common.error')
</div>