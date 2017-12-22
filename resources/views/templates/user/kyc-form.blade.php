@extends('index')

@section('content')
    <link rel="stylesheet" href="/app/common/js/bower_components/intl-tel-input/build/css/intlTelInput.css">
    <script src="/app/common/js/bower_components/intl-tel-input/build/js/intlTelInput.js"></script>
    <script src="/app/common/js/bower_components/intl-tel-input/build/js/utils.js"></script>
    <script src="/app/common/js/bower_components/ng-intl-tel-input/dist/ng-intl-tel-input.min.js"></script>
    <script src="/app/common/js/bower_components/betsol-ng-intl-tel-input/dist/scripts/betsol-ng-intl-tel-input.min.js"></script>
    <script type="text/javascript" src="/client-assets/modules/kyc-form.js"></script>

    <style>
        .default-btn {
            background-color: #d4d4d4;
            pointer-events: none;
        }

        #toast-container {
            position: fixed;
            z-index: 999999999999;
            pointer-events: auto;
        }

        .intl-tel-input.allow-dropdown.fieldWriting {
            width: 100%;
        }

        .intl-tel-input .flag-container {
            position: absolute;
            top: 15px;
            bottom: 0;
            right: 0;
            padding: 1px;
        }

        .intl-tel-input .country-list {
            z-index: 999;
        }
    </style>

    <div class="header-vertical-container" ng-controller="KycCtrl as vm" loader id="loadingArea">
        <div class="content" style="padding-bottom: 0 !important;">
            <div class="fd-bordered-container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>KYC Form </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="top-left-shadow"></div>
            <div class="bottom-right-shadow"></div>
            <div id="smartwizard">
                <ul>
                    <li ng-click="vm.step=vm.steps[0];">
                        <a href="#step-1">Step 1<br/>
                            <small>Company Information</small>
                        </a>
                    </li>
                    <li ng-click="vm.step=vm.steps[1];">
                        <a href="#step-2">Step 2<br/>
                            <small>Personal Information</small>
                        </a>
                    </li>
                    <li ng-click="vm.step=vm.steps[2];">
                        <a href="#step-3">Step 3<br/>
                            <small>Bank Information</small>
                        </a>
                    </li>
                    <li ng-click="vm.step=vm.steps[3];">
                        <a href="#step-4">Step 4<br/>
                            <small>Shipping Information</small>
                        </a>
                    </li>
                </ul>

                <div>

                    <div id="step-1" step="<% vm.steps[0] %>" class="">
                        <form name="updateForm" class="fd-rg-fields js_fd-validate" autocomplete="off">
                            <div class="tab-content my-account">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="fd-fieldcontainer">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-12 text-left">
                                                            <h4>Company Info</h4>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label class="fake-input">
                                                                <select class="fd-visible"
                                                                        ng-model="vm.kyc.companyType"
                                                                        name="companyType" required="">
                                                                    <option value="">Company Type*</option>
                                                                    <option value="Wholesale">Wholesale</option>
                                                                    <option value="Retailer">Retailer</option>
                                                                    <option value="Chain Store">Chain Store</option>
                                                                </select>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    Company Name *
                                                                </span>
                                                                <input type="text"
                                                                       class="fd-visible" ng-model="vm.kyc.companyName"
                                                                       name="companyName" required="">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    Address *
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.address.line1"
                                                                       name="company_line1" required="">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    City *
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.address.city"
                                                                       name="company_city" required="">
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    Pincode *
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.address.pincode"
                                                                       name="company_pincode" required="">
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    State *
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.address.state"
                                                                       name="company_state" required="">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">

                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    Website

                                                                    <small ng-show="updateForm.companyWebsite.$error.pattern"
                                                                           class="text-red">Invalid URL !
                                                                    </small>
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-pattern="/^([w]{3}[.])?([a-z]+[.])?[a-z0-9-]+([.][a-z]{1,4}){1,2}(\/.*[?].*)?$/"
                                                                       ng-model="vm.kyc.companyWebsite"
                                                                       name="companyWebsite">
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    E-Mail *
                                                                    <small class="text-red"
                                                                           ng-if="updateForm.companyEmail.$error.pattern">
                                                                        Invalid Email !
                                                                    </small>
                                                                </span>
                                                                <input type="email" class="fd-visible"
                                                                       ng-pattern="email_pattern"
                                                                       ng-model="vm.kyc.companyEmail"
                                                                       name="companyEmail" required="">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">

                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn inputEdited"
                                                                      style="left: 52px;">
                                                                    Mobile *
                                                                    <small class="text-red"
                                                                           ng-if="updateForm.companyMobile.$error.pattern || updateForm.companyMobile.$error.ngIntlTelInput">
                                                                        Invalid Number !
                                                                    </small>
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       numbers-only
                                                                       {{--data-get-number="true"--}}
                                                                       {{--data-separate-dial-code="true"--}}
                                                                       ng-intl-tel-input
                                                                       data-initial-country="in"
                                                                       ng-model="vm.kyc.companyMobile"
                                                                       name="companyMobile" required="">
                                                                {{--  <input type="text" name="tel" ng-model="tel"
                                                                         ng-intl-tel-input>--}}
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    STD Code
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       numbers-only maxlength="5"
                                                                       ng-model="vm.kyc.companyStdCode"
                                                                       name="companyStdCode">
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    Telephone
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       numbers-only maxlength="15"
                                                                       ng-model="vm.kyc.companyPhone"
                                                                       name="companyPhone">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    GSTIN *
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.companyGstin"
                                                                       name="companyGstin" required="">
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-6">

                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    PAN Detail *
                                                                    <small class="text-red"
                                                                           ng-if="updateForm.companyPAN.$error.pattern">
                                                                        Invalid PAN number !
                                                                    </small>
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-pattern="/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/"
                                                                       ng-model="vm.kyc.companyPAN"
                                                                       maxlength="10"
                                                                       name="companyPAN" required="">
                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="step-2" step="<% vm.steps[1] %>" class="">
                        <form name="updateForm1" class="fd-rg-fields js_fd-validate" autocomplete="off">
                            <div class="tab-content my-account">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="fd-fieldcontainer">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-12 text-left">
                                                            <h4>Personal Info</h4>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    Name *
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.name"
                                                                       required
                                                                       name="name">
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn top-fix-inp inputEdited">
                                                                    Birthday
                                                                </span>

                                                                <input type="date" class="fd-visible"
                                                                       ng-model="vm.kyc.dob"
                                                                       name="dob"
                                                                       style="padding-top: 15px; background: transparent">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label class="fake-input">

                                                                <span class="fake-placeholder fastTransition fadeIn top-fix-inp inputEdited">
                                                                    Anniversary
                                                                </span>
                                                                <input type="date" class="fd-visible"
                                                                       ng-model="vm.kyc.anniversary"
                                                                       name="anniversary"
                                                                       style="padding-top: 15px; background: transparent">
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn inputEdited"
                                                                      style="left:52px;">
                                                                    Mobile *
                                                                    <small class="text-red"
                                                                           ng-if="updateForm1.mobile.$error.pattern || updateForm1.mobile.$error.ngIntlTelInput">
                                                                        Invalid Number !
                                                                    </small>
                                                                </span>
                                                                {{--    <input type="text" class="fd-visible"
                                                                           ng-model="vm.kyc.mobile"
                                                                           numbers-only
                                                                           required
                                                                           name="mobile">--}}

                                                                <input type="text" class="fd-visible"
                                                                       numbers-only
                                                                       data-get-number="true"
                                                                       ng-intl-tel-input data-national-mode="false"
                                                                       data-initial-country="in"
                                                                       ng-model="vm.kyc.mobile"
                                                                       name="mobile" required="">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    STD Code
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       maxlength="5"
                                                                       ng-model="vm.kyc.stdCode"
                                                                       name="stdCode">
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    Telephone
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.phone"
                                                                       name="phone">
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    Email *
                                                                    <small class="text-red"
                                                                           ng-if="updateForm1.personalEmail.$error.pattern">
                                                                        Invalid Email !
                                                                    </small>
                                                                </span>
                                                                <input type="email" class="fd-visible"
                                                                       ng-pattern="email_pattern"
                                                                       ng-model="vm.kyc.email"
                                                                       name="personalEmail"
                                                                       required>
                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="step-3" step="<% vm.steps[2] %>" class="">
                        <form name="updateForm2" class="fd-rg-fields js_fd-validate" autocomplete="off">
                            <div class="tab-content my-account">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="fd-fieldcontainer">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-12 text-left">
                                                            <h4>Bank Info</h4>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    Bank Name
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.bankName"
                                                                       name="bankName" required>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    Branch
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.bankBranch"
                                                                       name="bankBranch" required>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    Account Number
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.bankAccountNumber"
                                                                       name="bankAccountNumber" required>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    IFSC Code
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.bankIFSCCode"
                                                                       name="bankIFSCCode" required>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    {{--   <div class="row">
                                                           <div class="col-sm-6">
                                                               <label class="fake-input">
                                                                   <select class="fd-visible"
                                                                           ng-model="vm.kyc.company_type"
                                                                           name="company_type" required="">
                                                                       <option selected disabled value="">Product Info *
                                                                       </option>
                                                                       <option value="">Hallmark</option>
                                                                       <option value="">Diamond Detail</option>
                                                                       <option value="">Other</option>
                                                                   </select>
                                                               </label>
                                                           </div>
                                                       </div>--}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="step-4" step="<% vm.steps[3] %>" class="">
                        <form name="updateForm3" class="fd-rg-fields js_fd-validate" autocomplete="off">
                            <div class="tab-content my-account">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="fd-fieldcontainer">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-12 text-left">
                                                            <h4>Shipping Info</h4>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    Your Shipping Partner
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.shippingPartner"
                                                                       name="shippingPartner">
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    Address *
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.shippingAddress.line1"
                                                                       name="shippingAddressLine1" required>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    City *
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.shippingAddress.city"
                                                                       name="shippingAddresscity" required>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    PinCode *
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.shippingAddress.pincode"
                                                                       name="shippingAddressPin" required>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    State *
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.shippingAddress.state"
                                                                       name="shippingAddressState" required>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    Mobile *
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       numbers-only
                                                                       ng-model="vm.kyc.shippingMobile"
                                                                       name="shippingMobile" required>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="fake-input">
                                                                <span class="fake-placeholder fastTransition fadeIn">
                                                                    Telephone
                                                                </span>
                                                                <input type="text" class="fd-visible"
                                                                       ng-model="vm.kyc.shippingPhone"
                                                                       name="shippingPhone">
                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>


@endsection