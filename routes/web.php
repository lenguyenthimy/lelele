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

Route::get('/', function () {
    return view('welcome');
});

Route::post('test-route', function () {
    echo "Xin chao cac ban";
});

Route::redirect('/here', '/there');


// Route::prefix('admin')->namespace('Admin')->group(function () {
//     //Route::get('/signin', 'SessionAdminController@new');
//     Route::get('/signup', function () {
//         return view('signup');
//     });
//     Route::post('/signin', 'SessionAdminController@create');
//     Route::delete('/logout', 'SessionAdminController@destroy');

// });

// Route::group(['prefix' => 'admin', 'namspace' => 'Admin'], function () {
//     Route::get('/signup', function () {
//         return view('signup');
//     });
// });
//Route::resource('user', UserController::class);
Route::get('signup', 'UserController@create')->name('signup_form');
Route::post('signup', 'UserController@store')->name('signup');
Route::get('signin', 'SessionController@create')->name('signin_form');
Route::post('signin', 'SessionController@store')->name('signin');
Route::get('logout', 'SessionController@logout')->name('logout');
Route::get('home', 'StaticPagesController@home')->name('home')->middleware('auth');
Route::get('user/{id}/activation_code/{token}', 'ActivationController@create')->name('user.active');