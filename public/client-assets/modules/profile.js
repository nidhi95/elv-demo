/**
 * Created by tejaswi.tandel on 10/6/2016.
 */
var Profile = angular.module('Profile', ['ui.bootstrap']);
modules.push('Profile');

Profile.controller('ProfileCtrl', function ($scope, commonApiService, $rootScope, $timeout, $location, $window, ProfileService) {
    var vm = this;
    vm.tab = 'profile';
    vm.page = 1;
    vm.limit = 16;
    vm.accountList = [];
    vm.fetching = false;
    vm.disabled = false;
    vm.minDate = new Date();
    vm.format = 'dd-MMM-yyyy';
    vm.shapes = [];
    vm.list_view = true;

    vm.getTabs = function () {

        ProfileService.tabList().success(function (res) {
            vm.tabs = res;
        });
    };

    $scope.open = function ($event, to, date) {
        $event.preventDefault();
        $event.stopPropagation();

        $scope.opened = true;

    };

    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1,
        class: 'datepicker'
    };

    vm.filter = {
        fromDate: moment().startOf('month').toDate(),
        toDate: moment().toDate(),
        shape: 'All'
    };
    $timeout(function () {
        /*   $rootScope.showLoader = false;
         $rootScope.$broadcast('stopLoader');*/
        vm.getTabs();
        /*    $('.uib-right i').removeClass();
         $('.uib-right i').addClass('fa fa-chevron-right');
         $('.uib-left i').removeClass();
         $('.uib-left i').addClass('fa fa-chevron-left');*/
        $scope.frommonthSelectorOptions = {
            max: new Date(),
            optionLabel: "Item...",
            format: "dd-MMM-yyyy",
            parseFormats: ["DD-MMM-YYYY"]
        };
        $scope.monthSelectorOptions = {
            min: new Date(),
            optionLabel: "Item...",
            format: "dd-MMM-yyyy",
            parseFormats: ["DD-MMM-YYYY"]
        };


        if (!$scope.loginUser || $scope.loginUser == null) {
            $window.location.href = '/login';
        }
    });

    vm.getUserDetailFn = function () {

        var req_obj = {
            api: 'getUserDetails',
            method: 'post',
            request: {userId: angular.copy($scope.loginUser.userid)}
        };
        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {
                console.log(res_data);
                if (res_data.userData) {
                    vm.user_data = angular.copy(res_data.userData);
                } else {
                    vm.user_data = [];
                }
                vm.show_loading = false;

            });
    };
    vm.getUserDetailFn();

    // Tab change API call
    vm.tabChangeFn = function (currTabCls, subTabIndex) {

        vm.accountList = [];
        vm.total_count = 0;
        vm.data_list = [];
        vm.shapes = [];
        vm.shapes.unshift('All');
        vm.status = [];
        vm.status.unshift('All');
        vm.page = 1;
        vm.list_view = true;

        vm.selected_tab = _.pick(vm.tabs, function (value, key, object) {
            if (key == vm.tab)
                return object[vm.tab];
        });

        if (vm.selected_tab) {
            vm.selected_tab = angular.copy(vm.selected_tab[vm.tab]);
            vm.currentTab = angular.copy(vm.selected_tab[vm.tab]);
            console.log(vm.selected_tab);
            if (!vm.sub_tab) {

                vm.sub_tab = vm.selected_tab[0].url ? vm.selected_tab[0].tab : vm.selected_tab[0].sub_tab;
            }

            vm.selected_sub_tab = _.findWhere(vm.selected_tab, {tab: vm.sub_tab});
            if (vm.selected_sub_tab && vm.selected_sub_tab.sub_tab && vm.selected_sub_tab.sub_tab.length) {
                vm.selected_sub_tab = _.findWhere(vm.selected_sub_tab.sub_tab, {tab: vm.sub_of_sub_tab});
            }
            console.log(vm.selected_sub_tab);
            vm.filter.shape = 'All';
            vm.filter.status = 'All';

            // Dynamic active nav-tab
            if (currTabCls && subTabIndex) {
                $('.' + currTabCls + ' > .nav-tabs li:eq(' + subTabIndex + ') a').tab('show')
            }

            vm.getDataListFn();
        }
    };

    // Tab change basic setup
    vm.tabChangeClickFn = function (mainTab, subTab, subSubTab) {
        vm.page = 1;

        if (mainTab)
            vm.tab = mainTab;

        if (subTab)
            vm.sub_tab = subTab;

        if (subSubTab)
            vm.sub_of_sub_tab = subSubTab;

        vm.filter.search = '';
    };

    vm.getDataListFn = function () {
        if(!vm.fetching) {
            vm.fetching = true;
            vm.show_loading = true;

            var obj = {
                pagesize: angular.copy(vm.limit),
                currentpage: angular.copy(vm.page)
            };
            vm.message = '';
            if (vm.filter && !_.isEmpty(vm.filter)) {
                if (vm.selected_sub_tab && vm.selected_sub_tab.filter && vm.selected_sub_tab.filter.date) {
                    if (vm.filter.fromDate) {
                        obj.fromDate = moment(vm.filter.fromDate).startOf('day').format('DD MMM YYYY');
                    } else {
                        delete obj.fromDate
                    }
                    if (vm.filter.toDate) {
                        obj.toDate = moment(vm.filter.toDate).endOf('day').format('DD MMM YYYY');
                    } else {
                        delete obj.toDate;
                    }
                }
                if (vm.selected_sub_tab && vm.selected_sub_tab.filter && vm.selected_sub_tab.filter.search) {
                    if (vm.filter.search && vm.filter.search.length) {

                        if (vm.selected_sub_tab.url == 'getQuotes') {
                            obj.qtno = angular.copy(vm.filter.search);
                            obj.searchField = '';
                        }
                        else {
                            obj.searchField = angular.copy(vm.filter.search);
                        }
                    } else {
                        delete obj.searchField;
                        delete vm.filter.search;
                    }
                }
                if (vm.selected_sub_tab && vm.selected_sub_tab.filter && vm.selected_sub_tab.filter.status) {
                    if (vm.filter.status && vm.filter.status.length) {
                        obj.statusfilter = angular.copy(vm.filter.status);
                    } else {
                        delete obj.statusfilter;
                        delete vm.filter.status;
                    }
                }

                if (vm.selected_sub_tab && vm.selected_sub_tab.filter && vm.selected_sub_tab.filter.shape && vm.filter.shape) {
                    obj.Shape = angular.copy(vm.filter.shape);
                } else {
                    delete vm.filter.shape;
                    delete obj.Shape;
                }
            }

            if ($scope.userId) {
                obj.userid = angular.copy($scope.userId);
            }

            if (vm.tab == 'raw_material_stock') {
                obj['type'] = (vm.sub_tab).capitalizeFirstLetter();
                obj['sub_type'] = (vm.sub_of_sub_tab);
            }

            if (vm.selected_sub_tab.requestParams && !_.isEmpty(vm.selected_sub_tab.requestParams)) {
                _.each(vm.selected_sub_tab.requestParams, function (val, key) {
                    obj[key] = val;
                })
            }

            var req_obj = {
                api: vm.selected_sub_tab.url,
                method: 'post',
                request: angular.copy(obj)
            };
            var response = commonApiService
                .commonApi(req_obj)
                .then(function (res_data) {

                    console.log(res_data, req_obj);

                    vm.show_loading = false;
                    vm.fetching = false;
                    if (vm.page == 1) {
                        vm.data_list = [];
                        vm.total_count = 0;
                    }

                    if (res_data.flag) {
                        vm.count = angular.copy(res_data);
                        var get_res_data = [];
                        if (res_data.data && res_data.data.length) {
                            _.each(res_data.data, function (d) {
                                var data = {};
                                _.each(d, function (val, key) {
                                    var new_key = angular.copy(key.replace(/ /g, ''));
                                    new_key = angular.copy(new_key.replace(/#/g, ''));
                                    data[new_key] = val;
                                });
                                get_res_data.push(data);

                            });
                        }
                        if (!vm.data_list || !vm.data_list.length) {
                            vm.data_list = (get_res_data) ? angular.copy(get_res_data) : res_data.dataLabour;
                        } else {
                            vm.data_list = (vm.data_list).concat(get_res_data);
                        }
                        vm.accountList = angular.copy(vm.data_list);

                        if (vm.sub_tab && vm.sub_tab == 'ledger') {
                            if (vm.accountList && vm.accountList.length) {
                                var account_new = [];
                                var allDates = _.uniq(_.without(_.pluck(vm.accountList, 'date'), undefined, null));
                                _.each(allDates, function (d) {
                                    // if (d) {
                                    var this_date_data = _.where(vm.accountList, {date: d});
                                    if (this_date_data && this_date_data.length) {
                                        var credit_data = _.where(this_date_data, {transaction: 'credit'});
                                        var debit_data = _.where(this_date_data, {transaction: 'debit'});

                                        var range_of_date = _.range(_.max([credit_data.length, debit_data.length]));
                                        if (range_of_date) {
                                            _.each(range_of_date, function (r) {
                                                var data =
                                                    {
                                                        credit: angular.copy(credit_data[r]),
                                                        debit: angular.copy(debit_data[r])
                                                    };
                                                account_new.push(data);
                                            });
                                        }
                                        /* if (credit_data && credit_data.length) {
                                         _.each(credit_data, function (cr) {
                                         data.credit = angular.copy(cr);
                                         });
                                         }
                                         if (debit_data && debit_data.length) {
                                         _.each(debit_data, function (dr) {
                                         data.debit = angular.copy(dr);
                                         });
                                         }*/


                                    }

                                    /*_.each(vm.accountList, function (list) {



                                     /!*  var last_indx = _.findLastIndex(account_new, {date: list.date});

                                     if (last_indx >= 0 && list && account_new && account_new[last_indx] && list.transaction == 'credit' && account_new[last_indx].credit == null) {
                                     account_new[last_indx].credit = {
                                     'date': list.date,
                                     'particular': list.particular,
                                     'voucherno': list.voucherno,
                                     'metal': list.metal,
                                     'diamond': list.diamond,
                                     'amount': list.amount,
                                     'verified': list.verified
                                     }
                                     } else if (last_indx >= 0 && list && account_new && account_new[last_indx] && list.transaction == 'debit' && account_new[last_indx].debit == null) {
                                     account_new[last_indx].debit = {
                                     'date': list.date,
                                     'particular': list.particular,
                                     'voucherno': list.voucherno,
                                     'metal': list.metal,
                                     'diamond': list.diamond,
                                     'amount': list.amount,
                                     'verified': list.verified
                                     }
                                     } else if (list && list.date && list.date == d && list.transaction == 'credit') {
                                     var data = {
                                     credit: {
                                     'date': list.date,
                                     'particular': list.particular,
                                     'voucherno': list.voucherno,
                                     'metal': list.metal,
                                     'diamond': list.diamond,
                                     'amount': list.amount,
                                     'verified': list.verified,
                                     },
                                     'debit': null,
                                     date: list.date
                                     };
                                     account_new.push(data);
                                     } else if (list && list.date && list.date == d && list.transaction == 'debit') {
                                     var data = {
                                     debit: {
                                     'date': list.date,
                                     'particular': list.particular,
                                     'voucherno': list.voucherno,
                                     'metal': list.metal,
                                     'diamond': list.diamond,
                                     'amount': list.amount,
                                     'verified': list.verified,

                                     },
                                     'credit': null,
                                     date: list.date

                                     };
                                     account_new.push(data);

                                     }
                                     *!/
                                     });*/
                                    // }
                                });

                                vm.ledger_list = angular.copy(account_new);
                                vm.cr_metals = _.reduce(vm.ledger_list, function (num, l) {
                                    var metal = (l.credit && l.credit.metal) ? l.credit.metal : 0;
                                    return (metal * 1) + num;
                                }, 0);
                                vm.cr_diamonds = _.reduce(vm.ledger_list, function (num, l) {
                                    var diamond = (l.credit && l.credit.diamond) ? l.credit.diamond : 0;
                                    return (diamond * 1) + num;
                                }, 0);

                                vm.cr_amount = Math.round(_.reduce(vm.ledger_list, function (num, l) {
                                    var amount = (l.credit && l.credit.amount && l.credit.amount != null) ? l.credit.amount : 0;
                                    return (amount * 1) + num;
                                }, 0));
                                vm.dr_metals = _.reduce(vm.ledger_list, function (num, l) {
                                    var metal = (l.debit && l.debit.metal) ? l.debit.metal : 0;
                                    return (metal * 1) + num;
                                }, 0);
                                vm.dr_diamonds = _.reduce(vm.ledger_list, function (num, l) {
                                    var diamond = (l.debit && l.debit.diamond) ? l.debit.diamond : 0;
                                    return (diamond * 1) + num;
                                }, 0);

                                vm.dr_amount = Math.round(_.reduce(vm.ledger_list, function (num, l) {
                                    var amount = (l.debit && l.debit.amount) ? l.debit.amount : 0;
                                    return (amount * 1) + num;
                                }, 0));

                            }

                        }


                        vm.policyDueDate = (res_data.policyDueDate) ? res_data.policyDueDate : ((vm.data_list && vm.data_list.length) ? (vm.data_list[0].policyduedate) : undefined);
                        var shapes = [];
                        if (res_data.shapeData && res_data.shapeData.length) {
                            shapes = angular.copy(res_data.shapeData);
                        } else {
                            shapes = _.pluck(vm.accountList, 'Shape');
                        }
                        shapes = _.uniq(shapes);
                        if (!vm.temp_shapes) {
                            vm.temp_shapes = _.without(_.uniq(([]).concat(shapes)), null, undefined);
                            vm.temp_shapes.unshift('All');
                        }
                        vm.shapes = angular.copy(vm.temp_shapes);

                        var status = [];
                        status = _.pluck(vm.accountList, 'status');
                        status = _.uniq(status);
                        vm.status = _.uniq((vm.status).concat(status));

                        vm.total_count = res_data.totalItemsCount ? res_data.totalItemsCount : (res_data.totalItemCount ? res_data.totalItemCount : 0);
                        vm.total_pages = Math.ceil(vm.total_count / (vm.limit * 1));
                        vm.fetching = false;
                        if (vm.total_count > 0)
                            vm.page = vm.page + 1;
                    } else {
                        vm.no_data = true;
                        vm.message = res_data.message ? res_data.message : 'No Data Found !';
                        // vm.data_list = [];
                        vm.shapes = [];
                    }
                });
        }
    };

    vm.getDiamondStock = function () {
        var obj = {};
        if ($scope.userId) {
            obj.userid = angular.copy($scope.userId);
        }


        var req_obj = {
            api: 'getTotalDiamondStock',
            method: 'post',
            request: angular.copy(obj)
        };
        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {

                vm.stock_count = (res_data.data && res_data.data.length) ? res_data.data[0] : {};
            });
    };

    vm.filterFn = function () {
        vm.page = 1;

        vm.accountList = [];
        //vm.fetching = false;
        vm.disabled = false;
        vm.data_list = [];
        vm.getDataListFn();
    };


});


Profile.service('ProfileService', function ($http) {
    return {
        tabList: function () {
            return $http.get('/client-assets/profileTab.json');
        }
    };
});