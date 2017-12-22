@extends('index')

@section('content')

    <script src="/client-assets/modules/kyc-policy-request.js"></script>
    <style>
        .uploaded-file .badge {
            display: inline-block;
            min-width: 10px;
            padding: 0;
            font-size: 12px;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            background-color: #777;
            border-radius: 10px;
        }
    </style>
    <div class="header-vertical-container"
         ng-controller="KycPolicyRequestCtrl as vm">
        <div class="content" style="padding-bottom: 0 !important;">

            <div class="fd-bordered-container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Remark on Policy Reject</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="top-left-shadow"></div>
            <div class="bottom-right-shadow"></div>
            <div class="row" style="padding-top: 25px; padding-bottom: 25px;">
                <div class="col-sm-12">
                    <div class="col-sm-8 col-sm-offset-2 policy-content text-center">
                        {{--<h1>Thank You!</h1>--}}
                        <form name="form" ng-submit="vm.saveAddressFn()"
                              class="fd-rg-fields js_fd-validate ng-pristine ng-invalid ng-invalid-required"
                              autocomplete="off">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <div style="margin-bottom: 18px;">
                                        <div style="margin-bottom: 7px;">Upload Document</div>
                                        <div class="fileUploadnw" tabindex="6">
                                            <em>Attach File <% vm.uploaded_files.length ? '('+vm.uploaded_files.length+')' : '' %></em>
                                            <input type="file"
                                                   multiple
                                                   onchange="angular.element(this).scope().vm.fileUploadFn(this,'company','operator_logo')"
                                                   class="upload-fl jsField" id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 uploaded-file">
                                    <label ng-repeat="file in vm.uploaded_files" style="margin-left: 10px;">
                                        <img height="100" width="100"
                                             ng-src="<% file.is_image ? file.file : '/client-assets/img/doc-file.png'%>"/>
                                        <a class="badge badge-sm up pull-right-xs m-t"
                                           style="top:-23px;vertical-align: top; cursor: pointer; background-color: transparent"
                                           ng-click="vm.removeImgFn($index)">
                                            <i class="icon-close text-danger"
                                               style="vertical-align: top; font-size: 14px;"></i>
                                        </a>
                                    </label>
                                </div>
                            </div>
                            <label class="fake-input col-md-12 padd-0">
                                <span class="fake-placeholder fastTransition fadeIn">
                                    Remark
                                </span>
                                <input type="text" name="address" required=""
                                       ng-model="vm.remark" class="fd-visible">
                            </label>

                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <button type="submit"
                                            ng-click="vm.checkRemark=true;vm.policyUpdateFn(vm.reject)"
                                            class="btn btn-lg btn-md btn-sm btn-default fd-rg-btn-login ng-binding">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection