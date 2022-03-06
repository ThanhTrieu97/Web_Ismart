<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


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

Route::get('/', function () {
    return view('index');
});

Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function () {

    Route::get('admin/user/list', 'AdminUserController@list');

    Route::get('admin/user/add', 'AdminUserController@add')->middleware('CheckRole');

    Route::post('admin/user/store', 'AdminUserController@store');

    Route::get('admin/user/delete/{id}', 'AdminUserController@delete')->name('delete_user')->middleware('CheckRole');

    Route::get('admin/user/action', 'AdminUserController@action');

    Route::get('admin/user/edit/{id}', 'AdminUserController@edit')->name('user.edit')->middleware('CheckRole');

    Route::post('admin/user/update/{id}', 'AdminUserController@update')->name('user.update')->middleware('CheckRole');


    # MODULE ROLE

    Route::get('admin/role/add_permission', 'AdminRoleController@add_permission');

    Route::post('admin/role/permission', 'AdminRoleController@permission');

    Route::get('admin/role/list_permission', 'AdminRoleController@list_permission');

    Route::get('admin/role/action', 'AdminRoleController@action');

    Route::get('admin/role/delete/{id}', 'AdminRoleController@delete')->name('delete_role')->middleware('CheckRole');

    Route::get('admin/role/edit/{id}', 'AdminRoleController@edit')->name('role.edit')->middleware('CheckRole');

    Route::post('admin/role/update/{id}', 'AdminRoleController@update')->name('role.update')->middleware('CheckRole');

    # MODULE PAGE

    Route::get('admin/page/list_page', 'AdminPageController@list_page')->name('admin.page.list');

    Route::get('admin/page/add_page', 'AdminPageController@add_page');

    Route::post('admin/page/store', 'AdminPageController@store')->name('admin.page.store');

    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::get('admin/page/action', 'AdminPageController@action');

    Route::get('admin/page/delete/{id}', 'AdminPageController@delete')->name('delete_page')->middleware('CheckRole');

    Route::get('admin/page/edit/{id}', 'AdminPageController@edit')->name('page.edit')->middleware('CheckRole');

    Route::post('admin/page/update/{id}', 'AdminPageController@update')->name('page.update')->middleware('CheckRole');

    #MODULE PRODUCT

    Route::get('admin/product/list', 'AdminProductController@list');

    Route::get('admin/product/add', 'AdminProductController@add');

    Route::post('admin/product/store', 'AdminProductController@store')->name('admin.product.store');

    Route::get('admin/product/list_cat', 'AdminProductController@list_cat');

    Route::get('admin/product/add_cat', 'AdminProductController@add_cat');

    Route::post('admin/product/store_cat', 'AdminProductController@store_cat')->name('admin.product.store_cat');

    Route::get('admin/product/delete/{id}', 'AdminProductController@delete')->name('delete_product')->middleware('CheckRole');

    Route::get('admin/product/edit/{id}', 'AdminProductController@edit')->name('product.edit')->middleware('CheckRole');

    Route::get('admin/product/delete_cat/{id}', 'AdminProductController@delete_cat')->name('delete_product_cat')->middleware('CheckRole');

    Route::get('admin/product/edit_cat/{id}', 'AdminProductController@edit_cat')->name('product_cat.edit')->middleware('CheckRole');

    Route::post('admin/product/update/{id}', 'AdminProductController@update')->name('product.update')->middleware('CheckRole');

    Route::post('admin/product/update_cat/{id}', 'AdminProductController@update_cat')->name('product_cat_update')->middleware('CheckRole');

    Route::get('admin/product/action', 'AdminProductController@action');

    Route::get('admin/product/detail_product/{id}', 'AdminProductController@detail')->name('detail_product');


    Route::get('admin/product/add_image', 'AdminProductController@add_image')->name('add_image')->middleware('CheckRole');

    Route::post('admin/product/store_image', 'AdminProductController@store_image')->name('admin.product.store_image');

    Route::get('admin/product/list_image', 'AdminProductController@list_image');

    Route::get('admin/product/delete_image/{id}', 'AdminProductController@delete_image')->name('delete_product_image')->middleware('CheckRole');

    Route::get('admin/product/edit_image/{id}', 'AdminProductController@edit_image')->name('product_image.edit')->middleware('CheckRole');

    Route::post('admin/product/update_image/{id}', 'AdminProductController@update_image')->name('product_image.update')->middleware('CheckRole');


    Route::get('admin/product/list_product_type', 'AdminProductTypeController@list_product_type');

    Route::get('admin/product/add_product_type', 'AdminProductTypeController@add_product_type');

    Route::post('admin/product/store_product_type', 'AdminProductTypeController@store_product_type')->name('admin.store_product_type');

    Route::get('admin/product_type/delete/{id}', 'AdminProductTypeController@delete_product_type')->name('delete_product_type')->middleware('CheckRole');



     # MODULE POST

    Route::get('admin/post/list', 'AdminPostController@list');

    Route::get('admin/post/add', 'AdminPostController@add');

    Route::get('admin/post/list_cat', 'AdminPostController@list_cat');

    Route::get('admin/post/add_cat', 'AdminPostController@add_cat');

    Route::post('admin/post/store_cat', 'AdminPostController@store_cat')->name('admin.post.store_cat');

    Route::get('admin/post/delete_cat/{id}', 'AdminPostController@delete_cat')->name('delete_post_cat')->middleware('CheckRole');

    Route::get('admin/post/edit_cat/{id}', 'AdminPostController@edit_cat')->name('post_cat.edit')->middleware('CheckRole');

    Route::post('admin/post/update_cat/{id}', 'AdminPostController@update_cat')->name('update_cat')->middleware('CheckRole');

    Route::get('admin/post/action', 'AdminPostController@action');

    Route::post('admin/post/store', 'AdminPostController@store')->name('admin.post.store');

    Route::get('admin/post/delete/{id}', 'AdminPostController@delete')->name('delete_post')->middleware('CheckRole');

    Route::get('admin/post/edit/{id}', 'AdminPostController@edit')->name('post.edit')->middleware('CheckRole');

    Route::post('admin/post/update/{id}', 'AdminPostController@update')->name('post.update')->middleware('CheckRole');


    # MODULE SLIDER

    Route::get('admin/slider/list', 'AdminSliderController@list');

    Route::get('admin/slider/add', 'AdminSliderController@add');

    Route::post('admin/slider/store', 'AdminSliderController@store');

    Route::get('admin/slider/delete/{id}', 'AdminSliderController@delete')->name('delete_slider')->middleware('CheckRole');

    Route::get('admin/slider/action', 'AdminSliderController@action');

    Route::get('admin/slider/edit/{id}', 'AdminSliderController@edit')->name('slider.edit')->middleware('CheckRole');

    Route::post('admin/slider/update/{id}', 'AdminSliderController@update')->name('slider.update')->middleware('CheckRole');

    Route::get('admin/slider/action', 'AdminSliderController@action');


    # MODULE ORDER
    Route::get('admin/order/list', 'AdminOrderController@list');

    Route::get('admin/order/delete/{id}', 'AdminOrderController@delete')->name('delete_order')->middleware('CheckRole');

    Route::get('admin/order/action', 'AdminOrderController@action');

    # MODULE DASHBOARD

    Route::get('dashboard', 'DashboardController@show')->name('dashboard');

    Route::get('admin', 'DashboardController@show')->name('admin');

    // Route::get('admin/order/delete_dá/{id}', 'DashboardController@delete')->name('delete_order_dashboard')->middleware('CheckRole');

    Route::get('admin/dashboard/detail/{id}', 'DashboardController@detail')->name('detail');

    // Route::get('admin/order/action', 'DashboardController@action');

    #MODULE BANNER

    Route::get('admin/banner/list', 'AdminBannerController@list');

    Route::get('admin/banner/add', 'AdminBannerController@add');

    Route::post('admin/banner/store', 'AdminBannerController@store');

    Route::get('admin/banner/delete/{id}', 'AdminBannerController@delete')->name('delete_banner')->middleware('CheckRole');

    Route::get('admin/banner/action', 'AdminBannerController@action');

    Route::get('admin/banner/edit/{id}', 'AdminBannerController@edit')->name('banner.edit')->middleware('CheckRole');

    Route::post('admin/banner/update/{id}', 'AdminBannerController@update')->name('banner.update')->middleware('CheckRole');

    Route::get('admin/banner/action', 'AdminBannerController@action');


});

