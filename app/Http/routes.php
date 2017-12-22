<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//customer
Route::group(['middleware' => ['header']], function () {
    Route::get('/', 'CollectionController@homePage');

    //Route::get('/', function () {
    //    return view('home');
    //});
    Route::get('/contact', function () {
        return view('templates/customer/contact');
    });
    Route::get('/terms', function () {
        return view('templates/customer/terms');
    });
    Route::get('/privacy-policy', function () {
        return view('templates/customer/policy');
    });
    Route::get('/the-company/about', function () {
        return view('templates/customer/about');
    });
    Route::get('/the-company/our-management', function () {
        return view('templates/customer/our-management');
    });
    Route::get('/our-craft', function () {
        return view('templates/customer/craftsmanship');
    });
    Route::get('/essence-of-beauty', function () {
        return view('templates/customer/spirit_of_creation');
    });
    Route::get('/the-company/exhibitions', function () {
        return view('templates/customer/exhibitions');
    });
    Route::get('/collection/alvin', function () {
        return view('templates/collection/alvin');
    });
    Route::get('/collection/inspiration', function () {
        return view('templates/collection/inspiration');
    });
    Route::get('/collection/mantra', function () {
        return view('templates/collection/mantra');
    });
    Route::get('/collection/parampara', function () {
        return view('templates/collection/parampara');
    });
    Route::get('/collection/raisa', function () {
        return view('templates/collection/raisa');
    });
    Route::get('/collection/reevaz', function () {
        return view('templates/collection/reevaz');
    });
    Route::get('/collection/vedant', function () {
        return view('templates/collection/vedant');
    });
    Route::get('/collection/zaira', function () {
        return view('templates/collection/zaira');
    });


    Route::get('/web-content/{code}', 'WebContentController@getContentByCode');

    //Collection
    Route::get('/collection-detail/{slug}', 'CollectionController@getCollectionBySlug');

    Route::get('/collections', 'CollectionController@getCollections');

    //Route::get('/collections', function () {
    //    return view('templates/new-collection/collection');
    //});

    /*Route::get('/collection-detail', function () {
        return view('templates/new-collection/collection-detail');
    });*/
    Route::get('/collection-detail/encircle', function () {
        return view('templates/new-collection/collection-detail');
    });
    Route::get('/collection-detail/lattice', function () {
        return view('templates/new-collection/collection-detail');
    });
    Route::get('/collection-detail/limelight', function () {
        return view('templates/new-collection/collection-detail');
    });
    Route::get('/collection-detail/stella', function () {
        return view('templates/new-collection/collection-detail');
    });
    Route::get('/collection-detail/the-sweet-heart', function () {
        return view('templates/new-collection/collection-detail');
    });
//Collection --END
});


Route::get('/search/product', function () {
    return view('templates/product/search-product');
});
//Search By Stock For iframe
Route::get('/search-by-stock', function () {
    return view('templates/product/search-by-stock');
});

Route::get('/product', function () {
    return view('templates/product/product');
});
Route::get('/wishlist', function () {
    return view('templates/user/wishlist');
});
Route::get('/cart', function () {
    return view('templates/user/cart');
});
Route::get('/profile', function () {
    return view('templates/user/profile');
});
Route::get('/product-detail', function () {
    return view('templates/product/product_detail');
});
Route::get('/my-policy', function () {
    return view('templates/customer/my-policy');
});
Route::get('/thank-you', function () {
    return view('templates/customer/thankyou');
});
Route::get('/remark-policy-reject', function () {
    return view('templates/customer/remark_policy_reject');
});
Route::get('/kyc-policy-request', function () {
    return view('templates/customer/kyc-policy-request');
});
Route::get('/login', function () {
    return view('templates/user/login');
});
Route::get('/test-page', function () {
    return view('templates/test/testPage');
});
Route::get('/checkout', function () {
    return view('templates/user/checkout');
});
Route::get('/acknowledgement', function () {
    return view('templates/user/acknowledgement');
});
Route::get('/edit-profile', function () {
    return view('templates/user/edit-profile');
});
Route::get('/kyc', function () {
    return view('templates/user/kyc-form');
});
Route::get('/dashboard', function () {
    return view('templates/dashboard/dashboard');
});
