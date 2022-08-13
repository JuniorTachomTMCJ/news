<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BreakingNewsController;
use App\Http\Controllers\BreakingNewsSettingsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
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

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('front.articles');
    Route::get('/article/{slug}', [FrontController::class, 'articleDetails'])->name('front.article.detail');
    Route::get('/category/{slugCategory}/article', [FrontController::class, 'showArticlesByCategory'])->name('front.show.articles.category');

    Route::prefix('admin')->group(function () {
        App::setLocale('fr');
        // Route::resource('/', [ArticleController::class, 'index'])->parameters(['article' => 'slug']);
        Route::resource('category', CategoryController::class);
        Route::resource('article', ArticleController::class)->parameters(['article' => 'slug']);

        Route::prefix('breakingNews')->group(function () {
            Route::resource('settings', BreakingNewsSettingsController::class, [
                'names' => [
                    'create' => 'breakingNews.setting.create',
                    'store' => 'breakingNews.setting.store',
                    'edit' => 'breakingNews.setting.edit',
                    'update' => 'breakingNews.setting.update',
                    'index' => 'breakingNews.setting.index'
                ]
            ])->parameters(['setting' => 'slug']);
        });

        Route::resource('breakingNews', BreakingNewsController::class);


        Route::get('/category/{slug}/article', [CategoryController::class, 'showArticles'])->name('article.show.articles');
    });
});