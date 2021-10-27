<?php

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

Route::get('uploadfile', function () {
    if (Auth::check()) {
        return view('form');
    }
    return redirect("login")->withSuccess('You are not allowed to access');
    
})->name('uploadfile');

Route::get('product', function () {
    if (Auth::check()) {
        $datas = Product::query()->where('status', 'approved')->get();
        $products = array();
        foreach ($datas as $product) {
            $temp['name'] = $product->name;
            $temp['user_name'] = UserInfo::find($product->user_id)->pluck('name')->first();
            $temp['phone_number'] = $product->phone_number;
            $temp['address'] = $product->address;
            $temp['date'] = $product->date;
            $temp['hexta'] = $product->hexta;
            array_push($products, $temp);
        }
        return view('form_product')->with(['products' => $products]);
    }
    return redirect("login")->withSuccess('You are not allowed to access');
    
})->name('product');

Route::get('get_registered_product', function () {
    if (Auth::check()) {
        $products = Product::query()->where('status', 'registered')->get();
        $datas = array();
        foreach ($products as $product) {
            $data = [];
            $data['name'] = $product->name;
            $data['user_name'] = UserInfo::query()->where('id', $product->user_id)->value('name');
            $data['address'] = $product->address;
            $data['phone_number'] = $product->phone_number;
            $data['image'] = $product->image;
            $data['date'] = $product->date;
            $data['hexta'] = $product->hexta;
            $data['status'] = $product->status;
            array_push($datas, $data);
        }
        return view('form_product')->with(['products' => $datas]);
    }
    return redirect("login")->withSuccess('You are not allowed to access');
    
})->name('get_registered_product');

Route::post('upload', [UpdatePriceController::class, 'uploadFileCSV'])->name('upload.handle');
