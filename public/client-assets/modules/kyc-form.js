/**
 * Created by tejaswi.tandel on 8/3/2017.
 */
var Kyc = angular.module('Kyc', ['ngIntlTelInput']);
modules.push('Kyc');

Kyc.controller('KycCtrl', function ($scope, KycService, $interval, $timeout, UtilService) {
    var vm = this;
    vm.steps = ['first', 'middle', 'third', 'final']
    vm.kyc = {};
    $scope.email_pattern = /^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/; //pattern for email validation
    vm.address_length = 4; // for line1,city,state,pincode (common for all)
    /**
     * Form wise validation keys
     * @type {{first: string[], middle: string[], final: string[]}}
     */
    var formStep = {
        first: ['companyType', 'companyName', 'address', 'companyEmail', 'companyMobile', 'companyGstin', 'companyPAN'],
        middle: ['name', 'mobile', 'email'],
        final: ['shippingAddress', 'shippingMobile'],

    };

    /**
     * Validation for next button disabled / enable
     */
    $interval(function () {
        _.each(formStep, function (val, key) {
            if (key == vm.stepPosition) {
                //selected step
                var current_set_ele = _.keys(vm.kyc);
                if (vm.stepPosition == (_.first(vm.steps))) {
                    var address_fields = _.keys(vm.kyc.address);
                    var is_valid_address = _.isEqual(address_fields.length, vm.address_length);
                } else if (vm.stepPosition == (_.last(vm.steps))) {
                    var address_fields = _.keys(vm.kyc.shippingAddress);
                    var is_valid_address = _.isEqual(address_fields.length, vm.address_length);
                } else {
                    var is_valid_address = true
                }
                var all_keys = _.intersection(val, current_set_ele);
//validation key are validated?

                if (_.isEqual(val.length, all_keys.length) && is_valid_address) {
                    angular.element(".sw-btn-next").removeClass('disabled');
                    angular.element(".sw-btn-next").removeAttr('disabled');
                    if (vm.stepPosition == (_.last(vm.steps))) {
                        vm.is_valid_form = true;
                    }
                } else {
                    vm.is_valid_form = false;
                }
            }
        });
    }, 200);

    /**
     * tab change function
     */
    $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection, stepPosition) {
        //selected step
        vm.stepPosition = angular.copy(stepPosition);
    });

    /**
     * Submit Button Click Event
     */
    setTimeout(function () {
        $('.sw-btn-next').click(function (e) {
            if (vm.stepPosition == (_.last(vm.steps))) {
                if (vm.is_valid_form) {
                    vm.submitKycFormFn();
                }
            }
        });
    }, 1000);

    /**
     * Submit Kyc Form
     */
    vm.submitKycFormFn = function () {
        var obj = angular.copy(vm.kyc);
        window.scrollTo(0, 20);

       /** if(obj.companyMobile){
            var companyMobile = UtilService.getCountryWithMobile([{mobile: obj.companyMobile}]);
            if(companyMobile && companyMobile.length){
                companyMobile = _.first(companyMobile);
                obj.companyCountryCode = companyMobile.country_code;
            }
        }
        if(obj.mobile){
            var mobile = UtilService.getCountryWithMobile([{mobile: obj.mobile}]);
            if(mobile && mobile.length){
                mobile = _.first(mobile);
                obj.country_code = mobile.country_code;
            }
        } **/

        KycService.submitKycForm(obj).success(function (res) {
            window.scrollTo(0, 20);
            if (res.flag) {
                vm.kyc = {};
                $scope.setFlash('s', res.message);
                // Smart Wizard
                $('label.fake-input').removeClass('fieldWriting');
                $('span.fake-placeholder.fastTransition.fadeIn').removeClass('inputEdited');
                $('#smartwizard').smartWizard("reset");

            } else {
                $scope.setFlash('e', res.message);
            }
        });
    };

    vm.geoIpLookup = function () {
        $.get("https://ipinfo.io", function () {
        }, "jsonp").always(function (resp) {
            var countryCode = (resp && resp.country) ? resp.country : "";
            console.log(countryCode)
        });
    };


});

Kyc.service('KycService', function ($http, ELVEE_ADMIN) {
    return {
        submitKycForm: function (obj) {
            return $http.post(ELVEE_ADMIN.URL + 'customer/user/kyc-details', obj);
        }
    };
});