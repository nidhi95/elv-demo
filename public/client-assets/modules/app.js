/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var modules = ['Constants',
    'tagged.directives.infiniteScroll',
    // 'angularjs-crypto',
    'LocalStorageModule',
    'ImgCache',
    'toaster',
    'ui.select2', 'ui.select', 'ngSanitize'
];
// var modules = [];

var app = angular.module('appModule', modules);

app.factory('httpInterceptor', function ($q, $rootScope, $window, $log) {

    return {
        request: function (config) {
            // config.noLoader = true
            if (!$rootScope.isAjax && !config.noLoader) {
                $rootScope.showLoader = true;
                $rootScope.$broadcast('startLoader');
            }

            return config || $q.when(config);
        },
        response: function (response) {


            if (response || $q.when(response)) {

                if (response.data.code == 0) {
                }

                $rootScope.showLoader = false;
                $rootScope.$broadcast('stopLoader');
                return response || $q.when(response);

            }

        },
        responseError: function (response) {

            $rootScope.showLoader = false;
            $rootScope.$broadcast('stopLoader');
            return $q.reject(response);
        }
    };
});

app.run(function (ImgCache, $rootScope) {

    ImgCache.$init();
    $rootScope._ = _;

});
/*app.run(function ($rootScope, $location) {
 //Bind the `$locationChangeSuccess` event on the rootScope, so that we dont need to
 //bind in induvidual controllers.

 /!*  $(window).on('hashchange', function () {
 location.hash = "noBack";
 console.log('chng')
 });
 *!/
 $rootScope.$on('$locationChangeSuccess', function () {
 $rootScope.actualLocation = $location.path();

 });

 $rootScope.$watch(function () {
 return $location.path()
 }, function (newLocation, oldLocation) {

 console.log('newLocation', newLocation);
 console.log('oldLocation', oldLocation);

 if ($rootScope.actualLocation === newLocation) {
 //alert('Why did you use history back?');
 window.location.reload();
 }
 });
 });*/

app.config(function ($interpolateProvider, $locationProvider, $httpProvider, localStorageServiceProvider, ImgCacheProvider) {

    $httpProvider.interceptors.push('httpInterceptor');
    // $locationProvider.html5Mode(true);
    // $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
    // $httpProvider.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
    // $httpProvider.defaults.headers.common['Access-Control-Allow-Headers'] = '*';

    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');

    localStorageServiceProvider.setPrefix('pd'); // Palak Design
    // vcRecaptchaServiceProvider.setOnLoadFunctionName('myCaptcha');

    // Image cache
    ImgCacheProvider.setOptions({
        debug: true,
        usePersistentCache: true
    });
    ImgCacheProvider.manualInit = true;

    /* $locationProvider.html5Mode({
     enabled: true,
     requireBase: false
     });*/
});

