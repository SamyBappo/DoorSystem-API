<?php

use App\Http\Controllers\AccessCtrl;
use App\Http\Controllers\CardCtrl;
use App\Http\Controllers\DoorCtrl;
use App\Http\Controllers\LogCtrl;
use App\Http\Controllers\UserCtrl;
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
Route::post('user/auth', [UserCtrl::class, 'authenticate']);
Route::post('user/add', [UserCtrl::class, 'add']);
Route::post('user/update', [UserCtrl::class, 'update']);
Route::post('user/delete', [UserCtrl::class, 'delete']);

// cards
Route::post('card/all', [CardCtrl::class, 'getall']);
Route::post('card/add', [CardCtrl::class, 'add']);
Route::post('card/update', [CardCtrl::class, 'update']);
Route::post('card/delete', [CardCtrl::class, 'delete']);
Route::post('card/check', [CardCtrl::class, 'check']);

// doors
Route::get('door/all', [DoorCtrl::class, 'getall']);
Route::post('door/add', [DoorCtrl::class, 'add']);
Route::post('door/update', [DoorCtrl::class, 'update']);
Route::post('door/delete', [DoorCtrl::class, 'delete']);

// Access
Route::post('access/add', [AccessCtrl::class, 'add']);
Route::post('access/delete', [AccessCtrl::class, 'delete']);
Route::post('access/check', [AccessCtrl::class, 'check']);

//Logs
Route::get('log/week', [LogCtrl::class, 'getPastWeek']);
Route::get('log/month', [LogCtrl::class, 'getPastMonth']);
Route::get('log/year', [LogCtrl::class, 'getPastYear']);
Route::get('log/all', [LogCtrl::class, 'getAll']);