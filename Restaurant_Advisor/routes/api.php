<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/* -----------User Routes-------------------*/

Route::post('/register', [App\Http\Controllers\UserController::class,'register'])->name('u_register');
Route::post('/auth' ,[App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])
                ->middleware('guest')
                ->name('u_auth');
Route::get('/user',[App\Http\Controllers\UserController::class,'get_user'])->name('u_user');
Route::get('/user/{id}',[App\Http\Controllers\UserController::class,'get_u'])->name('u_u');

/* -----------Restaurant Routes-------------------*/
Route::post('/restaurants', [App\Http\Controllers\RestaurantController::class,'create_rest'])->name('r_create');
Route::put('/restaurant/{id}',[App\Http\Controllers\RestaurantController::class,'update_rest'])->name('r_update');
Route::delete('/restaurant/{id}',[App\Http\Controllers\RestaurantController::class,'delete_rest'])->name('r_delete');

/* -----------Menu Routes-------------------*/

Route::post('/restaurants/{id}/menus',[App\Http\Controllers\MenuController::class,'create_menu'])->name('m_create');
Route::put('/restaurants/{id}/menus',[App\Http\Controllers\MenuController::class,'update_menu'])->name('m_update');
Route::delete('/menus/{id}',[App\Http\Controllers\MenuController::class,'delete_menu'])->name('m_delete');