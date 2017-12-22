<style>
    .btn-tab-active {
        color: #333 !important;
        background-color: #fff !important;
        pointer-events: none;
    }

    .btn-tab .btn {
        padding: 6px 15px !important;
    }

</style>
<script src="/client-assets/modules/policy.js"></script>
<div ng-controller="PolicyCtrl as vm">
    <div role="tabpanel" class="tab-pane tab-pane-space-around fade" id="my_policy">

        <div class="tab-v5">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-left" role="tablist">

                <li role="presentation" class="active">
                    <a href="#tab-v5-2"
                       ng-click="vm.type='gold';vm.policy_list=[];vm.shapes=[];vm.shape='All';vm.page=1;vm.getPolicyDataFn();"
                       ng-class="(vm.show_loading) ? 'disabled' : ''"
                       aria-controls="tab-v5-2"
                       role="tab"
                       data-toggle="tab">
                        Raw Material
                    </a>
                </li>
                <li role="presentation">
                    <a href="#tab-v5-1"
                       ng-click="vm.type='charges';vm.policy_list=[];vm.shapes=[];vm.shape='All';vm.page=1;vm.getPolicyDataFn();"
                       ng-class="(vm.show_loading) ? 'disabled' : ''"
                       aria-controls="tab-v5-1"
                       role="tab"
                       data-toggle="tab">
                        Labour
                    </a>
                </li>
                <li role="presentation">
                    <a href="#tab-v5-3"
                       ng-click="vm.type='other';"
                       ng-class="(vm.show_loading) ? 'disabled' : ''"
                       aria-controls="tab-v5-3"
                       role="tab"
                       data-toggle="tab">
                        Others
                    </a>
                </li>
            </ul>
            <!-- End Nav tabs -->

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active">

                    <div class="row">
                        <div class="col-sm-12">

                            @include('templates.my-policy.charges')


                            @include('templates.my-policy.policy')
                            @include('templates.my-policy.others')


                        </div>
                    </div>

                </div>
            </div>
            <!-- End Tab panes -->
            {{--</div>--}}
        </div>
    </div>
</div>