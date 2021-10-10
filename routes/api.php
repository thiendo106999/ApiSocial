<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use Illuminate\Support\Facades\File;
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

Route::get('/data', 'App\Http\Controllers\ArticleController@data');
Route::get('/articles', 'App\Http\Controllers\ArticleController@getArticles');

Route::post('/create_user_info', 'App\Http\Controllers\UserController@createInfo');
Route::post('/create_user_info', 'App\Http\Controllers\UserController@createInfo');
Route::post('/check_new_user', 'App\Http\Controllers\UserController@checkNewUser');
Route::post('/get_use_info', 'App\Http\Controllers\UserController@getUserInfo');
Route::post('/upload_file', 'App\Http\Controllers\UploadController@uploadFile');

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

//php artisan serv --host 192.168.1.7   


