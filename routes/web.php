<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('login');
});
//me
Route::get('/me', [App\Http\Controllers\HomeController::class, 'getAuthenticateduser']);
//me for vendor
Route::get('/me/vendor', [App\Http\Controllers\HomeController::class, 'getAuthenticatedVendor']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Route::get('{path}',[App\Http\Controllers\HomeController::class, 'index'])->where( 'path', '([A-z]+)?' );
// Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])->where('any', '.*');

// Public Pages
Route::get('/', [App\Http\Controllers\FrontsideController::class, 'index']);
Route::get('/home', [App\Http\Controllers\FrontsideController::class, 'index']);
Route::get('/products', [App\Http\Controllers\FrontsideController::class, 'index']);
Route::get('/products/{product_id}', [App\Http\Controllers\FrontsideController::class, 'index']);
Route::get('/store/{vendor_id}', [App\Http\Controllers\FrontsideController::class, 'vendorProfile']);
Route::get('/test', [App\Http\Controllers\FrontsideController::class, 'index']);

// Public API (Json response)
Route::get('/getVendorProfile/{vendor_id}', [App\Http\Controllers\FrontsideController::class, 'getVendorProfile']);
Route::get('/getProducts', [App\Http\Controllers\FrontSide\ProductsController::class, 'getProducts']);
Route::get('/getProducts/{vendor_id}', [App\Http\Controllers\FrontSide\ProductsController::class, 'getProductsByVendorId']);


Route::get('/404', function () {
    abort(404, "Page Not Found");
});
Route::middleware('isAuth')->group(function () {

    //AUTH API
    Route::get('/getUserChatList', [App\Http\Controllers\ChatController::class, 'getUserChatList']);
    Route::post('/sendMessage', [App\Http\Controllers\ChatController::class, 'sendMessage']);
    Route::post('/createConversation', [App\Http\Controllers\ChatController::class, 'createConversation']);
    Route::get('/getConversationReplies/{conversation_id}', [App\Http\Controllers\ChatController::class, 'getConversationReplies']);
    Route::get('/getStoreChatList', [App\Http\Controllers\ChatController::class, 'getStoreChatList']);
    Route::get('/test_pusher', [App\Http\Controllers\ChatController::class, 'test_pusher']);
    Route::get('/chatGetUserInfo', [App\Http\Controllers\ChatController::class, 'chatGetUserInfo']);

    Route::get('/get_user_notifications', [App\Http\Controllers\PalexNotificationController::class, 'get_user_notifications']);

    Route::middleware('isVendor')->group(function () {
        // Route::get('/vendor/orders', [App\Http\Controllers\BacksideController::class, 'index']);
        // Route::get('/vendor/products', [App\Http\Controllers\BacksideController::class, 'index']);
        Route::get('/vendor', [App\Http\Controllers\BacksideController::class, 'index']);
        Route::get('/vendor/{page_name}', [App\Http\Controllers\BacksideController::class, 'index']);
        Route::get('/vendor/chat/{conversation_id}', [App\Http\Controllers\BacksideController::class, 'chatPageByConvId']);

        //API
        Route::post('/vendor/updateProruct/{id}', [App\Http\Controllers\ProductController::class, 'updateProduct']);
        Route::post('/palex_api/vendor/createProduct', [App\Http\Controllers\ProductController::class, 'addProduct']);
        Route::get('/palex_api/vendor/getProducts', [App\Http\Controllers\ProductController::class, 'getProductsPerVendor']);
        Route::post('/palex_api/vendor/updateOrderStatus', [App\Http\Controllers\FrontSide\OrderController::class, 'updateOrderStatus']);
        Route::get('/palex_api/vendor/getOrders', [App\Http\Controllers\FrontSide\OrderController::class, 'getOrdersVendor']);
        Route::post('/vendor/update/{id}', [App\Http\Controllers\BacksideController::class, 'updateVendorDetails']);
        Route::get('/vendor/api/totalOrders', [App\Http\Controllers\FrontSide\OrderController::class, 'getTotalOrderPervendor']);
        Route::get('/vendor/api/totalOrders/done', [App\Http\Controllers\FrontSide\OrderController::class, 'getTotalordersDone']);
        Route::get('/vendor/api/getActiveProducts', [App\Http\Controllers\FrontSide\OrderController::class, 'getVendorProductsCount']);
        Route::get('/vendor/api/getConversationCount', [App\Http\Controllers\FrontSide\OrderController::class, 'getVendorTotalConversations']);
    });

    Route::middleware('isAdmin')->group(function () {
        Route::get('/admin', [App\Http\Controllers\BacksideController::class, 'index']);
        Route::get('/admin/{page_name}', [App\Http\Controllers\BacksideController::class, 'index']);
        // Route::get('/admin/users', [App\Http\Controllers\BacksideController::class, 'index']);
        // Route::get('/admin/feeds', [App\Http\Controllers\BacksideController::class, 'index']);
        //API
        Route::get('/getUsers', [App\Http\Controllers\NewsfeedController::class, 'getUsers']);
        Route::post('/approveUser', [App\Http\Controllers\NewsfeedController::class, 'approveUser']);
        Route::get('/countVendors', [App\Http\Controllers\HomeController::class, 'countVendors']);
        Route::get('/countCustomers', [App\Http\Controllers\HomeController::class, 'countCustomers']);
        Route::get('/countAcceptedVendors', [App\Http\Controllers\HomeController::class, 'countAcceptedVendors']);
        //Feeds
        Route::post('/addFeed', [App\Http\Controllers\NewsfeedController::class, 'createFeeds']);
        Route::get('/getFeedsAdmin', [App\Http\Controllers\BacksideController::class, 'getFeeds']);
    });

    Route::middleware('isCustomer')->group(function () {
        Route::get('/customer', [App\Http\Controllers\FrontsideController::class, 'index']);
        Route::get('/customer/{page_name}', [App\Http\Controllers\FrontsideController::class, 'index']);
        Route::get('/customer/chat/{conversation_id}', [App\Http\Controllers\FrontsideController::class, 'chatPageByConvId']);
        Route::get('/customer/orders/{order_id}', [App\Http\Controllers\FrontsideController::class, 'orderDetailsPAge']);

        // Route::get('/customer/profile', [App\Http\Controllers\FrontsideController::class, 'index']);
        // Route::get('/customer/feeds', [App\Http\Controllers\FrontsideController::class, 'index']);

        //API
        Route::get('/getCartCounter', [App\Http\Controllers\FrontSide\CartController::class, 'getCartCounter']);
        Route::post('/addToCart', [App\Http\Controllers\FrontSide\CartController::class, 'addToCart']);
        Route::get('/getCart', [App\Http\Controllers\FrontSide\CartController::class, 'getCart']);
        Route::post('/updateCartItem', [App\Http\Controllers\FrontSide\CartController::class, 'updateCartItem']);
        Route::post('/removeCartItem', [App\Http\Controllers\FrontSide\CartController::class, 'removeCartItem']);
        Route::get('/clearCart', [App\Http\Controllers\FrontSide\CartController::class, 'clearCart']);
        Route::get('/getFeeds', [App\Http\Controllers\FrontSide\ProductsController::class, 'getFeeds']);
        Route::post('/placeOrder', [App\Http\Controllers\FrontSide\OrderController::class, 'placeOrder']);
        Route::get('/getCustomerOrders', [App\Http\Controllers\FrontSide\OrderController::class, 'getCustomerOrders']);
        Route::get('/getCustomerOrdersDetails/{order_id}', [App\Http\Controllers\FrontSide\OrderController::class, 'getCustomerOrdersDetails']);
        Route::post('/changeCustomerPicture', [App\Http\Controllers\FrontSide\CustomerSettingsController::class, 'changeCustomerPicture']);
        Route::post('/change_fullname_and_phone', [App\Http\Controllers\FrontSide\CustomerSettingsController::class, 'change_fullname_and_phone']);
        Route::post('/customer_change_password', [App\Http\Controllers\FrontSide\CustomerSettingsController::class, 'change_password']);
        Route::get('/get_customer_addresses', [App\Http\Controllers\FrontSide\CustomerSettingsController::class, 'get_customer_addresses']);
        Route::post('/set_selected_address/{address_id}', [App\Http\Controllers\FrontSide\CustomerSettingsController::class, 'set_selected_address']);
        Route::post('/cancelCustomerOrder/{order_id}', [App\Http\Controllers\FrontSide\OrderController::class, 'cancelCustomerOrder']);
        Route::post('/add_customer_address', [App\Http\Controllers\FrontSide\CustomerSettingsController::class, 'add_customer_address']);
        Route::post('/update_customer_address', [App\Http\Controllers\FrontSide\CustomerSettingsController::class, 'update_customer_address']);
        Route::post('/delete_customer_address', [App\Http\Controllers\FrontSide\CustomerSettingsController::class, 'delete_customer_address']);
        Route::get('/clearCustomerNotifications', [App\Http\Controllers\PalexNotificationController::class, 'markedAsRead']);
    });
});


// Route::get('/productscopy', [App\Http\Controllers\HomeController::class, 'customerIndex']);
