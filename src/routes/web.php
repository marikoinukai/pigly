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

// 最後に削除↓
Route::get('/dev-login', function () {
    $user = User::first(); // 1人目のユーザーでログイン（適宜変更）
    Auth::login($user);
    return redirect()->route('weight_logs.index');
});
// ↑最後に削除

Route::get('/weight_logs/goal_setting', [WeightTargetController::class, 'edit'])
    ->middleware('auth')
    ->name('weight_targets.edit');

Route::post('/weight_logs/goal_setting', [WeightTargetController::class, 'update'])
    ->middleware('auth')
    ->name('weight_targets.update');

Route::get('/weight_logs', [WeightLogController::class, 'index'])
    ->middleware('auth')
    ->name('weight_logs.index');

Route::get('/weight_logs/create', [WeightLogController::class, 'create'])
    ->middleware('auth')
    ->name('weight_logs.create');

Route::post('/weight_logs', [WeightLogController::class, 'store'])
    ->middleware('auth')
    ->name('weight_logs.store');

Route::get('/weight_logs/{weightLog}/edit', [WeightLogController::class, 'edit'])
    ->middleware('auth')
    ->name('weight_logs.edit');

Route::post('/weight_logs/{weightLog}/update', [WeightLogController::class, 'update'])
    ->middleware('auth');

Route::post('/weight_logs/{weightLog}/delete', [WeightLogController::class, 'destroy'])
    ->middleware('auth');
