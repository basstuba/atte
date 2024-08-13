<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtteController;
use App\Http\Controllers\DailyController;
use App\Http\Controllers\AllUserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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
Route::middleware('verified')->group(function() {
    Route::get('/', [AtteController::class, 'index'])->name('index');

    Route::post('/work/start', [AtteController::class, 'workStart'])->middleware('work.start');
    Route::post('/work/end', [AtteController::class, 'workEnd'])->middleware('work.end');
    Route::post('/break/start', [AtteController::class, 'breakStart'])->middleware('break.start');
    Route::post('/break/end', [AtteController::class, 'breakEnd'])->middleware('break.end');

    Route::get('/attendance', [DailyController::class, 'attendance'])->name('attendance');
    Route::get('/attendance/search/add', [DailyController::class, 'searchAdd']);
    Route::get('/attendance/search/sub', [DailyController::class, 'searchSub']);

    Route::get('/all/user', [AllUserController::class, 'allUser'])->name('allUser');
    Route::get('/search', [AllUserController::class, 'search']);

    Route::get('/user/list/{user}', [AllUserController::class, 'userList'])->name('userList');
    Route::get('/page/month/add', [AllUserController::class, 'monthAdd']);
    Route::get('/page/month/sub', [AllUserController::class, 'monthSub']);
});