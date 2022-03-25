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

// Public Routes

use App\Member;
use Illuminate\Support\Facades\Route;

Route::get('logout', 'UserController@logout');

Route::middleware('guest')->group(function(){
    Route::get('login', 'PageController@login')->name('login');
    Route::post('login', 'UserController@login');
});

Route::get('register', 'PageController@register');
Route::post('register', 'UserController@register');
Route::get('insert10members', function(){

    factory(App\Member::class, 10)->create();

});


// Auth Routes
Route::middleware(['auth'])->group(function(){

    Route::get('/', 'PageController@index')->name('home');
    Route::get('profile/{id}', 'PageController@profile');


    // Admin Routes
    Route::prefix('admin')->group(function() {

        Route::get('create', 'PageController@create');
        Route::post('create', 'UserController@create');

        Route::get('edit/{id}', 'PageController@edit');
        Route::post('edit/{id}', 'UserController@edit');

        Route::get('media/{id}', 'PageController@media');
        Route::post('media/{id}', 'UserController@media');

        Route::get('security/{id}', 'PageController@security');
        Route::post('security/{id}', 'UserController@security');

        Route::get('status/{id}', 'PageController@status');
        Route::post('status/{id}', 'UserController@status');

        Route::get('delete/{id}', 'UserController@delete');
    });

});
