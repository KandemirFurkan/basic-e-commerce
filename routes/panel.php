<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\PageSeoController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ImageSeoController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ImageUploadController;



Route::group(['middleware'=> ['panelsetting','auth'],'prefix'=>'panel','as'=>'panel.'], function(){

    Route::get('/', [DashboardController::class,'index'])->name('index');
    /*Slider*/
    Route::get('/slider', [SliderController::class,'index'])->name('slider.index');
    Route::get('/slider/ekle', [SliderController::class,'create'])->name('slider.create');
    Route::get('/slider/{id}/edit', [SliderController::class,'edit'])->name('slider.edit');
    Route::post('/slider/store', [SliderController::class,'store'])->name('slider.store');
    Route::put('/slider/{id}/update', [SliderController::class,'update'])->name('slider.update');
    Route::delete('/slider/destroy', [SliderController::class,'destroy'])->name('slider.destroy');
    Route::post('/slider-durum/update', [SliderController::class,'status'])->name('slider.status');

    /*Category */
    Route::resource('/category', CategoryController::class)->except('destroy');
    Route::delete('/category/destroy', [CategoryController::class,'destroy'])->name('category.destroy');
    Route::post('/category-durum/update', [CategoryController::class,'status'])->name('category.status');

    /*About */
    Route::get('/about', [AboutController::class,'index'])->name('about.index');
    Route::post('/about/update', [AboutController::class,'update'])->name('about.update');

    /*Contact */
    Route::get('/contact', [ContactController::class,'index'])->name('contact.index');
    Route::get('/contact/{id}/edit', [ContactController::class,'edit'])->name('contact.edit');
    Route::put('/contact/{id}/update', [ContactController::class,'update'])->name('contact.update');
    Route::delete('/contact/destroy', [ContactController::class,'destroy'])->name('contact.destroy');
    Route::post('/contact-durum/update', [ContactController::class,'status'])->name('contact.status');

    /*Site Settings*/
    Route::get('/setting', [SettingController::class,'index'])->name('setting.index');
    Route::get('/setting/create', [SettingController::class,'create'])->name('setting.create');
    Route::post('/setting/store', [SettingController::class,'store'])->name('setting.store');
    Route::get('/setting/{id}/edit', [SettingController::class,'edit'])->name('setting.edit');
    Route::put('/setting/{id}/update', [SettingController::class,'update'])->name('setting.update');
    Route::delete('/setting/destroy', [SettingController::class,'destroy'])->name('setting.destroy');

    /*Product */
    Route::resource('/product', ProductController::class)->except('destroy');

    Route::get('/product-export', [ProductController::class,'export'])->name('product.export');

    Route::get('/product-import', [ProductController::class,'import'])->name('product.import');
    Route::post('/product-import', [ProductController::class,'importStore'])->name('product.importStore');

    Route::delete('/product/destroy', [ProductController::class,'destroy'])->name('product.destroy');
    Route::post('/product-durum/update', [ProductController::class,'status'])->name('product.status');


    /*Order */
    Route::get('/order', [OrderController::class,'index'])->name('order.index');
    Route::get('/order/{id}/edit', [OrderController::class,'edit'])->name('order.edit');
    Route::put('/order/{id}/update', [OrderController::class,'update'])->name('order.update');
    Route::delete('/order/destroy', [OrderController::class,'destroy'])->name('order.destroy');
    Route::post('/order-durum/update', [OrderController::class,'status'])->name('order.status');


    Route::post('/image-gorsel/vitrin', [ImageUploadController::class,'vitrin'])->name('vitrin.yap');
    Route::delete('/image-gorsel/destroy', [ImageUploadController::class,'destroy'])->name('image.resimSil');


    /*Seo Settings*/
    Route::get('/pageseo', [PageSeoController::class,'index'])->name('pageseo.index');
    Route::get('/pageseo/create', [PageSeoController::class,'create'])->name('pageseo.create');
    Route::post('/pageseo/store', [PageSeoController::class,'store'])->name('pageseo.store');
    Route::get('/pageseo/{id}/edit', [PageSeoController::class,'edit'])->name('pageseo.edit');
    Route::put('/pageseo/{id}/update', [PageSeoController::class,'update'])->name('pageseo.update');
    Route::delete('/pageseo/destroy', [PageSeoController::class,'destroy'])->name('pageseo.destroy');


    /*Image Seo*/
    Route::get('/imageseo', [ImageSeoController::class,'index'])->name('imageseo.index');
    Route::delete('/imageseo/destroy', [ImageSeoController::class,'destroy'])->name('imageseo.destroy');
    Route::post('/imageseo/update', [ImageSeoController::class,'update'])->name('imageseo.update');

      /*Coupon*/
    Route::get('/coupons', [CouponController::class,'index'])->name('coupons.index');
    Route::get('/coupons/ekle', [CouponController::class,'create'])->name('coupons.create');
    Route::get('/coupons/{id}/edit', [CouponController::class,'edit'])->name('coupons.edit');
    Route::post('/coupons/store', [CouponController::class,'store'])->name('coupons.store');
    Route::put('/coupons/{id}/update', [CouponController::class,'update'])->name('coupons.update');
    Route::delete('/coupons/destroy', [CouponController::class,'destroy'])->name('coupons.destroy');
    Route::post('/coupons-durum/update', [CouponController::class,'status'])->name('coupons.status');


/*Chart */
    Route::get('/chart', [DashboardController::class,'orderchart'])->name('order.chart');

});






