<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtteController;
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
Route::middleware('auth')->group(function() {
    Route::get('/', [AtteController::class, 'index'])->name('index');
    Route::post('/work/start', [AtteController::class, 'workStart'])->middleware('work.start');
    Route::post('/work/end', [AtteController::class, 'workEnd'])->middleware('work.end');
    Route::post('/break/start', [AtteController::class, 'breakStart'])->middleware('break.start');
    Route::post('/break/end', [AtteController::class, 'breakEnd'])->middleware('break.end');
    Route::get('/attendance', [AtteController::class, 'attendance'])->name('attendance');
    Route::get('/attendance/search/add', [AtteController::class, 'searchAdd']);
    Route::get('/attendance/search/sub', [AtteController::class, 'searchSub']);
    //追加実装項目分//
    Route::get('/all/user', [AtteController::class, 'allUser'])->name('allUser');
    Route::get('/search', [AtteController::class, 'search']);
    Route::post('/user/list', [AtteController::class, 'userList']);
    Route::get('/user/page', [AtteController::class, 'userPage']);
    Route::get('/page/month/add', [AtteController::class, 'monthAdd']);
    Route::get('/page/month/sub', [AtteController::class, 'monthSub']);
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');