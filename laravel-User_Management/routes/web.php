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

Route::get('test', function () {
    return view('welcome');
});

Route::get('/', 'UserController@index');


// Групаируем префиксы в путях
//         /admin/posts
Route::prefix('admin')->group(function () {
    Route::get('posts', function() {
        echo 123;
    });

    // используем группу namespace-ов для котроллеров админки
    Route::namespace('Admin')->group(function() {

        // В итоге получится App\Http\Controllers\Admin\PostController
        Route::get('post', 'PostController@index');
    });
});

// потом установим middleware
/*Route::middleware(['first', 'second'])->group(function() {
   Route::get('test', function() {
      // Роут использует first и second Middleware
   });
});*/
