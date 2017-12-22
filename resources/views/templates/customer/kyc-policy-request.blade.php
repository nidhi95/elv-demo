@extends('index')

@section('content')

    <script src="/client-assets/modules/kyc-policy-request.js"></script>

    <div class="header-vertical-container"
         ng-controller="KycPolicyRequestCtrl as vm">
        <div class="content" style="padding-bottom: 0 !important;">

            <div class="fd-bordered-container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Policy - <span ng-bind="vm.policyDetail.title"></span></h1>
                    </div>
                </div>
            </div>
        </div>


        <div class="content">

            <div class="top-left-shadow"></div>
            <div class="bottom-right-shadow"></div>

            <div ng-if="vm.no_data" class="row text-center">
                <h3 class="" ng-bind="vm.errorMsg"></h3>
            </div>
            <div></div>
            {{--   <div class="row">
                   <div class="col-sm-12 text-right">
                       <a ng-click="vm.policyUpdateFn(vm.approve)"
                          class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag">
                           Accept
                       </a>
                       <a href="/remark-policy-reject?token=<%vm.current_token%>"
                          class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag">
                           Reject
                       </a>
                   </div>
               </div>--}}
            <div class="row" style="padding-top: 25px; padding-bottom: 25px;">
                <div class="col-sm-12">

                    <div class="col-sm-12 policy-content">
                        <div ng-bind-html="vm.policyDetail.description">
                            {{--  <li>
                                  Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                              </li>--}}
                            {{-- <li>
                                 Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                 unknown printer took a galley of type and scrambled it to make a type specimen book.
                             </li>
                             <li>
                                 It has survived not only five centuries, but also the leap into electronic typesetting,
                                 remaining essentially unchanged.
                             </li>
                             <li>
                                 It was popularised in the 1960s with the release of Letraset sheets containing Lorem
                                 Ipsum
                                 passages, and more recently with desktop publishing software like Aldus PageMaker
                                 including
                                 versions of Lorem Ipsum.
                             </li>--}}
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-right">

                    <a ng-click="vm.policyUpdateFn(vm.approve)"
                       class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag">
                        Accept
                    </a>
                    <a href="/remark-policy-reject?token=<%vm.current_token%>"
                       class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag">
                        Reject
                    </a>
                </div>
            </div>

        </div>

    </div>

@endsection