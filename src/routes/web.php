<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\WeightTargetController;
use App\Http\Controllers\Auth\RegisterStep1Controller;
use App\Http\Controllers\Auth\RegisterStep2Controller;
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

Route::get('/register/step1', [RegisterStep1Controller::class, 'create'])->name('register.step1');
Route::post('/register/step1', [RegisterStep1Controller::class, 'store']);

Route::get('/register/step2', [RegisterStep2Controller::class, 'create'])->name('register.step2');
Route::post('/register/step2', [RegisterStep2Controller::class, 'store']);

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

Route::get('/weight_logs/{weightLog}', [WeightLogController::class, 'show'])
    ->name('weight_logs.show');

Route::post('/weight_logs/{weightLog}/update', [WeightLogController::class, 'update'])
    ->name('weight_logs.update');

Route::post('/weight_logs/{weightLog}/delete', [WeightLogController::class, 'destroy'])
    ->middleware('auth');

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

Route::get('/home', function () {
    return redirect('/weight_logs');
})->middleware('auth');
