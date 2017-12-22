/**
 * Created by User on 10/10/2016.
 */
var CartWishlist = angular.module('CartWishlist', []);
modules.push('CartWishlist');

// Cart controller -- BEGIN
CartWishlist.controller('CartController', function ($scope, commonApiService, encryptDecryptService) {


});
// Cart controller -- END

// Wishlist controller -- BEGIN
CartWishlist.controller('WishlistController', function ($scope,$rootScope, commonApiService, encryptDecryptService, ProductService) {

    var vm = this;
    vm.noData = false;
    vm.products = [];
    var userId = $scope.userId;

    if (!userId) {
        $scope.goToFn('/');
        return true;
    }

    var req_obj = {
        // api: 'product/list/with-side-menu',
        api: 'webgetwishlistitems?userid=' + userId,
        method: 'get',
    };

    var response = commonApiService
        .commonApi(req_obj)
        .then(function (res_data) {

            if (res_data.flag) {

                vm.products = res_data.data;
            } else {
                vm.products = [];
                vm.noData = true;
                console.log('Error', res_data.message);
            }
        });

    // Remove from wishlist
    vm.removeFromWishlistFn = function (designno) {

        var designNos = [];
        if (designno == 'all') {
            designNos = _.pluck(vm.products, 'designno');
        } else {
            designNos = [designno];
        }

        var req_obj = {
            api: 'webremoveitemwishlist',
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

                    if (designno == 'all') {
                        vm.noData = true;
                        $rootScope.wishListCount -= vm.products.length;
                        vm.products = [];
                    } else {
                        _.each(vm.products, function (prod, index) {
                            if (prod && prod.designno == designno) {
                                vm.products.splice(index, 1);
                                $rootScope.wishListCount -= 1;
                            }
                        });
                        $scope.setFlash('s', res_data.message);
                    }

                    _.each(designNos, function (num) {
                        // Update local storage data
                        ProductService.updateProductLocalStorage(num, {isInWishlist: false});
                    });

                } else {
                    $scope.setFlash('e', res_data.message);
                }
            });
    };

    // Add to cart
    vm.moveToCartFn = function (designno) {

        var designNos;
        if (designno == 'all') {
            designNos = _.pluck(_.where(vm.products, {IsInCart: false}), 'designno');
        } else {
            designNos = [designno];
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

                        _.each(vm.products, function (prod, index) {

                            if (prod && _.indexOf(designNos, prod.designno) >= 0) {
                                prod['IsInCart'] = true;

                                $rootScope.cartCount += 1;
                            }
                        });

                        //TODO Success message
                        $scope.setFlash('s', res_data.message);
                    } else {
                        $scope.setFlash('e', res_data.message);
                    }
                });
        }
    };
});
// Wishlist controller -- END