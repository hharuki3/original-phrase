<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/create', [HomeController::class, 'create'])->name('create');
Route::post('/store', [HomeController::class, 'store'])->name('store');
Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('edit');
Route::post('/update', [HomeController::class, 'update'])->name('update');
Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('detail');
Route::post('/destroy', [HomeController::class, 'destroy'])->name('destroy');
Route::post('/category_destroy', [HomeController::class, 'category_destroy'])->name('category_destroy');
Route::get('/quiz', [HomeController::class, 'quiz'])->name('quiz');
Route::get('/category', [HomeController::class, 'category'])->name('category');
Route::get('/group', [HomeController::class, 'group'])->name('group');

Auth::routes();

