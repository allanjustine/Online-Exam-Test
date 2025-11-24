<?php

use App\Http\Controllers\EmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicApiController;
use App\Http\Controllers\UsersController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('admin', [PublicApiController::class, 'getUserDetails'])->name('details');
Route::get('results', [PublicApiController::class, 'resultData'])->name('resultData');
Route::post('admin/update', [UsersController::class, 'update'])->name('updateAdmin');
Route::post('change-password', [PublicApiController::class, 'ChangePassword'])->name('change.password');
Route::get('verifycode', [PublicApiController::class, 'checkCode'])->name('check.code');
Route::post('sendmail/{token}/{name}/{email}/{id}', [EmailController::class, 'sendmail']);
Route::post('verifymail', [EmailController::class, 'verifyEmail'])->name('verify.email');