app.controller('appController', function ($scope, $window, staticImgUrl, AppService, $rootScope, $location, $timeout,
                                          localStorageService, commonApiService, CommonFnService, localTimeout, toaster,
                                          encryptDecryptService, $filter, ELVEE_ADMIN) {
    var vm = this;

    $scope.globalSearch = null;
    $scope.categoryListMaster = [];
    $scope.flashMsgShow = false;
    $scope.flashMessage = null;
    vm.searchResultlist = [];

    // vm.my_captcha = "6LdDMiQTAAAAAIDNkWGozKZ2UIHYvfJ1udWwL2tf";
    $rootScope.$broadcast('startLoader');
    vm.static_url = staticImgUrl.url;
    vm.cart = [];
    vm.collections = []; // collection list

    /**
     * Get Query string
     */
    var searchObj = $location.search();
    // jQuery query string read
    if (!searchObj || _.isEmpty(searchObj)) {
        if (!_.isEmpty(location.search))
            searchObj = CommonFnService.queryStringToObj(location.search);
    }

    // Default header content show [For product pade (Filter content should be there)]
    if ((location.href).indexOf('/product') >= 0) {
        $rootScope.headerView = false;
    } else {
        $rootScope.headerView = true;
    }


    $timeout(function () {
        // Set active class in current open page link
        var current_page = ((location.href).split('/')).pop();
        current_page = current_page ? current_page.replace(/[^a-zA-Z\- ]/g, "") : '';
        if (current_page && _.isEmpty(searchObj)) {
            $('#' + current_page).addClass('is-active-menu');
        } else {
            $('#home').addClass('is-active-menu');
        }
    }, 500);


    // User detail form local storage
    $scope.loginUser = localStorageService.get('userData');
    $scope.userId = $scope.loginUser ? $scope.loginUser.userid : null;

    $scope.logoutFn = function () {
        AppService
            .logout({userId: $scope.userId})
            .success(function (res) {

                //if (res.flag) {
                localStorageService.remove('token');
                localStorageService.remove('userData');
                localStorageService.remove('userShipment');
                delete $scope.loginUser;
                delete $scope.userId;

                window.localStorage.clear();

                $scope.goToFn('/');
                //}
            })
    };

    /**
     * SEO
     */
    $scope.seo = {
        title: 'Palak Design',
        keywords: 'Palak Design',
        desc: 'Palak Design'
    };

    // $scope.basicSeoImage = 'https://www.bitcocept.com/client-assets/img/logo.png';

    // $scope.seo_og = {
    //     siteName: 'BitcoCept',
    //     image: 'https://www.bitcocept.com/client-assets/img/logo.png',
    //     'url': location.href,
    //     type: 'article'
    // };
    $scope.subscriberFn = function (email) {

        if (email) {

            AppService.subscribeUser({email: email}).success(function (res) {

                if (res.flag) {
                    $scope.subscribe_email = '';
                    $scope.setFlash('s', res.message);
                } else {
                    $scope.setFlash('e', res.message);
                }

            });

        } else {
            $scope.setFlash('e', 'Please enter subscriber email id');
        }

    };

    /**
     * Category listing -- BEGIN
     */
    $scope.categoryListMaster = localStorageService.get('filterData');

    console.log('filterList', $scope.categoryListMaster);

    $scope.setCategoryListRequestKey = function (categoryList) {
        // To set request key for each name
        _.each(categoryList, function (cat) {

            if (cat.name == 'CATEGORY') {
                cat['reqKey'] = 'categoryid';
                cat['sequence'] = 3;
            } else if (cat.name == 'PRODUCT TYPE') {
                cat['reqKey'] = 'producttypeid';
                cat['sequence'] = 8;
            } else if (cat.name == 'THEME') {
                cat['reqKey'] = 'themeid';
                cat['sequence'] = 7;
            } else if (cat.name == 'GENDER') {
                cat['reqKey'] = 'genderid';
                cat['sequence'] = 2;
            } else if (cat.name == 'OCASSION') {
                cat['reqKey'] = 'occasionid';
                cat['sequence'] = 5;
            } else if (cat.name == 'STYLE') {
                cat['reqKey'] = 'styleid';
                cat['sequence'] = 6;
            } else if (cat.name == 'COLLECTION') {
                cat['reqKey'] = 'collectionid';
                cat['sequence'] = 4;
            } else if (cat.name == 'NEW ARRIVAL') {
                cat['reqKey'] = 'newarrivalid';
                cat['sequence'] = 1;
            }
        });
    };

    if ($scope.userId && (!$scope.categoryListMaster || $scope.categoryListMaster.length <= 1)) {
        var req_obj = {
            // api: 'product/list/with-side-menu',
            api: 'webgetSideMenuCategory',
            method: 'post',
            request: {
                "userid": $scope.userId,
                "pagesize": "20",
                "currentpage": "1",
                "respondWithCategory": true
            }
        };
        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {

                // if (res_data.flag) {
                $scope.categoryListMaster = res_data.data ? res_data.data.categories : [];

                $scope.setCategoryListRequestKey($scope.categoryListMaster);

                var categories = _.findWhere($scope.categoryListMaster, {name: 'CATEGORY'});
                $scope.categories = categories ? categories['sub-categories'] : [];

                var searchObj = $location.search();
                // jQuery query string read
                if (!searchObj || _.isEmpty(searchObj)) {
                    searchObj = CommonFnService.queryStringToObj(location.search);
                }
                console.log('vm.searchObj - app', searchObj);
                /*if (searchObj && !_.isEmpty(searchObj)) {

                 _.each(searchObj, function (val, key) {

                 var category_index = _.indexOf(_.pluck($scope.categoryListMaster, 'reqKey'), key);
                 var category = $scope.categoryListMaster[category_index];
                 if (val == 'all') {
                 category['include_all'] = true;
                 }
                 _.each(category && category['sub-categories'], function (subCat) {
                 if (val == 'all') {
                 subCat['checked'] = true;
                 } else if (subCat.name == val) {
                 subCat['checked'] = true;
                 }
                 });
                 });
                 }*/
                $scope.categoryListMaster = $filter('orderBy')($scope.categoryListMaster, 'sequence');
                localStorageService.set('filterData', $scope.categoryListMaster);
                /*} else {
                 console.log('Error', res_data.message);
                 }*/
            });
    }
    // Category list -- END

    // Global search -- BEGIN
    $scope.globalSearchFn = function (search) {

        if (search) {
            vm.searchResultlist = [];
            vm.searchResultlist.push('Loading..');
            $scope.searchLoading = true;
            var req_obj = {
                api: 'websearchSuggestion',
                method: 'post',
                request: {
                    "userId": $scope.userId,
                    "keyword": search,
                    "pagesize": 20
                },
                noLoader: true
            };

            var response = commonApiService
                .commonApi(req_obj)
                .then(function (res_data) {

                    console.log('res_data', res_data);
                    if (res_data.flag) {

                        vm.searchResultlist = res_data.data;
                        /*var url_index = (location.href).indexOf('product');
                         if (url_index < 0) {
                         $scope.goToFn('/product#?keyword=' + search);
                         } else {
                         $location.search('keyword', search);
                         location.reload();
                         }*/
                    } else {
                        vm.searchResultlist = [];
                        // $scope.setFlash('e', res_data.message);
                    }
                    $scope.searchLoading = false;
                });
        }
    };
    // Global search -- END

    // Cart- Wishlist count
    $scope.getCountFn = function () {

        var req_obj = {
            api: 'getUserDataCounts?userid=' + ($scope.userId ? $scope.userId : ''),
            method: 'get'
        };

        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {
                $rootScope.cartCount = res_data.cartCount ? res_data.cartCount : 0;
                $rootScope.wishListCount = res_data.wishList ? res_data.wishList : 0;

            });
    };
    $scope.getCountFn();

    /**
     * Go to page
     * @param url
     */
    $scope.goToFn = function (url) {
        $window.location.href = url;
    };

    /**
     * Notification flash function
     */
    $scope.setFlash = function (status, message) {

        $scope.flashMsgShow = false;
        $scope.flashMessage = null;

        var msgClass;
        switch (status) {
            case 's':
                msgClass = 'success';
                break;

            case 'e':
                msgClass = 'error';
                break;

            case 'w':
                msgClass = 'warning';
                break;
        }

        toaster.pop(msgClass, message, '');

        /*$scope.flashMsgShow = true;
         $scope.flashMessage = message;
         $scope.flashMessageClass = 'user-alert alert danger alert-' + msgClass;*/
    };

    // Local storage TIMEOUT
    localTimeout.localTimeChk();

    // Prototype
    String.prototype.capitalizeFirstLetter = function () {
        return this.charAt(0).toUpperCase() + this.slice(1);
    };

    // Product Detail
    $scope.productDetailViewFn = function (designNo) {
        //redirect to product search page
        $window.location.href = "/search/product?" + designNo;
    };

    // News Letter subscription
    vm.newsLetterSubscription = function (email) {
        vm.show_loading_subscribe = true;

        var obj = {
            first_name: '',
            last_name: '',
            mobile: '',
            userid: email
        };

        AppService.registration(obj)
            .success(function (res) {

                if (res.flag) {
                    email = '';
                    $scope.setFlash('s', res.message);
                    // vm.msgClass = 'success';
                    // vm.message = res.message;
                } else {
                    $scope.setFlash('e', res.message);
                    // vm.msgClass = 'danger';
                    // vm.message = res.message;
                }
                vm.show_loading_subscribe = false;
            })
    };

    vm.imgFrom = ELVEE_ADMIN.URL;
    /**
     * Get Collection List
     */
    vm.collectionListFn = function () {
        AppService.collectionList().success(function (res) {
            if (res.flag) {
                vm.collections = res.data.list;
                _.each(vm.collections, function (collect) {
                    collect.prefix_by = vm.imgFrom;

                });
                var current_page = ((location.href).split('/')).pop();
                current_page = current_page ? current_page.replace(/[^a-zA-Z\- ]/g, "") : '';


            } else {
                vm.collections = [];
            }
        });
    };
    vm.collectionListFn();
});

