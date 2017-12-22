/**
 * Created by tejaswi.tandel on 10/11/2016.
 */
var Cart = angular.module('Cart', []);
modules.push('Cart');

Cart.controller('CartCtrl', function ($rootScope, $timeout, ProductService, $window, jewelType, $location, commonApiService, $scope, CartService) {
    var vm = this;
    vm.currentOpen;
    vm.selectedProdNo = null;

    vm.cartDetai = {
        "TotalNetWeight": 0,
        "TotalDiamondWeight": 0,
        "TotalGrossWeight": 0
    };

    /**
     * Get Cart list data function
     *
     */
    vm.getCartListFn = function () {

        var obj = {};
        vm.show_loading = true;
        obj.userId = angular.copy($scope.userId);
        vm.message = '';

        var req_obj = {
            api: 'getCartItems?userId=' + ($scope.userId ? $scope.userId : ''),
            method: 'get'
        };
        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {

                vm.show_loading = false;
                if (res_data.flag) {
                    vm.cart = angular.copy(res_data.data);
                    vm.cartRemark = res_data.remark || '';
                    vm.cartDetai = res_data.totalInfo && res_data.totalInfo.length ? _.first(res_data.totalInfo) : {};
                    _.each(vm.cart, function (c) {
                        c.qty = parseInt(c.qty || 1);
                    });
                } else {
                    console.log('Error', res_data.message);
                    vm.no_data = true;
                    vm.message = res_data.message ? res_data.message : 'No Data Found !';
                    vm.cart = [];

                }
            });
    };

    $timeout(function () {
        vm.getCartListFn();
        // vm.getCustomizeDataFn();
    });


    vm.getCustomizeDataFn = function () {


        var req_obj = {
            api: 'Customizationcriteria',
            method: 'get'
        };
        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {

                // vm.show_/**/loading = false;
                if (res_data.flag) {
                    vm.customize_data = (res_data.Data && res_data.Data.length) ? angular.copy(res_data.Data[0]) : {};
                    _.each(vm.customize_data, function (val, key) {
                        _.each(jewelType, function (v, k) {

                            if (key == k) {
                                val[0].main_type = angular.copy(v);
                            }
                        });

                    });
                    console.log(vm.customize_data);
                } else {
                    vm.no_data = true;
                    vm.message = res_data.message ? res_data.message : 'No Data Found !';
                    vm.customize_data = [];

                }
            });
    };

    /**
     *Remove Item function
     * @param cart_item
     */
    vm.removeItemFn = function (cart_item) {
        var obj = {};
        obj.userId = angular.copy($scope.userId);
        obj.designno = cart_item ? [angular.copy(cart_item)] : (_.pluck(vm.cart, 'designno'));
        var req_obj = {
            api: 'removeFromCart',
            method: 'post',
            request: angular.copy(obj)
        };
        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {
                if (res_data.flag) {

                    vm.cartDetai = res_data.totalInfo && res_data.totalInfo.length ? _.first(res_data.totalInfo) : {};

                    _.each(obj.designno, function (d) {
                        var delete_indx = _.indexOf(_.pluck(vm.cart, 'designno'), d);
                        if (delete_indx >= 0) {
                            var deleted_item = angular.copy(vm.cart[delete_indx]);
                            deleted_item['isInCart'] = false;
                            var update_obj = {};
                            update_obj['isInCart'] = false;
                            //update local storage
                            ProductService.updateProductLocalStorage(deleted_item, update_obj);
                            vm.cart.splice(delete_indx, 1);
                            $rootScope.cartCount -= 1;
                        }
                    });

                    if (!vm.cart || !vm.cart.length) {
                        vm.no_data = true;
                    } else {
                        vm.no_data = false;
                    }


                    $scope.setFlash('s', res_data.message);
                } else {
                    $scope.setFlash('e', res_data.message);
                }

            });
    };


    /**
     * update cart
     * @param obj (qty,designno)
     */
    vm.updateCartFn = function (obj) {
        vm.subLoading = true;
        if (obj && obj.qty <= 0) {
            var selected_item_indx = _.indexOf(_.pluck(vm.cart, 'designno'), obj.designno);
            if (selected_item_indx >= 0) {
                vm.cart[selected_item_indx].qty = obj.qty + 1;
            }
            $scope.setFlash('e', 'Qty Should be greater than 0 !');
        } else {
            var request_obj = angular.copy(obj);
            request_obj.userId = angular.copy($scope.userId);
            var req_obj = {
                api: 'updateCartItemQty',
                method: 'post',
                request: angular.copy(request_obj)
            };
            var response = commonApiService
                .commonApi(req_obj)
                .then(function (res_data) {
                    if (res_data.flag) {
                        var edit_indx = _.indexOf(_.pluck(vm.cart, 'designno'), request_obj.designno);
                        if (edit_indx >= 0) {
                            vm.cart[edit_indx].qty = obj.qty;
                        }
                        $scope.setFlash('s', res_data.message);
                    } else {
                        $scope.setFlash('e', res_data.message);
                    }
                    vm.subLoading = false;
                });
        }
    };

    /**
     * Ad To wishlist
     * @param obj (designno)
     */
    vm.addToWishlistFn = function (design_no) {

        var obj = {};
        obj.userId = angular.copy($scope.userId);
        obj.designno = [angular.copy(design_no)];
        var req_obj = {
            api: 'addToWishlist',
            method: 'post',
            request: angular.copy(obj)
        };
        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {
                    if (res_data.flag) {
                        var edit_indx = _.indexOf(_.pluck(vm.cart, 'designno'), design_no);
                        if (edit_indx >= 0) {
                            vm.cart[edit_indx].IsInWishlist = true;
                            var deleted_item = angular.copy(vm.cart[edit_indx]);
                            deleted_item['IsInWishlist'] = true;

                            $rootScope.wishListCount += 1;

                            var update_obj = {};
                            update_obj['IsInWishlist'] = true;
                            ProductService.updateProductLocalStorage(deleted_item, update_obj);
                        }
                        $scope.setFlash('s', res_data.message);
                    }
                    else {
                        $scope.setFlash('e', res_data.message);
                    }

                }
            );

    };

    /**
     * Check all checkbox for product
     * @param val (value - boolean)
     */
    vm.checkAllFn = function (val) {
        vm.is_customize = val;
        _.each(vm.cart, function (l) {
            l.checked = val;
        });

    };

    /**
     * Cart single check function
     * @param val
     */
    vm.checkFn = function (val) {
        var checked_product = _.where(vm.cart, {checked: true});
        vm.is_customize = (checked_product && checked_product.length) ? true : false;
        if (checked_product && checked_product.length == vm.cart.length) {
            vm.check_all = true;
        } else {
            vm.check_all = false;
        }

    };

    /**
     * Check customize function
     * @param key (customization type , customization type data)
     * @param data
     */
    vm.checkCustomizeFn = function (key, value, data) {
        _.each(vm.customize_data, function (val, k) {
            if (key) {
                if (k && k == key) {
                    _.each(val, function (v) {
                        if (v && v.name != value) {
                            v.checked = false;
                        }
                    });
                }
            } else {
                _.each(val, function (v) {

                    v.checked = false;

                });
            }
        });
    };

    $('#instructions').on('hidden.bs.modal', function (e) {
        vm.selectedProdNo = null;
        vm.specialInstructionRemark = '';
    });

    vm.cartCustomizationAPIFn = function (reqObj) {

        var req = {
            userId: angular.copy($scope.userId)
        };
        req = _.extend(req, reqObj);

        var req_obj = {
            api: 'CartCustmization',
            method: 'post',
            request: angular.copy(req)
        };
        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {
                console.log(req_obj, res_data);
                if (res_data.flag) {

                    /* _.each(req.Data, function (d) {
                     var exist_indx = _.indexOf(_.pluck(vm.cart, 'designno'), d.designno);
                     if (exist_indx >= 0) {
                     vm.cart[exist_indx].diamondquality = angular.copy(d.diamondqlty);
                     vm.cart[exist_indx].diamondcolorname = angular.copy(d.diamondcolor);
                     vm.cart[exist_indx].colorstonequality = angular.copy(d.colorstoneqlty);
                     vm.cart[exist_indx].colorstonecolorname = angular.copy(d.clorstonecolor);
                     vm.cart[exist_indx].mastermanagement_metaltypename = angular.copy(d.metaltype);
                     vm.cart[exist_indx].mastermanagement_metalcolorname = angular.copy(d.metalcolor);
                     }

                     });*/

                    vm.check_all = false;
                    vm.is_customize = false;
                    vm.checkCustomizeFn();
                    vm.getCartListFn();

                    $('.c-menu--slide-right').removeClass('is-active');
                    $('#c-mask').removeClass('is-active');
                    $scope.setFlash('s', res_data.message);
                    $('#instructions').modal('hide');

                    vm.subLoading = false;
                } else {
                    $scope.setFlash('e', res_data.message);
                }

            });

    };

    /**
     * Add special instruction
     * designNo : 'specific num' or 'all'
     * 'all' -> for cart
     */
    vm.addSpecialInstructionFn = function (remark) {

        var designNo = vm.selectedProdNo;
        vm.subLoading = true;

        if (remark) {
            var reqObj = {
                Data: []
            };
            if (designNo == 'all') {
                reqObj['remarks'] = remark;
                delete reqObj['Data'];
            } else {
                var selectedCartProd = _.findWhere(vm.cart, {designno: designNo});

                if (selectedCartProd) {
                    // As per API request => While adding remark, send other field ''
                    var remarkProd = {
                        designno: selectedCartProd.designno,
                        remarks: remark,
                        qty: selectedCartProd.qty,
                        diamondqlty: '',
                        diamondcolor: '',
                        colorstoneqlty: '',
                        clorstonecolor: '',
                        metaltype: '',
                        metalcolor: ''
                    };
                    reqObj['Data'].push(remarkProd);
                }
            }
            vm.cartCustomizationAPIFn(reqObj);
            remark = '';
        }
    };

    /***\
     * apply customization function
     */
    vm.applyCustomizationFn = function () {

        var req = {};

        var obj = {};
        _.each(vm.customize_data, function (val, key) {
            var checked_data = _.where(val, {checked: true});
            if (checked_data && checked_data.length) {
                obj[key] = (_.first(checked_data)).name;
            }
        });

        console.log('obj', obj);

        var checked_cart = _.where(vm.cart, {checked: true});
        if (checked_cart && checked_cart.length) {
            var data = [];
            _.each(checked_cart, function (c) {
                var check_obj = {
                    designno: c.designno,
                    qty: c.qty,
                    diamondqlty: (obj && obj.diamondquality) ? obj.diamondquality : c.diamondquality,
                    diamondcolor: (obj && obj.diamondcolor) ? obj.diamondcolor : c.diamondcolorname,
                    colorstoneqlty: (obj && obj.colorstonequality) ? obj.colorstonequality : c.colorstonequality,
                    clorstonecolor: (obj && obj.colorstonecolor) ? obj.colorstonecolor : c.colorstonecolorname,
                    metaltype: (obj && obj.metaltype) ? obj.metaltype : c.mastermanagement_metaltypename,
                    metalcolor: (obj && obj.metalcolor) ? obj.metalcolor : c.mastermanagement_metalcolorname,
                    remarks: (obj && obj.remark) ? obj.remark : (c.remark || ''),
                };
                data.push(check_obj);
            });
            if (data && data.length) {
                req.Data = angular.copy(data);
            }
        }

        vm.cartCustomizationAPIFn(req);
    };

    /**
     * Add special instruction (Popup open)
     */
    vm.instructionPopupFn = function (designno, remark) {
        vm.selectedProdNo = designno;
        vm.specialInstructionRemark = _.clone(remark);
        $('#instructions').modal('show');
    };

    vm.customizeOpenFn = function () {
        $('.c-menu--slide-right').addClass('is-active');
        $('#c-mask').addClass('is-active');
    };

    /**
     * Show customized selected data when accordian close
     * @param key
     * @param index
     */
    vm.customizeByFn = function (key, index) {

        setTimeout(function () {
            var isOpen = $("#metal-type" + index).is(":visible");
            vm.currentOpen = '';
            if (isOpen) {
                vm.currentOpen = key;
            }

            $scope.$apply();
        }, 500);
    };
});

Cart.service('CartService', function ($http) {
    return {};
});