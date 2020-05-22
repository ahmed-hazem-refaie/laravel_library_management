<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
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
    return view("welcome");
});
Route::middleware("auth")->group(function () {
    Route::get('/home', "HomeController@index");
    //Route::get('/userBooks',"BookController@show");
    Route::resource("userBooks", "UserBookController");
    Route::resource("userFavorites", "UserFavouriteController");
    Route::resource('category', 'CategoryController');
    Route::resource('book', 'BookController');
    Route::resource('bookComment', 'BookCommentController');
    Route::resource('bookRate', 'BookRateController');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('activateuser/{id}','ManagerController@activateuser')->name('ACT_USR');

Route::prefix('manager')->name('manager.')->middleware('can:manage-users')->group(function(){
    Route::resource('user','ManagerController',['except' => 'show','create','store']);
    Route::resource('category', 'CategoryController');
    Route::resource('book', 'BookController');
});

// Route::resource('category', 'CategoryController');
// Route::resource('book', 'BookController');



// Book details Controller [For user View ==> Ashraf Amer]
// Route::resource('books', 'BookDetailsController');


Route::get('image/{filename}', 'HomeController@displayImage')->name('image.displayImage');

// Route::get('changeStatus', 'ManagerController@changeStatus');

Route::get('users', 'UserChartController@index')->name('chart');


Route::get('/status/update','ManagerController@updateStatus')->name('users.update.status');
Route::get('status/update','ManagerController@updateStatus')->name('users.update.status');
