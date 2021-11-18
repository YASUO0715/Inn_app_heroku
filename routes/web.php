<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\OAuthController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [ArticleController::class, 'top'])
    ->name('root');

Route::get('/article/test', [ArticleController::class, 'test'])
->name('root');

Route::resource('articles', ArticleController::class)
    ->middleware(['auth'])
    ->only(['create', 'store', 'edit', 'update', 'destroy']);


Route::resource('articles', ArticleController::class)
    ->only(['index', 'show']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

// authから始まるルーティングに認証前にアクセスがあった場合
Route::prefix('auth')->middleware('guest')->group(function () {
    // auth/githubにアクセスがあった場合はOAuthControllerのredirectToProviderアクションへルーティング
    Route::get('/{provider}', [OAuthController::class, 'redirectToProvider'])
        ->where('provider', 'github|google|line')
        ->name('redirectToProvider');

    // auth/github/callbackにアクセスがあった場合はOAuthControllerのoauthCallbackアクションへルーティング
    Route::get('/{provider}/callback', [OAuthController::class, 'oauthCallback'])
        ->where('provider', 'github|google|line')
        ->name('oauthCallback');
});
