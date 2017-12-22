/**
 * Created by User on 9/30/2016.
 */

var app = angular.module('appModule');

/**
 * Common request response services
 */
app.service("commonApiService", ['$http', '$q', 'API_REQUEST', 'localStorageService', 'encryptDecryptService', '$window', '$rootScope',
    function ($http, $q, API_REQUEST, localStorageService, encryptDecryptService, $window, $rootScope) {

        var res_obj = {};
        this.commonApi = function (req_obj, res_condition) {

            if (!req_obj.noLoader) {
                $rootScope.showLoader = true;
                $rootScope.$broadcast('startLoader');
            }

            // "device_type": 0
            var api_call = API_REQUEST.URL + '' + req_obj.api;
            var header = {
                headers: {}
            };

            // Set authentication in header
            var decryptionObj = {
                localStorage: {keyName: 'token'}
            };
            var token = encryptDecryptService.decryption(decryptionObj);
            console.log('token', token);
            if (token) {
                header['headers']['Authorization'] = 'Bearer ' + token;
            }
            header['headers']['Accept'] = 'text/html; application/json; charset=utf-8';

            console.log(' req_obj.request', req_obj.request);
            console.log('header', header);

            var deferred = $q.defer();
            var req_second_param = _.clone(req_obj.request);

            // Set header for get method
            if (req_obj.method == 'get') {
                req_second_param = _.clone(header);
                header = {};
            }
            header['noLoader'] = req_obj.noLoader;

            console.log('api_call', api_call);

            return $http[req_obj.method](api_call, req_second_param, header)
                .then(function (response) {

                    console.log('response', response);

                    var res = response.data;
                    // Promise is fulfilled
                    if (res.flag) {

                        if (res.data && res.data.list) {
                            _.each(res.data.list, function (re) {
                                // set date to timestamp
                                if (res_condition && !_.isEmpty(res_condition)) {
                                    if (res_condition.date_keys && res_condition.date_keys.length) {
                                        _.each(res_condition.date_keys, function (rc) {
                                            if (re[rc] && _.isObject(re[rc])) {
                                                re[rc] = moment(re[rc].sec * 1000).valueOf();
                                            } else {
                                                re[rc] = moment(re[rc]).valueOf();
                                            }
                                        });
                                    }
                                }
                                //conver key [] to array object
                                // eg mobile : ['214324324','324234342'] -> [{key : '214324324'},{key : '324234342'}] same for emails
                                if (res_condition && !_.isEmpty(res_condition)) {
                                    if (res_condition.date_keys && res_condition.date_keys.length) {
                                        _.each(res_condition.date_keys, function (rc) {
                                            if (re[rc] && _.isObject(re[rc])) {
                                                re[rc] = moment(re[rc].sec * 1000).valueOf();
                                            } else {
                                                re[rc] = moment(re[rc]).valueOf();
                                            }
                                        });
                                    }

                                    if (res_condition.array_obj_key && res_condition.array_obj_key.length) {
                                        // for create array object of array
                                        _.each(res_condition.array_obj_key, function (cn) {
                                            if (re[cn] && re[cn].length) {
                                                _.each(re[cn], function (recn) {
                                                    if (!re[cn + 's']) {
                                                        re[cn + 's'] = [];
                                                    }
                                                    re[cn + 's'].push({key: recn});
                                                })
                                            }
                                        });


                                    }
                                }


                            });
                            if (req_obj.is_paginate) {
                                if (req_obj.request && (req_obj.request.page || req_obj.request.limit)) {
                                    var from = (req_obj.request.limit * (req_obj.request.page - 1) + 1);
                                    if (req_obj.request.limit > res.data.list.length) {
                                        var to = (req_obj.request.page - 1) * req_obj.request.limit + res.data.list.length;
                                    } else {
                                        var to = (req_obj.request.limit * req_obj.request.page);
                                    }

                                    var total = res.data.count;
                                    res_obj.result = 'Showing ' + from + ' to ' + to + ' of ' + total + ' entries ';
                                } else {
                                    res_obj.result = 'Showing ' + 1 + ' to ' + res.data.count + ' of ' + res.data.count + ' entries ';
                                }
                            }

                        } else {
                            if (!_.isObject(res.data)) {
                                var data = angular.copy(res.data);
                                res = res.data ? {data: angular.copy(res.data)} : angular.copy(res);
                            }

                            // res.message = res.message;
                            // res.flag = res.flag;
                            if (res_condition && !_.isEmpty(res_condition)) {
                                if (res_condition.date_keys && res_condition.date_keys.length) {
                                    _.each(res_condition.date_keys, function (rc) {
                                        if (res.data[rc] && _.isObject(res.data[rc])) {
                                            res.data[rc] = moment(res.data[rc].sec * 1000).valueOf();
                                        } else {
                                            res.data[rc] = moment(res.data[rc]).valueOf();
                                        }
                                    });
                                }
                            }
                        }
                        res_obj = angular.copy(res);
                        res_obj.flag = res.flag;

                    }
                    else {

                        console.log('res.message', res.message);

                        /*if (((res.message).toLowerCase()).indexOf('invalid userid') >= 0) {

                         var tokenData = localStorageService.get('token');
                         if (tokenData) {
                         $window.location.href = '/';
                         }
                         localStorageService.clearAll();

                         /!*if (location.pathname != '/')
                         $window.location.href = '/';*!/
                         } else {*/

                        if (_.isObject(res.data)) {
                            if (res_condition && res_condition.date_keys && res_condition.date_keys.length) {
                                _.each(res_condition.date_keys, function (rc) {
                                    res.data[rc] = moment(res.data[rc]).valueOf();
                                });
                            }
                        } else {
                            var data = res.data;
                            res.data = {data: data};
                        }
                        res_obj.flag = res.flag;
                        res_obj.message = res.message;
                        // }
                    }

                    if (res.code == '1001') {
                        localStorageService.remove('token');
                        localStorageService.remove('userData');
                        // $scope.loginUser = {};
                        // window.location.href = '/';
                    }

                    deferred.resolve(res);
                    // promise is returned
                    return deferred.promise;

                    $rootScope.showLoader = false;
                    $rootScope.$broadcast('stopLoader');

                }, function (response) {
                    var res = response.data;
                    // the following line rejects the promise
                    res_obj.no_data = true;
                    res_obj.error = true;
                    // res_obj.message = res.message;

                    deferred.resolve(res_obj);

                    // deferred.reject(res_obj);
                    // promise is returned
                    return deferred.promise;

                    $rootScope.showLoader = false;
                    $rootScope.$broadcast('stopLoader');

                });

        };

    }])