app.filter('addDays', function () {
    return function (input) {

        if (input) {
            var totalDays = input;
            var inputs = _.range(1, (input + 1));
            _.each(inputs, function (i) {

                if (moment().add(i, 'day').day() == 0) {
                    totalDays++;
                }
                /*
                 days = moment().add((i + 1), 'day').format('DD-MMM-YYYY');
                 var sunday = moment(days).day();
                 console.log('sunday', sunday)
                 if (sunday == 0) {
                 days = moment().add((i + 2), 'day').format('DD-MMM-YYYY');
                 }*/
            })

            var expected_date = moment().add(totalDays, 'day').format('DD-MMM-YYYY');
            return expected_date;
        } else
            return '';
    };
});

app.filter('trustAsHtml', function ($sce) {
    return $sce.trustAsHtml;
});

app.service('AppService', function ($http, API_REQUEST, ELVEE_ADMIN) {

    return {
        loginUser: function (obj) {
            // , {noLoader: true}
            return $http.post(API_REQUEST.URL + '/webLogin', obj);
        },
        logout: function (obj) {
            return $http.post(API_REQUEST.URL + 'webLogOut', obj);
        },
        registration: function (obj) {
            return $http.post(API_REQUEST.URL + 'webregister', obj);
        },
        collectionList: function (obj) {
            return $http.post(ELVEE_ADMIN.URL + 'customer/collection/paginate', obj);
        }
    };
});

