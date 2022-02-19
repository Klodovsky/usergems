<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Dashboard');
});


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/tweets', [\App\Http\Controllers\TweetController::class, 'index'])->name('tweets.index');
    Route::post('/tweets', [\App\Http\Controllers\TweetController::class, 'store'])->name('tweets.store');

    Route::get('/followings', [\App\Http\Controllers\TweetController::class, 'followings'])->name('tweets.followings');
    Route::post('/unfollows/{user:id}', [\App\Http\Controllers\TweetController::class, 'unfollows'])->name('tweets.followings.store');
    Route::post('/follows/{user:id}', [\App\Http\Controllers\TweetController::class, 'follows'])->name('tweets.followings.store');

});
