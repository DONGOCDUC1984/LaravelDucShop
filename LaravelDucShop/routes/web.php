<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;


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
    return redirect('/products');
});

// All users
Route::get('/manage/users', [UsersController::class, "index"])
    ->middleware('isAdmin');

// Delete user
Route::delete(
    '/manage/users/{id}',
    [UsersController::class, 'destroy']
)->middleware('isAdmin');

// All orders
Route::get('/manage/orders', [OrderController::class, "index"])
    ->middleware('isAdmin');

// My orders
Route::get('/myorders', [OrderController::class, "manage"])
    ->middleware('auth');

// Delete order
Route::delete(
    '/manage/orders/{id}',
    [OrderController::class, 'destroy']
);


// All products
Route::get('/products', [ProductController::class, "index"]);

// Search
Route::get('/search', [ProductController::class, "search"]);

// Type of products
Route::get('/products/type/{type}', [ProductController::class, "filtertype"]);

// Price of products
Route::get('/products/price/{n1}/{n2}', [ProductController::class, "filterprice"]);
// Create form
Route::get('/products/create', [ProductController::class, "create"])
    ->middleware('isAdmin');

// Store product data
Route::post('/products', [ProductController::class, "store"])
    ->middleware('isAdmin');

// Edit form
Route::get(
    '/products/edit/{id}',
    [ProductController::class, "edit"]
)->middleware('isAdmin');

Route::put(
    '/products/update/{id}',
    [ProductController::class, 'update']
)->middleware('isAdmin');

// Delete product
Route::delete(
    '/products/{id}',
    [ProductController::class, 'destroy']
)->middleware('isAdmin');


// Add item to cart
Route::get(
    '/addtocart/{id}',
    [ProductController::class, "addtocart"]
)->middleware('auth');

// Decrease cart item's quantity
Route::get(
    '/cart/decreasequan/{id}',
    [ProductController::class, "cartdecreasequan"]
)->middleware('auth');

// Increase cart item's quantity
Route::get(
    '/cart/increasequan/{id}',
    [ProductController::class, "cartincreasequan"]
)->middleware('auth');

// Remove item from cart
Route::get(
    '/cart/removeitem/{id}',
    [ProductController::class, "removefromcart"]
)->middleware('auth');

// Single product
Route::get('/products/{id}', [ProductController::class, "show"]);

// End Product routes

// Store order
Route::post('/order/post', [OrderController::class, "store"])
    ->middleware('auth');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';