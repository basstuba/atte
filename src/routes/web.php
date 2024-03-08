<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtteController;
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
Route::middleware('auth')->group(function() {
    Route::get('/', [AtteController::class, 'index'])->name('index');
    Route::post('/work/start', [AtteController::class, 'workStart'])->middleware('work.start');
    Route::post('/work/end', [AtteController::class, 'workEnd'])->middleware('work.end');
    Route::post('/break/start', [AtteController::class, 'breakStart'])->middleware('break.start');
    Route::post('/break/end', [AtteController::class, 'breakEnd'])->middleware('break.end');
    Route::get('/attendance', [AtteController::class, 'attendance'])->name('attendance');
    Route::get('/attendance/search/add', [AtteController::class, 'searchAdd']);
    Route::get('/attendance/search/sub', [AtteController::class, 'searchSub']);
});