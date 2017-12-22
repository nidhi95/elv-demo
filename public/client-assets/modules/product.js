/**
 * Created by User on 9/30/2016.
 */

var Product = angular.module('Product', ['tagged.directives.infiniteScroll']);
modules.push('Product');

Product.controller('ProductListCtrl', function ($scope, ProductService, commonApiService, encryptDecryptService, $location,
                                                $timeout, CommonFnService, $rootScope, $filter) {

    if (!$scope.loginUser) {
        $scope.goToFn('/');
        return true;
    }
    // Scroll to top
    $(window).scrollTop(0);

    var vm = this;


    //vm.isnewarrival = 'yes';

    vm.cartItems = [];
    vm.cartDetai = {
        totalGoldWeight: 0,
        totalDiamondWeight: 0
    };

    vm.refreshFn = function () {

        vm.filter = {};
        vm.page = 1;
        vm.limit = 12;
        vm.totalCount = 0;
        vm.products = [];
        vm.fetching = false;
        vm.disabled = false;
        vm.noData = false;
        vm.productDetail = {};
        vm.searchByStockResultData = false;

    };
    vm.refreshFn();

    // vm.imgUrl = 'http://192.168.0.146:1000/client-assets/img/product/2.png';

    vm.setSelectedFilterFn = function () {
        // setTimeout(function () {

        if (vm.searchObj && !_.isEmpty(vm.searchObj)) {
            vm.filter = _.clone(vm.searchObj);

            _.each(vm.searchObj, function (val, key) {

                var category_index = _.indexOf(_.pluck($scope.categoryListMaster, 'reqKey'), key);
                var category = $scope.categoryListMaster[category_index];
                if (val == 'all') {
                    category['include_all'] = true;
                }
                _.each(category && category['sub-categories'], function (subCat) {
                    if (val == 'all') {
                        // subCat['checked'] = true;
                    } else if (subCat.name == val) {
                        subCat['checked'] = true;
                    }
                });
            });
        }
        if (!$scope.$$phase) {
            $scope.$apply();
        }
        // }, 500);
    };

    vm.productListFn = function (obj) {
        vm.fetching = true;
        vm.searchByStockResultData = false;
        if (vm.filter && vm.filter.album) {
            vm.is_album = true;
        } else {
            vm.is_album = false;
        }
        var req_obj = {
            // api: 'product/list/with-side-menu',
            api: (vm.is_album ? 'AlbumDetail' : 'webgetSideMenuCategory'),
            method: 'post',
            request: {
                "userid": $scope.userId,
                "pagesize": vm.limit,
                "currentpage": vm.page,
                "respondWithCategory": false,
                // "isnewarrival": "yes"
            }
        };

        if (vm.filter && !_.isEmpty(vm.filter)) {
            if (vm.is_album) {
                req_obj.request = _.pick(vm.filter, 'album')

            } else {
                var filter = _.clone(vm.filter);
                _.extend(req_obj.request, filter);
            }
            /*if (vm.isnewarrival)
             filter['isnewarrival'] = vm.isnewarrival;*/

        }

        var response = commonApiService
            .commonApi(req_obj)
            .then(function (res_data) {

                if (vm.page == 1)
                    $('body').animate({scrollTop: 20});

                if (res_data.flag) {
                    // vm.categories = res_data.data ? res_data.data.categories : [];
                    if (vm.is_album) {
                        var productList = res_data.data ? res_data.data : [];
                        vm.totalCount = res_data.data.length;
                    } else {
                        var productList = res_data.data ? res_data.data.products : [];
                        vm.totalCount = res_data.data.totalItemsCount;
                    }


                    // Set filter wise category change data
                    if (res_data.data.categories && vm.page == 1) {

                        var categories = res_data.data.categories;

                        $scope.categoryListMaster.length = 0;
                        // Set requestkey in category list
                        $scope.setCategoryListRequestKey(categories);
                        categories = $filter('orderBy')(categories, 'sequence');

                        _.each(categories, function (category) {
                            $scope.categoryListMaster.push(category);
                        });

                        // Set selected filter data
                        vm.setSelectedFilterFn();
                    }

                    _.each(productList, function (prod) {

                        var prod_exists = _.findWhere(vm.products, {designno: prod.designno});
                        prod.alreadyInCart = false;

                        var reviewCart = _.findWhere(vm.cartItems, {designno: prod.designno});
                        if (reviewCart) {
                            prod.checked = true;
                        }

                        if (!prod_exists) {
                            vm.products.push(prod);
                        }
                    });
                    // vm.products = (vm.products).concat(prod);


                    vm.total_pages = Math.ceil(vm.totalCount / vm.limit);

                    // $scope.$apply();

                    if (vm.totalCount > 0) {
                        vm.page = vm.page + 1;
                    }

                    // Scroll window little down side -> To manage fix div
                    var y = $(window).scrollTop();
                    $(window).scrollTop(y + 10);

                    console.log('vm.products', vm.products, req_obj);

                } else {
                    vm.noData = true;
                    console.log('Error', res_data.message, req_obj);
                }
                vm.fetching = false;

                if (obj) {
                    vm.nextPrevProductFn(obj.designNo, obj.action);
                }
            });
    };


    /**
     * Search by stock result
     */
    vm.searchByStockResultFn = function () {

        vm.fetching = true;
        vm.searchByStockResultData = true;

        var decryptionObj = {
            localStorage: {keyName: 'token'}
        };
        var token = encryptDecryptService.decryption(decryptionObj);

        var req_obj = {
            api: 'SBSSearchResult',
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
                vm.fetching = false;

                if (res_data.flag) {
                    vm.products = res_data.data.products;
                    vm.totalCount = res_data.data.totalItemsCount;
                }
                else {
                    vm.noData = true;
                    // $scope.setFlash('e', res_data.message);
                }
            });
    };

    /**
     * Convert query string to request object
     */
    vm.queryStringToReqFn = function () {

        $timeout(function () {
            // Agular query string read
            vm.searchObj = $location.search();

            if (!vm.searchObj || _.isEmpty(vm.searchObj)) {
                if (location.search != '')
                    vm.searchObj = CommonFnService.queryStringToObj(location.search);
            }

            // For checkbox
            /*if (vm.searchObj && !_.isEmpty(vm.searchObj)) {

             _.each($scope.categoryListMaster, function (cat) {

             var search = vm.searchObj[cat.reqKey];
             if (search) {
             _.each(cat['sub-categories'], function (subCat) {

             var searchData = search.split(',');
             if (_.indexOf(searchData, subCat.name) >= 0) {
             subCat.checked = true;
             }

             });
             }
             });
             }*/

            console.log('vm.searchObj', vm.searchObj);

            /**
             * Product details
             */
            if (vm.searchObj && !_.isEmpty(vm.searchObj)) {
                vm.filter = _.clone(vm.searchObj);
            }

            var currentState;


            if (vm.searchObj && (vm.searchObj.searchStockResult == 'true' || vm.searchObj.searchStockResult == true)) {
                currentState = 'searchStockResult';
            }
            if (vm.searchObj && (vm.searchObj.searchByStock == 'true' || vm.searchObj.searchByStock == true)) {
                currentState = 'searchByStockRequest';
            }


            switch (currentState) {

                case 'searchStockResult':
                    vm.searchByStockResultFn();
                    break;

                case 'searchByStockRequest':
                    vm.searchByStockFn();
                    break;

                default:
                    vm.productListFn();
                    break;

            }
        }, 500);
    };

    // On load product list -- BEGIN
    vm.queryStringToReqFn();

    // On load product list -- END

    /**
     * Get more data on scroll
     */
    vm.getMore = function (obj) {

        console.log('vm.total_pages', vm.total_pages, vm.page);

        if (vm.page > 1 && !vm.fetching) {
            if (vm.page <= vm.total_pages || !vm.total_pages) {
                vm.productListFn(obj);
            } else {
                vm.disabled = true;
            }
        }
    };

    /**
     * Event listen which is call from FilterController when filter change
     */
    $rootScope.$on('FilterChangeEvent', function (event, data) {

        vm.page = 1;
        vm.products.length = 0;
        vm.refreshFn();
        vm.queryStringToReqFn();
    });

    /**
     * get rpoduct details from api
     * @param designno (product desing no to be send in api to get details)
     * @param evnt (event of selected button use when album , for stop open product detail popup)
     * @param is_check_album_access (string for use before add to cart for check album have access or not
     * if have access than call addToCart function)
     */
    vm.productDetailFn = function (designno, evnt, is_check_album_access) {

        // Check first in local storage
        var p_detail = encryptDecryptService.decryption({localStorage: {keyName: designno}});
        var recent_products = encryptDecryptService.decryption({localStorage: {keyName: 'recent_product'}});
        /**
         * If product list of album
         * then dont show product detail popup before api call
         * because before open popup, call api for product detail permission,
         *
         */
        if (vm.is_album && !is_check_album_access) {
            evnt.stopPropagation();
        }

        // If local storage contain product detail then get data from local storage
        // this only for simple product list, it will not apply in album product list
        if (p_detail && !vm.is_album) {
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
                        //for album
                        //check for album have access when add to cart
                        if (is_check_album_access) {

                            var selected_product_detail_sent_cart = _.findWhere(vm.products, {designno: designno});
                            vm.addToCartFn(selected_product_detail_sent_cart);
                        }
                        //for product list
                        else {
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
                            $('.product-detail-modal').modal('show');
                        }
                    } else {
                        //selected product to be uncheck bcz access denied
                        if (is_check_album_access) {
                            var selected_product_detail = _.findWhere(vm.products, {designno: designno});
                            if (selected_product_detail && selected_product_detail.designno) {
                                selected_product_detail.checked = false;
                            }
                        }
                        vm.productDetail = {};
                        vm.design_no = angular.copy(designno);
                        $('.product-detail-error').modal('show');
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

            var productChecked = _.findWhere(vm.products, {designno: product.designno});
            if (productChecked) {
                productChecked.checked = false;
            }

            (cart_index >= 0) ? vm.cartItems.splice(cart_index, 1) : '';
        }

        _.each(vm.cartItems, function (item) {
            vm.cartDetai['totalGoldWeight'] += parseFloat(item.MetalWeight || 0);
            vm.cartDetai['totalDiamondWeight'] += parseFloat(item.diamondweight || 0);
        });


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
                        /*var update_obj = {};
                         update_obj['isInWishlist'] = true;
                         ProductService.updateProductLocalStorage(vm.productDetail, update_obj);*/
                    }
                    //else {
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
                    //}
                    $scope.setFlash('s', res_data.message);
                } else {
                    // vm.productDetail = {};
                    $scope.setFlash('e', res_data.message);
                }
            });
    };

    /**
     * Remove from cart
     */
    /*vm.removeFromCart = function () {

     if (vm.cartItems && vm.cartItems.length) {

     var designNos = _.pluck(vm.cartItems, 'designno');
     var req_obj = {
     api: 'webremovefromcart',
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

     _.each(vm.cartItems, function (items) {
     var selected_item = _.findWhere(vm.products, {designno: items.designno});
     if (selected_item) {
     selected_item['checked'] = false;
     selected_item['isInCart'] = false;
     }
     });

     vm.cartItems = [];

     vm.cartDetai = {
     totalGoldWeight: 0,
     totalDiamondWeight: 0
     };
     $scope.setFlash('s', res_data.message);
     } else {
     $scope.setFlash('e', res_data.message);
     }
     });
     }
     }*/

    $('#product-detail').on('hide.bs.modal', function () {
        vm.productDetail = {};
    });

    vm.alreadyInCartFn = function (index) {
        vm.products[index]['alreadyInCart'] = true;
        $timeout(function () {
            vm.products[index]['alreadyInCart'] = false;
        }, 500);
    };

    vm.cartReviewFn = function () {

        $timeout(function () {
            var height = window.innerHeight - 140;
            $('#reviewCartBodyId').css('max-height', height);
        }, 500)
    };

    /**
     * Product detail: Next - prev action
     */
    vm.nextPrevProductFn = function (designNo, action) {

        if (vm.products && vm.products.length) {

            var currentProductIndex = _.indexOf(_.pluck(vm.products, 'designno'), designNo);
            var requestProduct = null;
            var requestedDataIndex;

            switch (action) {
                case 'next':
                    requestedDataIndex = currentProductIndex + 1;
                    break;

                case 'prev':
                    requestedDataIndex = currentProductIndex - 1;
                    break;
            }

            if (requestedDataIndex >= 0 && requestedDataIndex < vm.totalCount) {
                requestProduct = vm.products[requestedDataIndex];

                /**
                 * Currently loaded product's last product is open,
                 * So, for next product, we have to call API with next page number
                 **/
                if (!requestProduct) {
                    vm.getMore({designNo: designNo, action: action});
                } else {
                    vm.productDetailFn(requestProduct.designno)
                }
            }
        }
    };
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
                    vm.searchStockUrl = res_data.link;
                    $('#searchStockReport').attr('src', vm.searchStockUrl);
                    $('#searchByStock').modal('show');
                } else {
                    $scope.setFlash('e', res_data.message);
                }
            });
    };

    // Search by stock result
    vm.searchByStockResFilterFn = function () {
        location.replace("/product#?searchStockResult=true");
        $('#searchByStock').modal('hide');
        // Scroll window little down side -> To manage fix div
        $('body').animate({scrollTop: 20});
        $rootScope.$emit('FilterChangeEvent');
    };

    /**
     * Filter clear
     */
    vm.clearFilterFn = function () {
        $scope.goToFn('/product');
    };
});

