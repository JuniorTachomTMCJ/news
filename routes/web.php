<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\App;
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
    return view('admin.layaout');
});

// Route::group(['prefix' => '{lang}'], function ($lang) {
//     App::setLocale($lang);
//     Route::prefix('admin')->group(function () {
//         Route::resource('category', CategoryController::class);
//     });
// });
// Route::group(['prefix' => '{locale}/admin', 'where' => ['locale' => '[a-zA-Z]{2}']], function ($locale) {
//     if (!in_array($locale, ['en', 'fr'])) {
//         abort(400);
//     }

//     App::setLocale($locale);
//     Route::resource('category', CategoryController::class);
// });

Route::prefix('admin')->group(function () {
    App::setLocale('fr');
    Route::resource('category', CategoryController::class);
    Route::resource('article', ArticleController::class)->parameters(['article' => 'slug']);

    Route::get('/category/{slug}/article', [CategoryController::class, 'showArticles'])->name('article.show.articles');
});