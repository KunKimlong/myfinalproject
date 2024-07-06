<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\LogoController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DiscountController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Frontend\NewsController AS NewsFrontController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\ShopController;

Route::get('/',[HomeController::class,'index']);
Route::get('/product/{id}',[HomeController::class,'productDetail']);
Route::get('/shop',[ShopController::class,'index']);
Route::get('/search',[SearchController::class,'index']);
Route::get('/news',[NewsFrontController::class,'index']);
Route::get('/news-detail/{id}',[NewsFrontController::class,'newsDetail']);


Route::controller(UserController::class)->group(function(){
    Route::get('/login','openLogin')->name('login');
    Route::post('/login','login');
    Route::get('/register','openRegister')->name('openRegister');
    Route::post('/register','register')->name('register');
});

Route::middleware('auth')->group(function(){
    Route::prefix('/dashboard')->group(function(){
        Route::get('/',function(){
            return view('Backend.index');
        })->name('home');
        Route::controller(LogoController::class)->group(function(){
            // route create in this case are access LogoController
            Route::get('/view-logo','index')->name('openLogo');
            Route::get('/add-logo','openAddLogo')->name('openAddLogo');
            Route::post('/add-logo','addLogo')->name('addLogo');
            Route::get('/update-logo/{id}','openUpdateLogo')->name('openUpdateLogo');
            Route::post('/update-logo','updateLogo')->name('updateLogo');
            Route::post('/delete-logo','deleteLogo')->name('deleteLogo');
        });
        Route::controller(ColorController::class)->group(function(){
            Route::get('/view-color','index')->name('viewColor');
            Route::get('/add-color','openAdd')->name('openAddColor');
            Route::post('/add-color','create')->name('addColor');
            Route::get("/update-Color/{id}",'openUpdate')->name('openUpdateColor');
            Route::post('/update-Color','update')->name('updateColor');
            Route::post('/delete-Color','delete')->name('deleteColor');
        });

        Route::controller(DiscountController::class)->group(function(){
            Route::get('/view-discount','index')->name('viewDiscount');
            Route::get('/add-discount','openAdd')->name('openAddDiscount');
            Route::post('/add-discount','create')->name('addDiscount');
            Route::get("/update-discount/{id}",'openUpdate')->name('openUpdateDiscount');
            Route::post('/update-discount','update')->name('updateDiscount');
            Route::post('/delete-discount','delete')->name('deleteDiscount');
        });
        Route::controller(CategoryController::class)->group(function(){
            Route::get('/view-category','index')->name('viewCategory');
            Route::get('/add-category','openAdd')->name('openAddCategory');
            Route::post('/add-category','create')->name('addCategory');
            Route::get("/update-category/{id}",'openUpdate')->name('openUpdateCategory');
            Route::post('/update-category','update')->name('updateCategory');
            Route::post('/delete-category','delete')->name('deleteCategory');
        });
        Route::controller(SizeController::class)->group(function(){
            Route::get('/view-size','index')->name('viewSize');
            Route::get('/add-size','openAdd')->name('openAddSize');
            Route::post('/add-size','create')->name('addSize');
            Route::get("/update-size/{id}",'openUpdate')->name('openUpdateSize');
            Route::post('/update-size','update')->name('updateSize');
            Route::post('/delete-size','delete')->name('deleteSize');
        });
        Route::controller(ProductController::class)->group(function(){
            Route::get('/view-product','index')->name('viewProduct');
            Route::get('/add-product','openAdd')->name('openAddProduct');
            Route::post('/add-product','create')->name('addProduct');
            Route::get("/update-product/{id}",'openUpdate')->name('openUpdateProduct');
            Route::post('/update-product','update')->name('updateProduct');
            Route::post('/delete-product','delete')->name('deleteProduct');
            Route::get('/search-product','search')->name('searchProduct');
        });
        Route::controller(NewsController::class)->group(function(){
            Route::get('/view-news','index')->name('viewNews');
            Route::get('/add-news','openAdd')->name('openAddNews');
            Route::post('/add-news','create')->name('addNews');
            Route::get("/update-news/{id}",'openUpdate')->name('openUpdateNews');
            Route::post('/update-news','update')->name('updateNews');
            Route::post('/delete-news','delete')->name('deleteNews');
        });
    });
    Route::post('/logout',[UserController::class,'logout']);
});

