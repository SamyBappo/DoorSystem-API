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
//user
Route::post('user/auth', [userCtrl::class, 'authenticate']);
Route::post('user/add', [userCtrl::class, 'add']);
Route::post('user/update', [userCtrl::class, 'update']);
Route::post('user/delete', [userCtrl::class, 'delete']);

// cards
Route::get('card/all', [cardCtrl::class, 'getall']);
Route::post('card/check', [cardCtrl::class, 'check']);
Route::post('card/add', [cardCtrl::class, 'add']);
Route::post('card/update', [cardCtrl::class, 'update']);
Route::post('card/delete', [cardCtrl::class, 'delete']);

// doors
Route::get('door/all', [doorCtrl::class, 'getall']);
Route::post('door/add', [doorCtrl::class, 'add']);
Route::post('door/update', [doorCtrl::class, 'update']);
Route::post('door/delete', [doorCtrl::class, 'delete']);

// Access
Route::post('access/add', [accessCtrl::class, 'add']);
Route::post('access/delete', [accessCtrl::class, 'delete']);
Route::post('access/check', [accessCtrl::class, 'check']);

//Logs
Route::get('log/week', [logCtrl::class, 'getPastWeek']);
Route::get('log/month', [logCtrl::class, 'getPastMonth']);
Route::get('log/year', [logCtrl::class, 'getPastYear']);
Route::get('log/all', [logCtrl::class, 'getAll']);
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) { return $request->user();});