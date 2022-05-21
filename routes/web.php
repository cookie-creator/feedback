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

Route::get('/test', [\App\Http\Controllers\TestController::class, 'index']);
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::group([
        'prefix' => 'manager',
        'middleware' => 'is_manager',
        'as' => 'manager.'
    ], function () {
        Route::resource('/feedback', \App\Http\Controllers\Manager\FeedbackController::class);

        /*Route::get('/feedback', [\App\Http\Controllers\Manager\FeedbackController::class, 'index'])
            ->name('feedback.index');*/
    });

    Route::group([
        'prefix' => 'client',
        'middleware' => 'is_client',
        'as' => 'client.'
    ], function () {
        Route::resource('/feedback', \App\Http\Controllers\Client\FeedbackController::class);

        /*Route::get('/feedback', [\App\Http\Controllers\Client\FeedbackController::class, 'index'])
            ->name('feedback.index');*/
    });
});

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
