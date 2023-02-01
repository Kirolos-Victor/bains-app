<?php

use App\Http\Controllers\Frontend\ApplicationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::redirect('/', '/application');
Auth::routes();
Route::get('/application', [ApplicationController::class, 'index'])->name('application');
Route::post('/application', [ApplicationController::class, 'store'])->name('application.store');

//admin
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/applications', [App\Http\Controllers\Backend\ApplicationController::class, 'index']);
    Route::post('/applications', [App\Http\Controllers\Backend\ApplicationController::class, 'applications']);
    Route::post('/applications/{application}', [App\Http\Controllers\Backend\ApplicationController::class, 'toggleStatus']);
    Route::delete('/applications/{application}', [App\Http\Controllers\Backend\ApplicationController::class, 'destroy']);
});
