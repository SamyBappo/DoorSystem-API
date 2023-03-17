<?php

use App\Http\Controllers\cardCtrl;
use App\Http\Controllers\userCtrl;
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

// cards
Route::get('card/all', [cardCtrl::class, 'getall']);
Route::post('card/check', [cardCtrl::class, 'check']);
Route::post('card/add', [cardCtrl::class, 'add']);

//user
Route::post('user/auth', [userCtrl::class, 'authenticate']);
Route::post('user/add', [userCtrl::class, 'add']);
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) { return $request->user();});