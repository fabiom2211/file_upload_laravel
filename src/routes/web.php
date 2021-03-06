<?php

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

Route::get('/', [\App\Http\Controllers\FileUploadController::class, 'index']);
Route::get('/files', [\App\Http\Controllers\FileUploadController::class, 'index'])->name("list_file");
Route::get('/data/{fileId}', [\App\Http\Controllers\DataController::class, 'index'])->name("list_data");
Route::get('/upload-file', [\App\Http\Controllers\FileUploadController::class, 'createForm'])->name("upload");
Route::post('/upload-file', [\App\Http\Controllers\FileUploadController::class, 'fileUpload'])->name('fileUpload');
Route::get('/file/{fileId}/download', [\App\Http\Controllers\FileUploadController::class, 'download'])->name('download');

Auth::routes();

Route::get('/home', [App\Http\Controllers\FileUploadController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\LogoutController::class, 'perform'])->name('logout');
