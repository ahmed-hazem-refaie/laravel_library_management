<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/home","Api\HomeController@index");
Route::get("/search","Api\HomeController@search");
Route::post("/makeLike","Api\HomeController@makeLike");
Route::post("/makeLikeFavourite","Api\FavouriteController@makeLike");
Route::get("/userFavorites","Api\FavouriteController@index");
Route::get("/myBooks","Api\MyBooksController@index");
Route::post("/makeLikeMyBooks","Api\MyBooksController@makeLikeMyBooks");
