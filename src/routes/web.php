<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;

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

Route::get('/weight_logs', [WeightLogController::class, 'index'])
    ->middleware('auth')
    ->name('weight_logs.index');

Route::get('/dev-login', function () {
    $user = User::first(); // 1件目を使う（昨日作った test ユーザー）
    Auth::login($user);
    return redirect('/weight_logs');
});

Route::post('/weight_logs', [WeightLogController::class, 'store'])
    ->middleware('auth')
    ->name('weight_logs.store');
