/**
 * Created by User on 4/17/2017.
 */
var contact = angular.module('Contact', []);
modules.push('Contact');

contact.controller('ContactCtrl', function ($scope, ContactService) {
    var vm = this;
    vm.contactLoading = false;
    vm.contact = {};

    vm.sendContactMailFn = function () {

        vm.contactLoading = true;

        ContactService
            .sendContact(vm.contact)
            .success(function (res) {

                if (res.flag) {
                    vm.contact = {};
                    $scope.setFlash('s', res.message);
                } else {
                    $scope.setFlash('e', res.message);
                }
                vm.contactLoading = false;
            });
    };
});

contact.service('ContactService', function ($http, ELVEE_ADMIN) {
    return {
        sendContact: function (obj) {
            return $http.post(ELVEE_ADMIN.URL + 'api/v1/contact/mail-send', obj);
        }
    }
});