// Util services
app.service('UtilService', function () {

    return {
        /**
         * Get Country Code Function
         * @param mobile
         * @param primary_key
         * @returns {Array}
         */
        getCountryWithMobile: function (mobile, primary_key) {
            if (mobile && mobile.length) {
                var mobiles = [];
                _.each(mobile, function (mb, mb_index) {
                    if (mb && mb.mobile) {
                        var obj = {};
                        if (mb && mb_index == primary_key) {
                            obj.is_primary = true;
                        }
                        var a = '';
                        var a = mb.phoneNumberCtrl.getSelectedCountryData();
                        obj.mobile = mb.phoneNumberCtrl.getNumber(intlTelInputUtils.numberFormat.NATIONAL);
                        if (a && a.dialCode) {
                            obj.country_code = a.dialCode;
                            mobiles.push(obj);
                        }
                    }
                });
                return mobiles;
            }
        }
    }
});

app.filter('truncate', function () {
    return function (text, length) {

        if (text) {
            if (text.length > length) {
                return text.substr(0, length) + "  ...";
            }
            return text;
        }
    }
});
/**
 * Allows you to enter only number
 */
app.directive('numbersOnly', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                text = element[0].value;
                if (text) {

                    var transformedInput = (text).replace(/[^0-9]/g, '');

                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    var transformed_Input = parseFloat(transformedInput);
                    return transformed_Input;
                }
                return undefined;
            }

            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});
app.filter('checkedshow', function () {
    return function (arrayData) {

        if (arrayData && arrayData.length) {

            var checkedData = _.findWhere(arrayData, {checked: true});
            if (checkedData) {
                return checkedData.name;
            } else {
                return '';
            }

        } else {
            return '';
        }
    }
});

app.directive("uiselectAutofocus", function ($timeout) {
    return {
        restrict: 'A',
        require: 'uiSelect',
        link: function (scope, elem, attr) {
            $timeout(function () {
                var input = elem.find('input');

                if (attr.uiselectAutofocus == 'open')
                    input.click();

                input.focus()
            }, 0);
        }
    }
});
