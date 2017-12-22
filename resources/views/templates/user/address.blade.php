<div class="modal fade" id="add-address" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" ng-click="vm.editFn()"></button>
                <h2 class="modal-title" id="myModalLabel">
                    <% vm.address.id ? 'Edit' : 'Add a new'%> address
                </h2>
            </div>
            <div id="" class="modal-body">
                <div class="fd-fieldcontainer">
                    <form name="form" ng-submit="vm.saveAddressFn()" class="fd-rg-fields js_fd-validate"
                          autocomplete="off">
                        <div class="row">

                            <div class="col-md-6">
                                <label class="fake-input">
                                    <span class="fake-placeholder fastTransition fadeIn">
                                        First Name
                                        <span class="error"
                                              ng-show="form.first_name.$error.required"
                                              style="color:RED">*</span>
                                        <span class="valid" ng-show="form.first_name.$valid"
                                              style="color:#31B404">*</span>

                                    </span>
                                    <input type="text" name="first_name"
                                           ng-model="vm.address.FirstName"
                                           class="fd-visible" required>
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label class="fake-input">
                                    <span class="fake-placeholder fastTransition fadeIn">
                                        Last Name
                                        <span class="error"
                                              ng-show="form.last_name.$error.required"
                                              style="color:RED">*</span>
                                        <span class="valid" ng-show="form.last_name.$valid"
                                              style="color:#31B404">*</span>
                                    </span>
                                    <input type="text"
                                           ng-model="vm.address.LastName"
                                           name="last_name" class="fd-visible" required>
                                </label>
                            </div>
                        </div>
                        <label class="fake-input col-md-12 padd-0">
                            <span class="fake-placeholder fastTransition fadeIn">
                                Address
                                <span class="error"
                                      ng-show="form.address.$error.required"
                                      style="color:RED">*</span>
                                <span class="valid" ng-show="form.address.$valid"
                                      style="color:#31B404">*</span>
                            </span>
                            <input type="text"
                                   name="address" required
                                   ng-model="vm.address.Address"
                                   class="fd-visible">
                        </label>

                        <div class="row">
                            <div class="col-sm-6">
                                <label class="fake-input">
                                    <span class="fake-placeholder fastTransition fadeIn">
                                        City
                                        <span class="error"
                                              ng-show="form.city.$error.required"
                                              style="color:RED">*</span>
                                        <span class="valid" ng-show="form.city.$valid"
                                              style="color:#31B404">*</span>
                                    </span>
                                    <input type="text" name="city" class="fd-visible"
                                           ng-model="vm.address.City"
                                           required>
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label class="fake-input">
                                    <span class="fake-placeholder fastTransition fadeIn">
                                        State
                                        <span class="error"
                                              ng-show="form.state.$error.required"
                                              style="color:RED">*</span>
                                        <span class="valid" ng-show="form.state.$valid"
                                              style="color:#31B404">*</span>
                                    </span>
                                    <input type="text"
                                           ng-model="vm.address.State"
                                           name="state" class="fd-visible" required>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="fake-input">
                                    <span class="fake-placeholder fastTransition fadeIn">
                                        Country
                                        <span class="error"
                                              ng-show="form.Country.$error.required"
                                              style="color:RED">*</span>
                                        <span class="valid" ng-show="form.Country.$valid"
                                              style="color:#31B404">*</span>
                                    </span>
                                    <input type="text" name="Country"
                                           ng-model="vm.address.Country"
                                           class="fd-visible" required>
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label class="fake-input">
                                    <span class="fake-placeholder fastTransition fadeIn">
                                        Zip Code
                                        <span class="error"
                                              ng-show="form.zip.$error.required"
                                              style="color:RED">*</span>
                                        <span class="valid" ng-show="form.zip.$valid"
                                              style="color:#31B404">*</span>
                                    </span>
                                    <input type="text"
                                           numbers-only
                                           ng-model="vm.address.ZipCode"
                                           name="zip" class="fd-visible" required>
                                </label>
                            </div>
                        </div>
                        <label class="fake-input col-md-12 padd-0">
                            <span class="fake-placeholder fastTransition fadeIn">
                                Mobile
                                <span class="error"
                                      ng-show="form.Mobile.$error.required"
                                      style="color:RED">*</span>
                                <span class="valid" ng-show="form.Mobile.$valid"
                                      style="color:#31B404">*</span>
                            </span>
                            <input type="text"
                                   numbers-only name="Mobile" required
                                   ng-model="vm.address.Mobile"
                                   class="fd-visible">
                        </label>
                        {{--<label for="addressForm.nationality.isocode" class="fake-select">
                            <select ng-model="vm.user.company_type">
                                <option value="">Company Type</option>
                                <option value="1">Wholesaler</option>
                                <option value="2">Retailer</option>
                                <option value="3">Supplier</option>
                                <option value="4">Default</option>
                                <option value="5">Friends</option>
                            </select>
                        </label>--}}

                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <button type="submit"
                                        class="btn btn-lg btn-md btn-sm btn-default fd-rg-btn-login">
                                    <% vm.address.id ? 'Save' : 'Add'%>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>