Product.controller('FilterCtrl', function ($scope, $location, $rootScope, CommonFnService, commonApiService, encryptDecryptService) {

    var vm = this;
    vm.searchObj = $location.search();
    vm.filter = {};
    vm.isProductPageIndex = (location.href).indexOf('product');
    vm.showClearFilter = false;
    vm.currentOpen;
    vm.searchDataUrl = ['searchStockResult', 'searchByStockRequest', 'album']
    // jQuery query string read
    if (!vm.searchObj || _.isEmpty(vm.searchObj)) {
        if (location.search != '')
            vm.searchObj = CommonFnService.queryStringToObj(location.search);
    }

    /**
     * Product details
     */
    setTimeout(function () {

        if (vm.searchObj && !_.isEmpty(vm.searchObj)) {
            vm.filter = _.clone(vm.searchObj);

            _.each(vm.searchObj, function (val, key) {

                var category_index = _.indexOf(_.pluck($scope.categoryListMaster, 'reqKey'), key);
                var category = $scope.categoryListMaster[category_index];
                if (val == 'all') {
                    category['include_all'] = true;
                }
                _.each(category && category['sub-categories'], function (subCat) {
                    if (val == 'all') {
                        // subCat['checked'] = true;
                    } else if (subCat.name == val) {
                        subCat['checked'] = true;
                    }
                });
            });

            if (vm.isProductPageIndex >= 0) {
                vm.currentOpen = $scope.categoryListMaster[0].reqKey;
                vm.showClearFilter = true;
            }
            console.log('vm.showClearFilter', vm.showClearFilter);
        }
    }, 500);

    // Here checkbox works as radio button
    vm.clearOtherFn = function (key, index, parentIndex) {

        if (parentIndex >= 0 && index >= 0 && key) {

            if ($scope.categoryListMaster[parentIndex] && $scope.categoryListMaster[parentIndex]['sub-categories']) {
                _.each($scope.categoryListMaster[parentIndex]['sub-categories'], function (subCat, sub_ind) {

                    if (index != sub_ind) {
                        subCat.checked = false;
                    } else if (vm.filter[key] == 'all') {
                        subCat.checked = true;
                    }
                });
            }
            vm.filterFn(key, parentIndex);
        }
    };

    /**
     * Filter change
     * @param key : req key name
     * @param type : 'exclude' / 'include_all'
     */
    vm.filterFn = function (key, index, type) {

        if (key) {

            // If any category search apply - Remove search by stock result filter
            if (!_.contains(vm.searchDataUrl, key)) {
                _.each(vm.searchDataUrl, function (data) {
                    delete vm.filter[data];
                });
            }

            /*if (key != 'searchStockResult' || key != 'searchByStock' ||) {
             delete vm.filter['searchStockResult'];
             delete vm.filter['searchByStock'];
             }*/

            vm.filterParentIndex = index;

            var checked_all;
            vm.showClearFilter = true;
            switch (type) {
                case 'exclude':
                    $scope.categoryListMaster[index]['exclude_all'] = true;
                    $scope.categoryListMaster[index]['include_all'] = false;

                    delete vm.filter[key];
                    checked_all = false;
                    delete vm.filter[key];
                    // vm.filter[key] = null;
                    // $location.search(key, null);
                    break;

                case 'include_all':
                    $scope.categoryListMaster[index]['exclude_all'] = false;
                    $scope.categoryListMaster[index]['include_all'] = true;
                    checked_all = true;
                    vm.filter[key] = 'all';
                    // $location.search(key, 'all');
                    break;

                default:
                    $scope.categoryListMaster[index]['exclude_all'] = false;
                    $scope.categoryListMaster[index]['include_all'] = false;
                    var set_val = _.findWhere($scope.categoryListMaster[index]['sub-categories'], {checked: true});
                    vm.filter[key] = set_val ? set_val.name : null;
                    break;
            }

            if (vm.isProductPageIndex < 0) {
                if (vm.filter[key])
                    $scope.goToFn('/product#?' + key + '=' + vm.filter[key]);
                else
                    $scope.goToFn('/product');
            }
            else {
                var queryString = $.param(vm.filter);
                location.replace("/product#?" + queryString);
                // $location.path("/product#?" + queryString).replace().reload(false);
                // $location.search(key, vm.filter[key]).reload(false);

                if (type) {
                    _.each($scope.categoryListMaster[index]['sub-categories'], function (subCat) {
                        subCat['checked'] = checked_all;
                    });
                }
            }
        }

        // Scroll window little down side -> To manage fix div
        $('body').animate({scrollTop: 20});

        $rootScope.$emit('FilterChangeEvent');
    };

    // Search by stock -- Popup
    vm.searchByStockRequestFn = function () {

        if (vm.isProductPageIndex < 0) {
            $scope.goToFn('/product#?searchByStock=true');
        }
        else {
            location.replace("/product#?searchByStock=true");
        }

        // Scroll window little down side -> To manage fix div
        $('body').animate({scrollTop: 20});
        $rootScope.$emit('FilterChangeEvent');
    };

    // Search by stock result
    /*vm.searchByStockResFilterFn = function () {

     if (vm.isProductPageIndex < 0) {
     $scope.goToFn('/product#?searchStockResult=true');
     }
     else {
     location.replace("/product#?searchStockResult=true");
     }

     // Scroll window little down side -> To manage fix div
     $('body').animate({scrollTop: 20});
     $rootScope.$emit('FilterChangeEvent');
     };*/

    /**
     * Filter clear
     */
    vm.clearFilterFn = function () {
        vm.filter = {};
        $scope.goToFn('/product');
    };

    /**
     * Show customized selected data when accordian close
     * @param key
     * @param index
     */
    vm.filterToggleFn = function (key, index) {
        setTimeout(function () {
            var isOpen = $("#accordionV5Collapse" + index).is(":visible");
            vm.currentOpen = '';
            if (isOpen) {
                vm.currentOpen = key;
            }

            if (!$scope.$$phase) {
                $scope.$apply();
            }
        }, 500);
    };

    /**
     * Search by stock function
     */
    vm.searchByStockFn = function () {
        $('#loadingArea').css('display', 'none');
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
                    window.open(res_data.link, '_blank');
                    vm.searchStockUrl = res_data.link;
                } else {
                    $scope.setFlash('e', res_data.message);
                }
            });
    };


});

Product.service('ProductService', function ($http, API_REQUEST, encryptDecryptService) {

    return {
        list: function (obj) {
            return $http.post('http://192.168.0.136:9797/Purchase/SelectAllPurchase', {a: 'abc'}, {
                headers: {
                    'Authorization': 'Bearer U2FsdGVkX18QlQSnKNy1uGFwUuMzrOgX+kmp7fqsfvVVgSeMj7LUISQhKBpTrSL1'
                }
            })
        },
        updateProductLocalStorage: function (product, updatedObj) {

            if (product) {

                // If product object then select designno o/w product = designno
                var designno = product.designno || product;
                var p_detail = encryptDecryptService.decryption({localStorage: {keyName: designno}});

                if (p_detail && updatedObj) {

                    p_detail = _.extend(p_detail, updatedObj);

                    encryptDecryptService.encryption({
                        data: p_detail,
                        localStorage: {keyName: designno}
                    });
                }
            }
            return true;
        }
    }
});