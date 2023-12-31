<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('posts.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //Route::get('/',[PostController::class,'index'])
//    ->name('posts');

    Route::get('/carts',[PostController::class,'carts'])->name('posts');


    Route::resource('categories',
        CategoryController::class);

    Route::resource('brands',
        BrandController::class);

    Route::resource('products',
        ProductController::class);

    Route::resource('roles',
        RoleController::class);

    Route::resource('users',
    UserController::class);

    Route::get('/changeLang/{lang}', function(string $locale){
        if(!in_array($locale,['en','ar'])){
            abort(400);
        }
        \app()->setlocale($locale);
        session()->put('locale',$locale);
        return redirect()->back();
    })->name('changeLang');
});

require __DIR__.'/auth.php';
