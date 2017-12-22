@extends('index')

@section('content')


    <script src="/client-assets/modules/policy.js"></script>
    <div class="header-vertical-container" ng-controller="PolicyCtrl as vm">
        <div class="content" style="padding-bottom: 0 !important;">

            <div class="fd-bordered-container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>My Policy</h1>
                    </div>
                </div>
            </div>
        </div>


        <div class="content">

            <div class="top-left-shadow"></div>
            <div class="bottom-right-shadow"></div>

            <div class="row">
                <ul class="nav nav-tabs my-account-tab" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#diamond_policy"
                           ng-click="vm.type='charges';vm.policy_list=[];vm.shapes=[];vm.shape='All';vm.page=1;vm.getPolicyDataFn();"
                           aria-controls="diamond_policy" role="tab" data-toggle="tab">
                            Making Charges
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#diamond_policy"
                           ng-click="vm.type='diamond';vm.policy_list=[];vm.shapes=[];vm.shape='All';vm.page=1;vm.getPolicyDataFn();"
                           aria-controls="diamond_policy" role="tab" data-toggle="tab">
                            Diamond Policy
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#color_policy"
                           ng-click="vm.type='stone';vm.page=1;vm.policy_list=[];vm.shapes=[];vm.shape='All';vm.getPolicyDataFn();"
                           aria-controls="color_policy" role="tab" data-toggle="tab">
                            Color Stone Policy
                        </a>
                    </li>
                </ul>

                <div class="tab-content my-account">
                    <div role="tabpanel" class="tab-pane tab-pane-space-around fade active in">
                        <div class="row">
                            <div class="col-sm-12">

                                @include('templates.my-policy.charges')


@include('templates.my-policy.policy')

                                <div class="row text-center margin-t-10"
                                     ng-if="vm.type != 'charges' && vm.policy_list.length && !vm.disabled && vm.total_count != vm.policy_list.length">
                                    <button class="btn btn-default" ng-click="vm.getPolicyDataFn()">
                                        Load more
                                    </button>

                                </div>
                            </div>
                        </div>


                    </div>

                    {{--   <div role="tabpanel" class="tab-pane tab-pane-space-around fade" id="color_policy">
                           <div class="row">
                               <div class="col-sm-12">
                                   <div class="table-wrap-body margin-t-30">
                                       <div class="table-responsive">
                                           <!-- Table Striped -->
                                           <table class="table table-hover">
                                               <thead>
                                               <tr>
                                                   <th>Sr#</th>
                                                   <th>Shape</th>
                                                   <th>Quality</th>
                                                   <th>Color</th>
                                                   <th>Rate/Ctw</th>
                                               </tr>
                                               </thead>
                                               <tbody>
                                               <tr>
                                                   <td>01</td>
                                                   <td>ASR</td>
                                                   <td>PLK</td>
                                                   <td>Yellow</td>
                                                   <td>150</td>
                                               </tr>
                                               <tr>
                                                   <td>02</td>
                                                   <td>MRQ</td>
                                                   <td>RUD</td>
                                                   <td>White</td>
                                                   <td>150</td>
                                               </tr>
                                               <tr>
                                                   <td>03</td>
                                                   <td>Ungraded</td>
                                                   <td>CZ</td>
                                                   <td>Blue</td>
                                                   <td>150</td>
                                               </tr>
                                               <tr>
                                                   <td>04</td>
                                                   <td>ASR</td>
                                                   <td>PLK</td>
                                                   <td>Black</td>
                                                   <td>150</td>
                                               </tr>
                                               <tr>
                                                   <td>05</td>
                                                   <td>Rnd Pota</td>
                                                   <td>PLK</td>
                                                   <td>Red</td>
                                                   <td>150</td>
                                               </tr>
                                               <tr>
                                                   <td>06</td>
                                                   <td>ASR</td>
                                                   <td>PLK</td>
                                                   <td>Yellow</td>
                                                   <td>150</td>
                                               </tr>
                                               <tr>
                                                   <td>07</td>
                                                   <td>ASR</td>
                                                   <td>PLK</td>
                                                   <td>Yellow</td>
                                                   <td>150</td>
                                               </tr>
                                               <tr>
                                                   <td>08</td>
                                                   <td>ASR</td>
                                                   <td>PLK</td>
                                                   <td>Yellow</td>
                                                   <td>150</td>
                                               </tr>
                                               <tr>
                                                   <td>09</td>
                                                   <td>ASR</td>
                                                   <td>PLK</td>
                                                   <td>Yellow</td>
                                                   <td>150</td>
                                               </tr>
                                               <tr>
                                                   <td>10</td>
                                                   <td>ASR</td>
                                                   <td>PLK</td>
                                                   <td>Yellow</td>
                                                   <td>150</td>
                                               </tr>
                                               </tbody>
                                           </table>
                                           <!-- End Table Striped -->
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>--}}
                </div>
            </div>

        </div>

    </div>

@endsection