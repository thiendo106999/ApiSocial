<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UpdatePriceController;
use App\Models\Product;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
    return view('welcome');
});

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::get('uploadfile', [AdminController::class, 'uploadFile'])->name('uploadfile');

Route::get('product', [AdminController::class, 'getProducts'])->name('product');

Route::get('get_registered_product', [AdminController::class, 'getRegisteredProducts'])->name('get_registered_product');

Route::post('upload', [UpdatePriceController::class, 'uploadFileCSV'])->name('upload.handle');