# PHẦN DISPLAY

Route::get('/', 'IndexController@show');

// Route::post('search', 'SearchController@search')->name('search');

Route::get('search', 'SearchController@getSearch')->name('searchname');
Route::post('search/name', 'SearchController@getSearchAjax')->name('search');

Route::get('detail/product/{id}', "IndexController@detailProduct")->name('detail.product.show');

Route::get('list_product/{id}', 'IndexController@list_product')->name('list_product');

Route::get('all_list_product/{cat_id}.html', 'IndexController@all_product')->name('all_product');

Route::get('post/{id}', 'IndexController@post')->name('post.all');

Route::get('detail/post/{id}', 'IndexController@detailpost')->name('detail.post');

Route::get('contact', 'IndexController@contact')->name('contact');


# PHẦN GIỎ HÀNG

Route::get('cart/show', 'CartController@show');

Route::get('cart/add/{id}', 'CartController@add_cart')->name('cart.add');

Route::get('cart/remove/{rowId}', 'CartController@remove')->name('cart.remove');

Route::get('cart/destroy', 'CartController@destroy')->name('cart.destroy');

Route::post('cap/nhat', 'CartController@cart_update')->name('cart.update.all');

Route::get('cart/update/{id}', 'CartController@update')->name('cart.update');

# PHÂNG THANH TOÁN

Route::get('chekout', 'CartController@checkout')->name('checkout');

Route::get('/ajax/', 'CartController@getLocation')->name('ajax_get.location');

// Route::get('thanh-toan', 'CartController@getFormPay')->name(('get.form.pay'));

Route::get('dat-hang', 'CartController@saveInfoCart')->name('save.cart');
