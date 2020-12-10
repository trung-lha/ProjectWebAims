<?php

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

Route::prefix('productmodule')->group(function() {
    Route::get('/', 'ProductModuleController@index')->name('trang-chu');
    Route::get('/admin', 'AdminController@index')->name('admin-layout');
    Route::get('/home','ProductModuleController@home')->name('home');

    //Category Product
    Route::get('/add-category-product', 'CategoryProductController@add_category_product')->name('add-category-product');
    Route::get('/all-category-product', 'CategoryProductController@all_category_product')->name('all-category-product');
    
    Route::post('/save-category-product', 'CategoryProductController@save_category_product')->name('save-category-product');
    Route::post('/update-category-product/{category_product_id}', 'CategoryProductController@update_category_product');

    Route::get('/unactive-category-product/{category_product_id}', 'CategoryProductController@unactive_category_product');
    Route::get('/active-category-product/{category_product_id}', 'CategoryProductController@active_category_product');

    Route::get('/edit-category-product/{category_product_id}', 'CategoryProductController@edit_category_product');
    Route::get('/delete-category-product/{category_product_id}', 'CategoryProductController@delete_category_product');

    //Brand Product
    Route::get('/add-brand-product', 'BrandProductController@add_brand_product')->name('add-brand-product');
    Route::get('/all-brand-product', 'BrandProductController@all_brand_product')->name('all-brand-product');
    
    Route::post('/save-brand-product', 'BrandProductController@save_brand_product')->name('save-brand-product');
    Route::post('/update-brand-product/{brand_product_id}', 'BrandProductController@update_brand_product');

    Route::get('/unactive-brand-product/{brand_product_id}', 'BrandProductController@unactive_brand_product');
    Route::get('/active-brand-product/{brand_product_id}', 'BrandProductController@active_brand_product');

    Route::get('/edit-brand-product/{brand_product_id}', 'BrandProductController@edit_brand_product');
    Route::get('/delete-brand-product/{brand_product_id}', 'BrandProductController@delete_brand_product');

    //Product
    Route::get('/add-product', 'ProductController@add_product')->name('add-product');
    Route::get('/all-product', 'ProductController@all_product')->name('all-product');
    
    Route::post('/save-product', 'ProductController@save_product')->name('save-product');
    Route::post('/update-product/{product_id}', 'ProductController@update_product');

    Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');
    Route::get('/active-product/{product_id}', 'ProductController@active_product');

    Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
    Route::get('/delete-product/{product_id}', 'ProductController@delete_product');

});
