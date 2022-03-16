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
Route::get('insert10users', function () {

    factory(App\User::class, 10)->create();
});



// Admin Routes

Route::middleware(['auth'])->group(function(){

    Route::get('/', 'PageController@index')->name('home');

    Route::prefix('admin')->group(function() {

        Route::get('create', 'PageController@create');
        Route::post('create', 'UserController@create');

        Route::get('edit/{id}', 'PageController@edit');
        Route::post('edit/{id}', 'UserController@edit');

        Route::get('media/{id}', 'PageController@media');
        Route::post('media/{id}', 'UserController@media');

        Route::get('profile/{id}', 'PageController@profile');
        Route::post('profile/{id}', 'UserController@profile');

        Route::get('security/{id}', 'PageController@security');
        Route::post('security/{id}', 'UserController@security');

        Route::get('status/{id}', 'PageController@status');
        Route::post('status/{id}', 'UserController@status');
    });


});



// User Services Routes






// Групаируем префиксы в путях
//         /admin/posts
/*Route::prefix('admin')->group(function () {
    Route::get('posts', function() {
        echo 123;
    });

    // используем группу namespace-ов для котроллеров админки
    Route::namespace('Admin')->group(function() {

        // В итоге получится App\Http\Controllers\Admin\PostController
        Route::get('post', 'PostController@index');
    });
});*/

// потом установим middleware
/*Route::middleware(['first', 'second'])->group(function() {
   Route::get('test', function() {
      // Роут использует first и second Middleware
   });
});*/
