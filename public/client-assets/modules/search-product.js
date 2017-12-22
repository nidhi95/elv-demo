/**
 * Created by tejaswi.tandel on 10/22/2016.
 */
var SearchProduct = angular.module('SearchProduct', []);
modules.push('SearchProduct');

SearchProduct.controller('SearchProductCtrl', function ($scope, $rootScope, $timeout,
                                                        ProductService, encryptDecryptService,
                                                        commonApiService) {
    var vm = this;


    // Next - prev arrow hide in detail popup
    vm.nextPrevHide = true;

    $timeout(function () {
        var desing_no = (window.location.search).replace('?', '');
        vm.productDetailFn(desing_no);

    });


    /**
     * Product detail
     */
    vm.productDetailFn = function (designno) {

        // Check first in local storage
        var p_detail = encryptDecryptService.decryption({localStorage: {keyName: designno}});
        var recent_products = encryptDecryptService.decryption({localStorage: {keyName: 'recent_product'}});

        // If local storage contain product detail then get data from local storage
        if (p_detail) {
            vm.productDetail = p_detail;
            var exist_product_indx = _.indexOf(_.pluck(recent_products, 'designno'), designno);
            if (exist_product_indx < 0) {
                if (!recent_products || recent_products == null) {
                    recent_products = [];
                }
                recent_products.unshift(vm.productDetail);
                recent_products.splice(4, 1);
                encryptDecryptService.encryption({
                    data: recent_products,
                    localStorage: {keyName: 'recent_product'}
                });
            }
        }
        // Call API to get data and store in local storage
        else {

            var req_obj = {
                // api: 'product/list/with-side-menu',
                api: 'webgetItemDetails',
                method: 'post',
                request: {
                    "userid": $scope.userId,
                    "designno": designno
                }
            };

            var response = commonApiService
                .commonApi(req_obj)
                .then(function (res_data) {

                    if (res_data.flag) {
                        vm.productDetail = res_data.data;
                        vm.productDetail['sync_date'] = moment().valueOf();
                        encryptDecryptService.encryption({
                            data: vm.productDetail,
                            localStorage: {keyName: designno}
                        });
                        var exist_product_indx = _.indexOf(_.pluck(recent_products, 'designno'), designno);
                        if (exist_product_indx <= 0) {
                            if (!recent_products || recent_products == null) {
                                recent_products = [];
                            }
                            recent_products.unshift(vm.productDetail);
                            recent_products.splice(4, 1);
                            encryptDecryptService.encryption({
                                data: recent_products,
                                localStorage: {keyName: 'recent_product'}
                            });
                        }

                    } else {
                        vm.showErr = true;
                        vm.productDetail = {};
                    }
                });
        }
    };

    /**
     * Add to cart
     * @param designno
     */
    vm.addToCartFn = function (product) {

        vm.cartDetai = {
            totalGoldWeight: 0,
            totalDiamondWeight: 0
        };

        var cart_index = _.indexOf(_.pluck(vm.cartItems, 'designno'), product.designno);
        if (product.checked) {

            if (cart_index < 0)
                vm.cartItems.push(product);
        } else {
            (cart_index >= 0) ? vm.cartItems.splice(cart_index, 1) : '';
        }

        _.each(vm.cartItems, function (item) {
            vm.cartDetai['totalGoldWeight'] += parseFloat(item.MetalWeight || 0);
            vm.cartDetai['totalDiamondWeight'] += parseFloat(item.diamondweight || 0);

        })
    };

    /**
     * Submit selected Cart items
     */
    vm.submitCartFn = function (productDetail) {

        var designNos;
        var cartAddedItems;

        if (productDetail) {
            designNos = [productDetail.designno];
            cartAddedItems = [productDetail];
        }
        else if (vm.cartItems && vm.cartItems.length) {
            designNos = _.pluck(vm.cartItems, 'designno');
            cartAddedItems = vm.cartItems;
        }

        if (designNos && designNos.length) {
            var req_obj = {
                api: 'webaddToCart',
                method: 'post',
                request: {
                    "userid": $scope.userId,
                    "designno": designNos
                }
            };

            var response = commonApiService
                .commonApi(req_obj)
                .then(function (res_data) {

                    if (res_data.flag) {


                        _.each(cartAddedItems, function (items) {
                            var selected_item = _.findWhere(vm.products, {designno: items.designno});
                            if (selected_item) {
                                selected_item['checked'] = false;
                                selected_item['isInCart'] = true;

                                $rootScope.cartCount += 1;

                                // Update local storage data
                                ProductService.updateProductLocalStorage(selected_item, {isInCart: true});
                            }
                        });
                        /*_.each(vm.products, function (proj) {

                         if (proj.designno == designno) {
                         proj.isInCart = true
                         }
                         });*/
                        if (!productDetail) {
                            vm.cartItems = [];

                            vm.cartDetai = {
                                totalGoldWeight: 0,
                                totalDiamondWeight: 0
                            };
                        }
                        else {
                            vm.productDetail['isInCart'] = true;
                            vm.addToCartFn(vm.productDetail);
                        }
                        $scope.setFlash('s', res_data.message);
                    } else {
                        // vm.productDetail = {};
                        $scope.setFlash('e', res_data.message);
                    }
                });
        }
    };

    /**
     * Remove from wishlist/ cart
     * @param designno
     * @param type
     * @param key
     */
    vm.removeFromCartWishlistFn = function (designno, type, key) {

        var api_path;
        switch (type) {

            case 'cart':
                api_path = 'webremovefromcart';
                break;

            case 'wishlist':
                api_path = 'webremoveitemwishlist';
                break;
        }

        var req_obj = {
            api: api_path,
            method: 'post',
            request: {
                "userid": $scope.userId,
                "designno": [designno]
            }
        };

        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {

                if (res_data.flag) {
                    vm.productDetail[key] = false;

                    var selected_item = _.findWhere(vm.products, {designno: designno});
                    if (selected_item) {
                        // selected_item['checked'] = false;
                        selected_item[key] = false;
                    }

                    // Update local storage data
                    var update_obj = {};
                    update_obj[key] = false;
                    ProductService.updateProductLocalStorage(vm.productDetail, update_obj);

                    switch (type) {

                        case 'cart':
                            $rootScope.cartCount -= 1;
                            break;

                        case 'wishlist':
                            $rootScope.wishListCount -= 1;
                            break;
                    }

                    $scope.setFlash('s', res_data.message);
                }
                else {
                    $scope.setFlash('e', res_data.message);
                }
            });
    };

    /**
     * Add to Wishlist
     */
    vm.addToWishlistFn = function (designno) {
        var req_obj = {
            api: 'addToWishlist',
            method: 'post',
            request: {
                "userid": $scope.userId,
                "designno": [designno]
            }
        };

        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {

                if (res_data.flag) {
                    //TODO Success message

                    if (vm.productDetail && vm.productDetail.designno == designno) {
                        vm.productDetail['isInWishlist'] = true;

                        // Update local storage data
                        var update_obj = {};
                        update_obj['isInWishlist'] = true;
                        ProductService.updateProductLocalStorage(vm.productDetail, update_obj);
                    }
                    else {
                        _.each(vm.products, function (proj) {

                            if (proj.designno == designno) {
                                proj.isInWishlist = true;

                                $rootScope.wishListCount += 1;

                                // Update local storage data
                                var update_obj = {};
                                update_obj['isInWishlist'] = true;
                                ProductService.updateProductLocalStorage(proj, update_obj);
                            }
                        });
                    }
                    $scope.setFlash('s', res_data.message);
                } else {
                    // vm.productDetail = {};
                    $scope.setFlash('e', res_data.message);
                }
            });
    };


    $('#product-detail').on('hide.bs.modal', function () {
        vm.productDetail = {};
    });

});

SearchProduct.controller('SearchByStockCtrl', function ($scope, $rootScope, $timeout,
                                                        ProductService, encryptDecryptService,
                                                        commonApiService) {
    var vm = this;
    $timeout(function () {
        vm.searchByStockFn();
    }, 500);
    /**
     * Search by stock function
     */
    vm.searchByStockFn = function () {

        var decryptionObj = {
            localStorage: {keyName: 'token'}
        };
        var token = encryptDecryptService.decryption(decryptionObj);

        var req_obj = {
            api: 'SBSrequest',
            method: 'post',
            request: {
                "userId": $scope.userId,
                "Token": token
            }
        };

        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {
                console.log('res_data', res_data);
                if (res_data.flag) {
                    vm.stockUrl = angular.copy(res_data.link);
                    $('#stockReport').attr('src', vm.stockUrl);
                } else {
                    vm.showErr = true;
                    $scope.setFlash('e', res_data.message);
                }
            });
    };

});