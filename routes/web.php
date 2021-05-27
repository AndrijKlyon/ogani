<?php

use Illuminate\Support\Facades\Auth;
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

// Admin routes
Route::match(['get', 'post'], '/admin/login', 'Admin\LoginController@login')->name('admin.login');

Route::prefix('admin')->middleware(['role:admin'])->group(function () {

    Route::resources([
        'categories' => 'Admin\CategoryController',
        'products' => 'Admin\ProductController',
        'brands' => 'Admin\BrandController',
        'options' => 'Admin\OptionController',
        'pay_methods' => 'Admin\PayMethodController',
        'shipping_methods' => 'Admin\ShippingMethodController',
        'order_statuses' => 'Admin\OrderStatusController',
        'users' => 'Admin\UserController',
        'posts' => 'Admin\PostController',
        'aboutrecords' => 'Admin\AboutrecordController',
        'subscribers' => 'Admin\SubscriberController',
        'shopinfos' => 'Admin\ShopInfoController',
        'week_deals' => 'Admin\WeekDealController',
        'post_categories' => 'Admin\PostCategoryController',
        'post_tags' => 'Admin\PostTagController',
    ]);

    Route::post('/changestatus/{model}/{id}', 'Admin\AdminController@changestatus');
    Route::post('/changehit/{model}/{id}', 'Admin\AdminController@changehit');
    Route::post('/changeviewed/{model}/{id}', 'Admin\AdminController@changeviewed');

    Route::get('/', 'Admin\HomeController@index')->name('admin.home');
    Route::resource('orders', 'Admin\OrderController')->except([ 'create' ]);

    Route::get('/related-product', 'Admin\RelatedProductController@related')->name('admin.productrelated');

    Route::prefix('mail')->group(function () {
        Route::get('messages', 'Admin\MailController@messages');
        Route::get('new/{id?}', 'Admin\MailController@new');
        Route::get('answer', 'Admin\MailController@answer');
        Route::get('read/{id}', 'Admin\MailController@read');
        Route::get('reads/{id}', 'Admin\MailController@reads');
        Route::get('delete/{id?}', 'Admin\MailController@delete');
        Route::post('send', 'Admin\MailController@send');
        Route::post('draft', 'Admin\MailController@draft');
        Route::get('prev', 'Admin\MailController@prev');
        Route::get('next', 'Admin\MailController@next');
    });

    Route::prefix('image')->group(function () {
        Route::post('upload','Admin\ImageUploadController@fileStore');
        Route::post('delete','Admin\ImageUploadController@fileDestroy');
        Route::delete('deletes','Admin\ImageUploadController@fileDelete');
    });

    Route::resource('admincomments', 'Admin\CommentController')->except(['create', 'store']);
    Route::resource('ratings', 'Admin\RatingController')->except(['create', 'store', 'edit', 'update']);

    Route::get('/cache', 'Admin\CacheController@index')->name('admin.cache');
    Route::get('/cache_delete', 'Admin\CacheController@cacheClear')->name('admin.cache_clear');
    Route::get('/tempfolder_delete', 'Admin\CacheController@tempfolderDelete')->name('admin.tempfolder_delete');

    Route::get('/search', 'Admin\SearchController@index')->name('admin.search');

});

//Site routes
Route::get('/', 'Site\HomeController@index')->name('home');
Route::get('/about', 'Site\AboutController@index')->name('about');

Route::get('/contact', 'Site\ContactController@get')->name('contact');
Route::post('/contact', 'Site\ContactController@post')->name('contact');

Route::get('/products/{alias}', 'Site\ProductController@show')->name('product');
Route::get('/products', 'Site\ProductController@index')->name('products');

Route::group(['prefix' => 'cart'],function()
{
    Route::post('/add/{product_id}', 'Site\CartController@add')->name('cart.add');
    Route::get('/show', 'Site\CartController@show')->name('cart.show');
    Route::get('/view', 'Site\CartController@view')->name('cart.view');
    Route::delete('/delete/{product_id}', 'Site\CartController@delete')->name('cart.delete');
    Route::get('/clear', 'Site\CartController@clear')->name('cart.clear');
    Route::post('/recalculate', 'Site\CartController@recalculate')->name('cart.recalculate');
});

Route::group(['prefix' => 'wishlist'],function()
{
    Route::post('/add/{product_id}', 'Site\WishListController@add')->name('wishlist.add');
    Route::get('/show', 'Site\WishListController@show')->name('wishlist.show');
    Route::delete('/delete/{product_id}', 'Site\WishListController@delete')->name('wishlist.delete');
    Route::get('/view', 'Site\WishListController@view')->name('wishlist.view');
    Route::get('/clear', 'Site\WishListController@clear')->name('wishlist.clear');
});

Route::get('/checkout', 'Site\CheckoutController@index')->name('checkout');
Route::match(['get', 'post'], '/checkout_finish', 'Site\CheckoutController@finish')->name('checkout_finish');

Route::get('/search', 'Site\SearchController@getresults')->name('search');

Route::match(['get', 'post'], '/login_modal', 'Auth\LoginController@loginmodal')->name('login_modal');
Route::get('/about', 'Site\AboutController@about')->name('about');
Route::get('/shop/{alias}', 'Site\ShopController@shopinfo')->name('shop');
Route::post('/subscribe', 'Site\SubscribeController@index')->name('subscribe');

Route::get('/posts', 'Site\PostController@index')->name('posts');
Route::get('/posts/{alias}', 'Site\PostController@show')->name('post');

Route::get('/cabinet_profile', 'Site\CabinetController@profile_get')->middleware(['auth'])->name('cabinet_profile');
Route::post('/cabinet_profile', 'Site\CabinetController@profile_post')->middleware(['auth'])->name('cabinet_profile');
Route::get('/cabinet_orders', 'Site\CabinetController@orders')->middleware(['auth'])->name('cabinet_orders');

Auth::routes();
Route::match(['get', 'post'], '/login_modal', 'Auth\LoginController@loginmodal')->name('login_modal');

