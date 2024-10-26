<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::name("admin.")
    ->prefix("admin")
    ->namespace('App\Http\Controllers\Admin')
    ->middleware(["auth", "role:superadmin"])
    ->group(function (){
        Route::resource("user","UserController");
        Route::resource("permission","PermissionController");
        Route::resource("role","RoleController");
    });

// Route::resource("article", "ArticleController"); yang seperti ini tidak bisa digunakan
Route::resource("article", App\Http\Controllers\ArticleController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

