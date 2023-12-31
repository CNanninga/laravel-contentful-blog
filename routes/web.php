<?php

use App\Http\Controllers\BlogController;
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

Route::get('/', [BlogController::class, 'home'])
    ->name('home');

Route::get('/posts', [BlogController::class, 'list'])
    ->name('list-main');

Route::get('/posts/{page}', [BlogController::class, 'list'])
    ->where(['page' => '[0-9]+'])
    ->name('list');

Route::get('/post/{slug}', [BlogController::class, 'post'])
    ->name('post');

Route::get('/publications', [BlogController::class, 'pubs'])
    ->name('publications-main');

Route::get('/publications/{page}', [BlogController::class, 'pubs'])
    ->where(['page' => '[0-9]+'])
    ->name('publications');

Route::get('/courses', [BlogController::class, 'courses'])
    ->name('courses-main');

Route::get('/courses/{page}', [BlogController::class, 'courses'])
    ->where(['page' => '[0-9]+'])
    ->name('courses');