/**
 * Common Image Upload service
 */
    .service('ImgUploadService', function ($http, $q) {

        var res_obj = {};

        this.ImgUploadApi = function (ele, folder) {
            var deferred = $q.defer();


            if (ele.files[0]) {
                var i = 0;
                var fd = new FormData();


                fd.append('folder', folder);
                _.each(ele.files, function (img) {
                    var img_fd = '';
                    var img_file = img;

                    fd.append('file[]', img_file);
                    i++;
                });


            }
            return $http['post']('/admin/image-upload', fd, {
                transformRequest: angular.identity,
                headers: {
                    'Content-Type': undefined

                }
            }).then(function (response) {

                var res = response.data;
                if (res.flag) {
                    res_obj = res.data;
                } else {
                    res_obj = res;
                }
                deferred.resolve(res_obj);
                // promise is returned
                return deferred.promise;

            }, function (response) {
                var res = response.data;
                // the following line rejects the promise
                res_obj.no_data = true;
                res_obj.error = true;
                res_obj.message = res.message;

                deferred.resolve(res_obj);

                // deferred.reject(res_obj);
                // promise is returned
                return deferred.promise;
            });


        }
    })

    .service('encryptDecryptService', ['localStorageService', function (localStorageService) {
        return {
            /**
             * To encrypt any data
             * @param req_data  Object  {
             *                              data*: Required: <data to be encrypted>,
             *                              localStorage : {keyName: <kay name by which data store in local storage}
             *                          }
             * @returns {*} encryptedData
             */
            encryption: function (req_data) {

                // var encryptedData = CryptoJS.AES.encrypt(req_data.data, "PalakDesign").toString();
                var encryptedData = CryptoJS.AES.encrypt(JSON.stringify(req_data.data), "PalakDesign").toString();

                if (req_data.localStorage) {
                    localStorageService.set(req_data.localStorage.keyName, encryptedData);
                }

                return encryptedData;
            },

            /**
             * To encrypt any data
             * @param req_data  Object  {
             *                              data: <data to be decrypted>,
             *                              OR
             *                              localStorage : {keyName: <kay name of local storage}
             *                          }
             * @returns {*} encryptedData
             */
            decryption: function (req_data) {

                var encData;
                if (req_data.data) {
                    encData = req_data.data;
                }
                else if (req_data.localStorage) {
                    encData = req_data.localStorage.keyName;
                    encData = localStorageService.get(encData);
                }

                if (encData) {
                    var decrypted = CryptoJS.AES.decrypt(encData, "PalakDesign");
                    var originalData = decrypted.toString(CryptoJS.enc.Utf8);
                    return JSON.parse(originalData);
                } else {
                    return null;
                }
            }
        }
    }])

    .service('localTimeout', ['localStorageService', '$window', function (localStorageService, $window) {

        return {
            /**
             * Check localTime for Login
             * @param newLogin => Boolean => true : New login
             */
            localTimeChk: function (newLogin) {
                var hours = 24; // Reset when storage is more than 24hours -- LIVE
                // var minute = 2; // Reset when storage is more than 24hours -- LOCAL TESTING
                var now = new Date().getTime();
                var setupTime = localStorageService.get('setupTime');

                if (setupTime == null || newLogin) {
                    localStorageService.set('setupTime', now);
                } else {
                    if (now - setupTime > hours * 60 * 60 * 1000) {             // LIVE
                        // if (now - setupTime > minute * 60 * 1000) {              // LOCAL TESTING
                        // localStorageService.clear();

                        localStorageService.remove('token');
                        localStorageService.remove('userData');
                        localStorageService.remove('userShipment');

                        window.localStorage.clear();

                        localStorageService.set('setupTime', now);
                        $window.location.href = '/';
                    }
                    else {
                        // Update current time on page refresh
                        localStorageService.set('setupTime', now);
                    }
                }
            }
        }
    }])

    .service('CommonFnService', function () {
        return {
            queryStringToObj: function (str) {

                return (str).replace(/(^\?)/, '').split("&").map(function (n) {
                    return n = n.split("="), this[n[0]] = n[1], this
                }.bind({}))[0];
            }
        };
    })
;
