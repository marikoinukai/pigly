<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\WeightTargetController;

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

Route::get('/weight_logs/create', [WeightLogController::class, 'create'])
    ->middleware('auth')
    ->name('weight_logs.create');

Route::post('/weight_logs', [WeightLogController::class, 'store'])
    ->middleware('auth')
    ->name('weight_logs.store');

Route::get('/weight_logs/{weightLog}/edit', [WeightLogController::class, 'edit'])
    ->middleware('auth')
    ->name('weight_logs.edit');


Route::put('/weight_logs/{weightLog}', [WeightLogController::class, 'update'])
    ->middleware('auth')
    ->name('weight_logs.update');


Route::delete('/weight_logs/{weightLog}', [WeightLogController::class, 'destroy'])
    ->middleware('auth')
    ->name('weight_logs.destroy');

// 課題仕様用（追加）
Route::post('/weight_logs/{weightLog}/update', [WeightLogController::class, 'update'])
    ->middleware('auth');

Route::post('/weight_logs/{weightLog}/delete', [WeightLogController::class, 'destroy'])
    ->middleware('auth');

// 課題仕様用（追加）ここまで

Route::get('/weight_logs/goal_setting', [WeightTargetController::class, 'edit'])
    ->middleware('auth')
    ->name('weight_targets.edit');

Route::post('/weight_logs/goal_setting', [WeightTargetController::class, 'update'])
    ->middleware('auth')
    ->name('weight_targets.update');
