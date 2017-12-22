<style>
    .ledger.fa.fa-inr {
        font-size: 20px;
        color: #555555;
        font-weight: 100;
    }
</style>

<div role="tabpanel" class="tab-pane tab-pane-space-around fade in active" id="my-profile">

    {{--<div loader id="loadingArea" ng-if="!loginUser || !loginUser.userid"></div>--}}
    <div {{--loader id="loadingArea"--}}>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="user-profile">
                    <div class="user-img">
                        <img src="../client-assets/img/profile.png" alt="">
                    </div>

                    <div class="user-detail">
                        <h3>
                            <span ng-bind="loginUser.FirstName + ' ' + loginUser.LastName"></span>
                            <a href="/edit-profile"> <i class="fa fa-edit text-primary"></i> </a>
                        </h3>

                        <div class="user-email">
                            <i class="icon-envelope"></i><span ng-bind="loginUser.userid"></span>
                        </div>
                        <div class="user-email">
                            <i class="icon-mobile"></i><span ng-bind="loginUser.Mobile"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 no-pad">
                <div class="border-box-account left-first">
                    <div class="count-profile">
                        <div ng-bind="vm.user_data.totalGold"></div>
                        ct<span>Gold</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 no-pad">
                <div class="border-box-account center-first">
                    <div class="count-profile">

                        <div ng-bind="vm.user_data.totalDiamond"></div>
                        ct<span>Diamonds</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 no-pad">
                <div class="border-box-account right-first">
                    <div class="count-profile">

                        <div ng-bind="vm.user_data.totalColorStone"></div>
                        pcs<span>Color Stone</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 no-pad">
                <div class="border-box-account noborder-center">
                    <div class="count-profile-middle">
                        <span>Labour Charges : </span> <i ng-if="vm.user_data.totalOutstandingAmt"
                                                          class="ledger fa fa-inr"></i><span
                                ng-bind="vm.user_data.totalOutstandingAmt"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 no-pad">
                <div class="border-box-account left-first">
                    <div class="count-profile">
                        {{--<% vm.user_data.totalQuotes || '-' %>--}}
                        <div ng-bind="vm.user_data.totalQuotes"></div>
                        <span>WIP Jobs</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 no-pad">
                <div class="border-box-account center-first">
                    <div class="count-profile">
                        {{--<% vm.user_data.totalJobs || '-' %>--}}
                        <div ng-bind="vm.user_data.totalJobs"></div>
                        <span>Quotes Jobs</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 no-pad">
                <div class="border-box-account right-first">
                    <div class="count-profile">
                        {{--<% vm.user_data.totalOrders || '-' %>--}}
                        <div ng-bind="vm.user_data.totalOrders"></div>
                        <span>delivery jobs</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>