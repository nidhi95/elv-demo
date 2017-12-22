/**
 * Created by tejaswi.tandel on 10/6/2016.
 */
var Policy = angular.module('Policy', []);
modules.push('Policy');

Policy.controller('PolicyCtrl', function ($scope, commonApiService, $rootScope, $timeout, $window, PolicyService) {
    var vm = this;
    vm.page = 1;
    vm.limit = 10;
    vm.fetching = false;
    vm.disabled = false;
    vm.type = 'gold';
    vm.main_type = 'raw_material';
    vm.shape = 'All';

    $timeout(function () {
        $rootScope.showLoader = false;
        $rootScope.$broadcast('stopLoader');
        if (!$scope.loginUser || $scope.loginUser == null) {
            $window.location.href = '/login';

        }
        //vm.getPolicyDataFn();
    });

    /**
     * Get policy data function
     *
     */
    vm.getPolicyDataFn = function () {
        vm.fetching = true;
        vm.show_loading = true;
        if (vm.type != 'charges') {
            var obj = {
                pagesize: angular.copy(vm.limit),
                currentpage: angular.copy(vm.page)
            };
            if (vm.shape && vm.shape.length) {
                obj.shape = angular.copy(vm.shape);
            } else {
                delete vm.shape;
                delete obj.shape;
            }


            if (vm.search && vm.search.length) {
                obj.searchField = angular.copy(vm.search);
            } else {
                delete vm.search;
                delete obj.searchField;
            }

            if ($scope.loginUser) {
                obj.userid = angular.copy($scope.userId);
            }
            obj.MaterialType = angular.copy(vm.type);
            obj.respondWithShapeData = true

        } else {
            var obj = {};
            obj.userid = angular.copy($scope.userId);
        }
        vm.message = '';

        var req_obj = {
            api: vm.type != 'charges' ? 'getPolicyData' : 'getCharges',
            method: 'post',
            request: angular.copy(obj)
        };
        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {
                console.log(res_data);
                vm.show_loading = false;
                if (res_data.flag) {
                    vm.fetching = false;

                    if (!vm.policy_list || !vm.policy_list.length) {
                        vm.policy_list = (res_data.data) ? angular.copy(res_data.data) : res_data.dataLabour;
                    } else if (vm.type != 'charges') {
                        vm.policy_list = (vm.policy_list).concat(res_data.data);
                    }
                    vm.policyDueDate = (res_data.policyDueDate) ? res_data.policyDueDate : vm.policy_list[0].policyduedate;
                    if (!vm.shapes || !vm.shapes.length) {
                        vm.shapes = angular.copy(res_data.shapeData);
                        if (!vm.shapes) {
                            vm.shapes = [];
                        }
                        vm.shapes.unshift({Shape: 'All'});
                    }
                    //vm.shape = 'All';
                    vm.total_count = res_data.totalItemsCount ? res_data.totalItemsCount : 0;
                    vm.total_pages = Math.ceil(vm.total_count / (vm.limit * 1));
                    vm.fetching = false;
                    if (vm.total_count > 0)
                        vm.page = vm.page + 1;
                } else {
                    console.log('Error', res_data.message);
                    vm.no_data = true;
                    vm.message = res_data.message ? res_data.message : 'No Data Found !';
                    vm.policy_list = [];
                    vm.shapes = [];
                }
            });
    };

    vm.filterFn = function (shape) {
        vm.page = 1;
        vm.policy_list = [];
        vm.fetching = false;
        vm.disabled = false;
        if (!shape) {
            vm.shape = 'All';
        }

        vm.getPolicyDataFn();
    };


});

Policy.service('PolicyService', function () {
    return {};
});