<?php

use App\Http\Controllers\SuperAdmin\DocumentController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/super-admin', [SuperAdminController::class, 'index'])->name('super_admin.index');

Route::group(['prefix' => '/super-admin/document', 'as' => 'super_admin.document.'], function() {
    Route::get('/', [DocumentController::class, 'index'])->name('index');
    Route::get('/create', [DocumentController::class, 'create'])->name('create');
    Route::post('/store', [DocumentController::class, 'store'])->name('store');
    Route::get('/{document}', [DocumentController::class, 'show'])->name('show');
    Route::get('/{document}/edit', [DocumentController::class, 'edit'])->name('edit');
    Route::put('/{document}', [DocumentController::class, 'update'])->name('update');
    Route::delete('/{document}', [DocumentController::class, 'destroy'])->name('destroy');
});
