/**
 * Created by tejaswi.tandel on 10/14/2016.
 */
var Checkout = angular.module('Checkout', []);
modules.push('Checkout');

Checkout.controller('CheckoutCtrl', function (commonApiService,$window, $timeout, $scope, CheckoutService) {
    var vm = this;
    vm.address = {};
    $timeout(function () {
        vm.getUserDetailFn();
    });

    /**
     * Get users detal function
     */
    vm.getUserDetailFn = function () {
        vm.show_loading = true;
        var req_obj = {
            api: 'getUserDetails',
            method: 'post',
            request: {userId: angular.copy($scope.loginUser.userid)}
        };
        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {
                vm.show_loading = false;
                vm.address_book = (res_data.shipmentDetails && res_data.shipmentDetails.length) ? angular.copy(res_data.shipmentDetails) : [];
                if (!vm.address_book || !vm.address_book.length) {
                    $scope.setFlash('e', 'No address added !')
                }
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
                    $('#add-address').modal('hide');
                    vm.address = {};
                    $scope.setFlash('s', ( obj.isAddressUpdated ) ? 'Address Saves Successfully !' : 'Address Added Successfully !');
                } else {
                    $scope.setFlash('e', res_data.message);
                }

            });

    };
    /**
     * Delete address
     * @param id (selected delete id to be delete)
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

    /**
     * Edit Address Function
     * @param address
     */
    vm.editFn = function (address) {
        vm.address = angular.copy(address);
        $('span.fadeIn').addClass('inputEdited');
        console.log(vm.address);
    };

    /**
     * Seletced address id
     * @param address_id
     */
    vm.placeOrderFn = function (address_id) {
        var obj = {
            userId: angular.copy($scope.loginUser.userid),
            PaymentMethod: "Cash on delivery",
            shippingaddressId: address_id
        };

        var req_obj = {
            api: 'CheckOut',
            method: 'post',
            request: obj
        };
        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {
                if (res_data.flag) {
                    $scope.setFlash('s', res_data.message);
                    $window.location.href = '/acknowledgement?'+res_data.ordernumber;
                } else {
                    $scope.setFlash('e', res_data.message);
                }

            });


    };

});


Checkout.service('CheckoutService', function () {
    return {};
});