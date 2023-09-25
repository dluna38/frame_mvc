<?php

use App\Http\Controllers\api\CategoryControllerApi;
use App\Http\Controllers\api\UserControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\PostControllerApi;
use App\Models\User;

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

const MIDDLE_AUTH_USR_ADMIN=['auth:sanctum','ability:'.User::ROLES["USER"].",".User::ROLES["ADMIN"]];
const MIDDLE_AUTH_ADMIN=['auth:sanctum','ability:'.User::ROLES["ADMIN"]];


Route::controller(PostControllerApi::class)->group(function () {
    Route::get('post/{post}','show');
    Route::get('post','index');
    Route::get('category',[CategoryControllerApi::class,'index']);
    Route::get('category/{category}',[CategoryControllerApi::class,'show']);
});
Route::middleware(MIDDLE_AUTH_USR_ADMIN)->group(function (){
    Route::post('post',[PostControllerApi::class,'store']);
    Route::put('post/{post}',[PostControllerApi::class,'update']);
    Route::delete('post/{post}',[PostControllerApi::class,'destroy']);
});

Route::middleware(MIDDLE_AUTH_ADMIN)
->resource('category',CategoryControllerApi::class)->only([
    'store','destroy','update'
]);

Route::post('auth/user/register',[UserControllerApi::class,'store']);
Route::post('auth/user/registera',[UserControllerApi::class,'storeAdmin']);

Route::post('auth/user/login',[UserControllerApi::class,'logIn']);
Route::middleware('auth:sanctum')->get('auth/user/logout',[UserControllerApi::class,'logOut']);


Route::middleware(MIDDLE_AUTH_USR_ADMIN)->get('auth/user/test', function (Request $request) {
    return "autenticado";
});





//laravel redirect for 401 -> 'login'
Route::get('auth/unauthenticated', function (Request $request) {
    return response(
        "unauthenticated",401
    );
})->name('login');