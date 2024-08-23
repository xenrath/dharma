<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\AuthController::class, 'index']);
Route::get('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login_proses']);
Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);

Route::get('profile', [\App\Http\Controllers\HomeController::class, 'profile']);
Route::post('profile', [\App\Http\Controllers\HomeController::class, 'profile_proses']);

Route::post('ketua-search', [\App\Http\Controllers\HomeController::class, 'ketua_search']);
Route::get('ketua-set/{id}', [\App\Http\Controllers\HomeController::class, 'ketua_set']);
Route::post('personel-search', [\App\Http\Controllers\HomeController::class, 'personel_search']);
Route::post('personel-get', [\App\Http\Controllers\HomeController::class, 'personel_get']);
Route::get('hubungi/{telp}', [\App\Http\Controllers\HomeController::class, 'hubungi']);

Route::middleware('dev')->prefix('dev')->group(function () {});

Route::middleware('operator')->prefix('operator')->group(function () {
    Route::get('/', [\App\Http\Controllers\Operator\HomeController::class, 'index']);

    Route::resource('proposal-penelitian', \App\Http\Controllers\Operator\ProposalPenelitianController::class);

    Route::resource('proposal-pengabdian', \App\Http\Controllers\Operator\ProposalPengabdianController::class);

    Route::get('proposal-laporan/print', [\App\Http\Controllers\Operator\ProposalLaporanController::class, 'print']);
    Route::resource('proposal-laporan', \App\Http\Controllers\Operator\ProposalLaporanController::class);

    Route::get('dosen/reset/{id}', [\App\Http\Controllers\Operator\DosenController::class, 'reset']);
    Route::resource('dosen', \App\Http\Controllers\Operator\DosenController::class);
});

Route::middleware('admin')->prefix('admin')->group(function () {});

Route::middleware('dosen')->prefix('dosen')->group(function () {
    Route::get('/', [\App\Http\Controllers\Dosen\HomeController::class, 'index']);
    Route::resource('proposal-penelitian', \App\Http\Controllers\Dosen\ProposalPenelitianController::class);
    Route::resource('proposal-pengabdian', \App\Http\Controllers\Dosen\ProposalPengabdianController::class);
});
