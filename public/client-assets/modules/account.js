/**
 * Created by tejaswi.tandel on 10/14/2016.
 */
var Account = angular.module('Account', []);
modules.push('Account');

Account.controller('AccountCtrl', function ($scope, $timeout, commonApiService) {
    var vm = this;

    $timeout(function () {
        vm.address = {
            userid: $scope.loginUser.userid
        };
        vm.getUserDetailFn();
        $scope.birthDate = undefined;
    });

    /**
     * Update Profile  detail function
     */
    vm.updateProfileFn = function () {
        vm.show_loading = true;
        var obj = angular.copy($scope.loginUser);
        var req_obj = {
            api: 'updateProfile',
            method: 'post',
            request: obj
        };
        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {
                /*console.log(res_data);*/
                vm.show_loading = false;
                if (res_data.flag) {
                    $scope.setFlash('s', 'Profile detail updated successfully!');
                } else {
                    $scope.setFlash('e', res_data.message);
                }

            });
    };

    /**
     * Change Password function
     */
    vm.changePasswordFn = function () {

        var obj = angular.copy(vm.password);
        obj.userid = $scope.loginUser.userid;
        vm.show_loading = true;

        if (!obj.oldPassword) {
            $scope.setFlash('e', 'Please Enter Old Password');
        } else if (!obj.newPassword) {
            $scope.setFlash('e', 'Please Enter New Password');
        } else if (obj && obj.newPassword != vm.confirm_password) {
            $scope.setFlash('e', 'Password did not match !');
        } else {
            var req_obj = {
                api: 'changePassword',
                method: 'post',
                request: obj
            };
            var response = commonApiService
                .commonApi(req_obj)
                .then(function (res_data) {

                    vm.show_loading = false;

                    if (res_data.flag) {
                        delete vm.confirm_password;
                        vm.password = {};
                        $scope.setFlash('s', res_data.message);
                    } else {
                        $scope.setFlash('e', res_data.message);
                    }

                });
        }

    };

    /**
     * Get users detal function
     */
    vm.getUserDetailFn = function () {

        var req_obj = {
            api: 'getUserDetails',
            method: 'post',
            request: {userId: angular.copy($scope.loginUser.userid)}
        };
        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {
                vm.address_book = (res_data.shipmentDetails && res_data.shipmentDetails.length) ? angular.copy(res_data.shipmentDetails) : [];
            });
    };

    /**
     * Add or Update Function to be add or update shipping details
     */
    vm.saveAddressFn = function () {
        var obj = angular.copy(vm.address);
        if (!obj.id) {
            obj.id = '1';
        } else {
            obj.isAddressUpdated = true;
        }
        if (!obj.userid) {
            obj.userid = angular.copy($scope.loginUser.userid);
        }
        var req_obj = {
            api: 'updateOrAddShipmentAddress',
            method: 'post',
            request: obj
        };
        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {
                if (res_data.flag) {
                    vm.address_book = angular.copy(res_data.shipmentDetails);
                    $('span.fadeIn').removeClass('inputEdited');
                    $('#add-address').modal('hide');
                    vm.address = {};
                    $scope.setFlash('s', ( obj.isAddressUpdated ) ? 'Address Saves Successfully !' : 'Address Added Successfully !');
                } else {
                    $scope.setFlash('e', res_data.message);
                }

            });

    };

    /**
     * Edit Address Function
     * @param address
     */
    vm.editFn = function (address) {
        if (address) {
            vm.address = angular.copy(address);
            $('span.fadeIn').addClass('inputEdited');
        } else {
            vm.address = angular.copy(address);
            $('span.fadeIn').removeClass('inputEdited');
        }

    };

    /**
     * Delete Address function
     * @param id (selected id to be delete)
     */
    vm.deleteAddressFn = function (id) {
        var obj = {};

        if (!obj.userid) {
            obj.userid = angular.copy($scope.loginUser.userid);
        }
        obj.id = id;
        var req_obj = {
            api: 'removeShippingAddress',
            method: 'post',
            request: obj
        };
        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {
                if (res_data.flag) {
                    vm.address_book = angular.copy(res_data.shipmentDetails);

                    $scope.setFlash('s', res_data.message);
                } else {
                    $scope.setFlash('e', res_data.message);
                }

            });

    };

});
