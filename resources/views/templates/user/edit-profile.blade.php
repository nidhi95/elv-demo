@extends('index')

@section('content')

    <script type="text/javascript" src="/client-assets/modules/account.js"></script>

    <style>
        .default-btn {
            background-color: #d4d4d4;
            pointer-events: none;
        }
    </style>
    <div class="header-vertical-container" ng-controller="AccountCtrl as vm">
        <div class="content" style="padding-bottom: 0 !important;">
            <div class="fd-bordered-container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Edit Profile</h1>
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
                        <a href="#profile-information" aria-controls="my-profile" role="tab" data-toggle="tab">
                            Profile Information
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#change-pswd" aria-controls="status" role="tab" data-toggle="tab">
                            Change Password
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#shipping-address" aria-controls="sales" role="tab" data-toggle="tab">
                            Shipping Address
                        </a>
                    </li>
                </ul>

                <div class="tab-content my-account">

                    <div role="tabpanel" class="tab-pane tab-pane-space-around fade in active" id="profile-information">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="fd-fieldcontainer">
                                    <form name="updateForm"
                                          ng-submit="vm.updateProfileFn()"
                                          class="fd-rg-fields js_fd-validate" autocomplete="off">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                {{--  <div class="col-sm-12">
                                                      <div class="user-profile" style="margin-bottom: 18px;">
                                                          <div class="user-img" style="margin-right: 0">
                                                              <img src="../client-assets/img/profile.png" alt="">
                                                              <div class="fileUpload btn btn-primary">
                                                                  <span>Upload</span>
                                                                  <input id="uploadBtn" type="file" class="upload" />
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>--}}
                                                <div class="col-sm-12">
                                                    <label class="fake-input">
                                                        <span class="fake-placeholder fastTransition fadeIn">
                                                            First Name
                                                        </span>
                                                        <input type="text"
                                                               ng-model="loginUser.FirstName" class="fd-visible"
                                                               required="">
                                                    </label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label class="fake-input">
                                                        <span class="fake-placeholder fastTransition fadeIn">
                                                            Last Name
                                                        </span>
                                                        <input type="text" ng-model="loginUser.LastName"
                                                               class="fd-visible" required="">
                                                    </label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label class="fake-input">
                                                        <span class="fake-placeholder fastTransition fadeIn">
                                                            Mobile
                                                        </span>
                                                        <input type="text"
                                                               numbers-only
                                                               ng-model="loginUser.Mobile"
                                                               class="fd-visible" required="">
                                                    </label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label class="fake-input">
                                                        <span class="fake-placeholder fastTransition fadeIn">
                                                            E-mail
                                                            <span style="color: red;"
                                                                  ng-show="!updateForm.email.$error.required && updateForm.email.$error.email && updateForm.email.$dirty">Invalid
                                                                email</span>
                                                        </span>
                                                        <input type="email"
                                                               name="email"
                                                               ng-model="loginUser.userid"
                                                               class="fd-visible" required="">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3 text-right">
                                                <button type="submit"
                                                        class="btn btn-lg btn-md btn-sm btn-default fd-rg-btn-login">
                                                    <img ng-if="vm.show_loading" src="/client-assets/img/load-xs.gif">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane tab-pane-space-around fade" id="change-pswd">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="fd-fieldcontainer">
                                    <form name="passwordForm" ng-submit="vm.changePasswordFn()"
                                          class="fd-rg-fields js_fd-validate" autocomplete="off">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <div class="col-sm-12">
                                                    <label class="fake-input">
                                                        <span class="fake-placeholder fastTransition fadeIn">
                                                            Old Password
                                                        </span>
                                                        <input ng-model="vm.password.oldPassword"
                                                               type="password" class="fd-visible" required="">
                                                    </label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label class="fake-input">
                                                        <span class="fake-placeholder fastTransition fadeIn">
                                                            New Password
                                                        </span>
                                                        <input type="password"
                                                               ng-model="vm.password.newPassword"
                                                               class="fd-visible" required="">
                                                    </label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label class="fake-input">
                                                        <span class="fake-placeholder fastTransition fadeIn">
                                                            Confirm Password
                                                            <span class="error"
                                                                  ng-if="vm.confirm_password && vm.password.newPassword != vm.confirm_password"
                                                                  style="color:RED">Password didn't match !</span>
                                                        </span>
                                                        <input type="password"
                                                               ng-model="vm.confirm_password"
                                                               class="fd-visible" required="">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3 text-right">
                                                <button type="submit"
                                                        class="btn btn-lg btn-md btn-sm btn-default fd-rg-btn-login">
                                                    <img ng-if="vm.show_loading" src="/client-assets/img/load-xs.gif">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane tab-pane-space-around fade" id="shipping-address">
                        <div class="row">
                            <div class="row">
                                {{--Loading area--}}
                                {{--<div loader id="loadingArea"></div>--}}

                                <div class="col-sm-4 margin-b-20" ng-if="vm.address_book && vm.address_book.length"
                                     ng-repeat="address in vm.address_book">
                                    <div class="address-hight card">
                                        <h3><% address.FirstName + ' '+ address.LastName %></h3>

                                        <div class="user-address">
                                            <% address.Address +', ' %><% address.City + (address.ZipCode ? (' -
                                            '+address.ZipCode) : '') +', ' %><% address.State + ', ' + address.Country
                                            %>
                                            {{--73.Vijay nagar 2 soc. Yogichiwk , punagaam, Surat - 395010,Gujarat.--}}
                                        </div>
                                        <div class="user-address">
                                            Phone: <span><% address.Mobile %></span>
                                        </div>
                                        <div class="buttons-set address-btn text-center">
                                            <a ng-click="vm.address=address;vm.saveAddressFn()"
                                               class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag <% address.isDefault ? 'default-btn' : ''%>">
                                                <% address.isDefault ? 'Default' : 'Set As Default' %>
                                            </a>

                                        </div>
                                        <div class="address-footer">
                                            <span data-toggle="modal"
                                                  ng-click="vm.editFn(address)"
                                                  data-target="#add-address"><i
                                                        class="fa fa-edit"></i>Edit</span>

                                            <confirm-delete
                                                    message="Are you sure want to delete this Address ?"
                                                    description="<% address.FirstName + ' ' + address.LastName%>"
                                                    uib-data-toggle="tooltip"
                                                    uib-tooltip="Delete"
                                                    visible="showModal"
                                                    confirm-delete-fn="vm.deleteAddressFn(address.id)"
                                                    cancel-delete-fn="">
                                            </confirm-delete>


                                            <span ng-click="showModal=!showModal;"><i
                                                        class="fa fa-trash"></i>Delete</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="address-hight card">
                                        <div class="buttons-set address-btn text-center add_new">
                                            <a data-toggle="modal" data-target="#add-address"
                                               class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag">
                                                Add new Address
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{--Address modal--}}
        @include('templates.user.address')
    </div>


@endsection