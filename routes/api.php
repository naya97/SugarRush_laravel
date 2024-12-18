<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/user-profile', [AuthController::class, 'editUserProfile']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'shop'

], function ($router) {
    Route::get('showShops',[ShopController::class,'showShops']);
    Route::get('showShopDetails',[ShopController::class,'showShopDetails']);
    Route::get('searchShop',[ShopController::class,'searchShop']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'product'

], function() {
    Route::get('showProducts',[ProductController::class, 'showProducts']);
    Route::get('showProductDetails',[ProductController::class, 'showProductDetails']);
    Route::get('searchProduct',[ProductController::class,'searchProduct']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'fav'

], function() {
    Route::post('addToFavourite',[FavouriteController::class,'addToFvourite']);
    Route::delete('removeFavourite',[FavouriteController::class,'removeFavourite']);
    Route::get('showFav',[FavouriteController::class,'showFav']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'order'

], function() {
    Route::post('makeOrder',[OrderController::class,'makeOrder']);
    Route::post('addToCart',[OrderController::class,'addToCart']);
    Route::get('showCart',[OrderController::class,'showCart']);
    Route::post('editCart',[OrderController::class,'editCart']);
    Route::delete('removeFromCart',[OrderController::class,'removeFromCart']);
    Route::post('order',[OrderController::class,'order']);
    Route::get('showOrders',[OrderController::class,'showOrders']);
    Route::get('showOrderDetails',[OrderController::class,'showOrderDetails']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'address'

], function() {
    Route::get('showParentRegion',[AddressController::class,'showParentRegion']);
    Route::get('showChildRegion',[AddressController::class,'showChildRegion']);
});