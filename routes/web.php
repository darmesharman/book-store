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
Route::redirect('/', '/books');
Route::resource('/books', \App\Http\Controllers\BookController::class );
Route::get('/books/gen/{genre}', [\App\Http\Controllers\BookController::class,'booksByGenre'])->name('books.genre');
// Route::redirect('/', '/user');
Route::resource('/user', \App\Http\Controllers\UserController::class );

// Route::redirect('/', '/admin');
Route::resource('/admin', \App\Http\Controllers\AdminController::class );
// Route::get('/admin',[\App\Http\Controllers\AdminController::class,'index'])->name('admin.index');
//Route::get('/admin/show',[\App\Http\Controllers\BookController::class,'show'])->name('admin.showbook');
//Route::get('/admin',[\App\Http\Controllers\Auth\LoginController::class,'authenticated'])->name('admin');
//Route::get('/user',[\App\Http\Controllers\Auth\LoginController::class,'authenticated'])->name('user');
//Route::redirect('/', '/admin');
//Route::resource('/admin', \App\Http\Controllers\BookController::class );
// Route::redirect('/', '/authors');
Route::resource('/authors', \App\Http\Controllers\AuthorController::class );

// Route::redirect('/', '/genres');
Route::resource('/genres', \App\Http\Controllers\GenreController::class );
Route::get('/basket', [\App\Http\Controllers\BasketController::class,'index'])->name('basket.index');
//Route::get( '/author', [\App\Http\Controllers\AuthorController::class , 'index'])->name('author.index_author');
//Route::get( '/author', [\App\Http\Controllers\AuthorController::class , 'create'])->name('author.create_author');
//Route::get( '/author', [\App\Http\Controllers\AuthorController::class , 'edit'])->name('author.edit_author');
//Route::get( '/author', [\App\Http\Controllers\AuthorController::class , 'destroy']);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'loginForm'])->name('loginform');
Route::post('/login',[\App\Http\Controllers\Auth\LoginController::class,'login'])->name('login');
Route::post('/logout',[\App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');

Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'registerForm'])->name('registerform');
Route::post('/register',[\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');


Route::resource('users', \App\Http\Controllers\UserController::class);
// Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
//     Route::get('/',[\App\Http\Controllers\UserController::class,'index'])->name('user.index_user');
// });

// Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
//    Route::get('/', [\App\Http\Controllers\AdminController::class,'index'])->name('admin.index_book_admin');
// });

Route::get('/korzina', [\App\Http\Controllers\BookController::class, 'korzina'])->name('korzina');
Route::post('/korzina', [\App\Http\Controllers\BookController::class, 'toKorzina'])->name('toKorzina');
Route::put('/buy', [\App\Http\Controllers\BookController::class, 'buy'])->name('buy');
Route::delete('/fromKorzina', [\App\Http\Controllers\BookController::class, 'fromKorzina'])->name('fromKorzina');
Route::post('/checkout', [\App\Http\Controllers\BookController::class, 'checkout'])->name('checkout');
Route::get('/myPurchases', [\App\Http\Controllers\BookController::class, 'purchases'])->name('purchases');
