<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Models\Agriculcultural;
use App\Models\KindOfAgricultural;
use App\Models\UserInfo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/articles/{access_token}', 'App\Http\Controllers\ArticleController@getArticles');
Route::post('/articles', 'App\Http\Controllers\ArticleController@getArticles');

Route::post('/personal_page', 'App\Http\Controllers\ArticleController@getPersonalPage');


Route::post('/create_user_info', 'App\Http\Controllers\UserController@createInfo');
Route::get('/rule/{access_token}', 'App\Http\Controllers\UserController@getRule');
Route::post('/check_new_user', 'App\Http\Controllers\UserController@checkNewUser');
Route::post('/get_user_info', 'App\Http\Controllers\UserController@getUserInfo');
Route::post('/upload_file', 'App\Http\Controllers\UploadController@uploadFile');
Route::post('/upload_avatar', 'App\Http\Controllers\UploadController@uploadAvatar');
Route::post('/upload_article', 'App\Http\Controllers\ArticleController@create');

Route::get('/storage/{filename}', function (Request $request)
{
    $path = storage_path('app\public\\' . $request->filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('/user_info/{access_token}', function ($access_token)
{
    $user = UserInfo::query();
    $user = $user->where('access_token', $access_token)->first();
    response()->json([
        'name' => $user['name'],
        'job' => $user['job'],
        'address' => $user['address'],
        'year_of_birth' =>$user['year_of_birth'],
        'avatar' => $user['avatar']
    ]);
});

Route::post('/price_list', 'App\Http\Controllers\PriceAgriculturalController@getPriceList');
Route::post('/get_data_price_list', 'App\Http\Controllers\PriceAgriculturalController@getDate');

Route::post('/products', 'App\Http\Controllers\ProductController@getProducts');
Route::post('/registered_product', 'App\Http\Controllers\ProductController@registeredProduct');
Route::post('/get_registered_product', 'App\Http\Controllers\ProductController@getRegisteredProduct');

Route::get('set_up_spinner_sell', 'App\Http\Controllers\ProductController@settupSpinner');
Route::get('/add_data', 'App\Http\Controllers\AddDataController@addData');
Route::get('delete/{id}', 'App\Http\Controllers\ProductController@delete')->name('delete');

Route::get('admin_delete/{id}', 'App\Http\Controllers\AdminController@delete')->name('delete');
Route::get('update/{id}', 'App\Http\Controllers\AdminController@update')->name('update');
Route::get('update_all/', 'App\Http\Controllers\AdminController@updateAll')->name('update_all');

Route::post('share', 'App\Http\Controllers\ArticleController@share');
Route::post('like', 'App\Http\Controllers\ArticleController@like');


//php artisan serv --host 192.168.1.7   


