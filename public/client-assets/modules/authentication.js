/**
 * Created by User on 9/30/2016.
 */
var Auth = angular.module('Auth', []);
modules.push('Auth');

Auth.controller('AuthCtrl', function (AuthService, $scope, localStorageService, AppService, commonApiService,
                                      encryptDecryptService, $location, CommonFnService, localTimeout) {

    var vm = this;
    vm.login = {};
    vm.user = {};
    vm.showMsg = false;
    vm.show_loading = false;
    console.log('auth');

    vm.searchObj = $location.search();

    if (!vm.searchObj || _.isEmpty(vm.searchObj)) {
        if (location.search != '')
            vm.searchObj = CommonFnService.queryStringToObj(location.search);
    }

    // If already login then redirect to home page
    var tokenEncrypted = localStorageService.get('token');
    if (tokenEncrypted) {
        // $scope.goToFn('/');
    }

    // Do login
    $scope.loginFn = function () {
        vm.show_loading_login = true;
        var obj = {};
        if (vm.login) {
            obj = _.clone(vm.login);
        }
        else {
            obj = {
                userId: "martin432@orail.co.in",
                password: "icpmed"
            };
        }

        AppService
            .loginUser(obj)
            .success(function (res) {

                if (res.flag) {

                    vm.login = {};

                    $scope.loginUser = res.data ? _.first(res.data) : {};
                    $scope.userId = $scope.loginUser ? $scope.loginUser.userid : null;

                    $scope.loginUserShipment = res.shipmentDetails && res.shipmentDetails.length ? res.shipmentDetails : [];

                    var encryptObj = {
                        data: $scope.loginUser.token,
                        localStorage: {keyName: 'token'}
                    };
                    encryptDecryptService.encryption(encryptObj);

                    delete $scope.loginUser.token;
                    localStorageService.set('userData', $scope.loginUser);
                    localStorageService.set('userShipment', $scope.loginUserShipment);

                    // Set local timeout
                    localTimeout.localTimeChk(true);

                    if (vm.searchObj && !_.isEmpty(vm.searchObj)) {
                        var queryStr = $.param(vm.searchObj);
                        $scope.goToFn('/product#?' + queryStr);
                    } else {
                        $scope.goToFn('/dashboard');
                    }
                } else {
                    localStorageService.remove('token');
                    localStorageService.remove('userData');
                    $scope.loginUser = {};
                    $scope.userId = null;
                    console.log('res - err', res);
                    $scope.setFlash('e', res.message);
                }
                vm.show_loading_login = false;
            });
    };

    // Registaration
    vm.registrationFn = function () {
        vm.showMsg = false;
        vm.show_loading_reg = true;
        /*  var req_obj = {
         api: 'webregister',
         method: 'post',
         request: vm.user
         };
         var response = commonApiService
         .commonApi(req_obj)
         .then(function (res_data) {

         console.log('response ', res_data);
         vm.response_data = angular.copy(res_data);
         if (vm.response_data && vm.response_data.no_data) {
         vm.no_data = angular.copy(vm.response_data.no_data);
         } else {
         vm.activities = angular.copy(vm.response_data.list);
         vm.total_count = angular.copy(vm.response_data.count);
         vm.result = vm.response_data.result;
         }
         });*/
        AuthService.registration(vm.user)
            .success(function (res) {
                console.log('res', res);
                vm.showMsg = true;
                if (res.flag) {
                    vm.user = {};
                    $scope.setFlash('s', res.message);
                    // vm.msgClass = 'success';
                    // vm.message = res.message;
                } else {
                    $scope.setFlash('e', res.message);
                    // vm.msgClass = 'danger';
                    // vm.message = res.message;
                }
                vm.show_loading_reg = false;
            })
    };

    // Forgot password
    vm.forgotPasswordFn = function (email) {
        vm.show_loading = true;
        var obj = {
            userId: email
        };
        AuthService
            .forgotPassword(obj)
            .then(function (res) {

                var res = res.data;

                if (res.flag) {
                    email = null;
                    $('#forgot-pwd').modal('hide');
                    $scope.setFlash('s', res.message);
                } else {
                    $scope.setFlash('e', res.message);
                }
                vm.show_loading = false;
            });
    };
});

Auth.service('AuthService', function ($http, API_REQUEST) {

    return {
        registration: function (obj) {
            return $http.post(API_REQUEST.URL + 'webregister', obj);
        },
        forgotPassword: function (obj) {
            return $http.post(API_REQUEST.URL + 'forgotPassword', obj);
        }
    }
});