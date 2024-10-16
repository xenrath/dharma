<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\AuthController::class, 'index']);
Route::get('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login_proses']);
Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
// 
Route::get('profile', [\App\Http\Controllers\HomeController::class, 'profile']);
Route::post('profile', [\App\Http\Controllers\HomeController::class, 'profile_proses']);
Route::post('ttd', [\App\Http\Controllers\HomeController::class, 'ttd']);
Route::get('ubah-password', [\App\Http\Controllers\HomeController::class, 'ubah_password']);
Route::post('ubah-password', [\App\Http\Controllers\HomeController::class, 'ubah_password_proses']);
// 
Route::post('ketua-search', [\App\Http\Controllers\HomeController::class, 'ketua_search']);
Route::get('ketua-set/{id}', [\App\Http\Controllers\HomeController::class, 'ketua_set']);
Route::post('personel-search', [\App\Http\Controllers\HomeController::class, 'personel_search']);
Route::post('personel-get', [\App\Http\Controllers\HomeController::class, 'personel_get']);
Route::get('hubungi/{telp}', [\App\Http\Controllers\HomeController::class, 'hubungi']);
Route::post('proposal-get', [\App\Http\Controllers\HomeController::class, 'proposal_get']);
// 
Route::get('jadwal/{id}', [\App\Http\Controllers\HomeController::class, 'jadwal']);
// 
Route::middleware('dev')->prefix('dev')->group(function () {
    Route::get('/', [\App\Http\Controllers\Dev\HomeController::class, 'index']);

    Route::resource('proposal', \App\Http\Controllers\Dev\ProposalController::class);
    // 
    Route::get('user/operator', [\App\Http\Controllers\Dev\UserController::class, 'create_operator']);
    Route::post('user/operator', [\App\Http\Controllers\Dev\UserController::class, 'store_operator']);
    // 
    Route::get('user/dosen', [\App\Http\Controllers\Dev\UserController::class, 'create_dosen']);
    Route::post('user/dosen', [\App\Http\Controllers\Dev\UserController::class, 'store_dosen']);
    // 
    Route::get('user/operator/{id}', [\App\Http\Controllers\Dev\UserController::class, 'edit_operator']);
    Route::post('user/operator/{id}', [\App\Http\Controllers\Dev\UserController::class, 'update_operator']);
    // 
    Route::get('user/dosen/{id}', [\App\Http\Controllers\Dev\UserController::class, 'edit_dosen']);
    Route::post('user/dosen/{id}', [\App\Http\Controllers\Dev\UserController::class, 'update_dosen']);
    // 
    Route::post('user/reset/{id}', [\App\Http\Controllers\Dev\UserController::class, 'reset']);
    Route::get('user/trash', [\App\Http\Controllers\Dev\UserController::class, 'trash']);
    Route::post('user/restore/{id?}', [\App\Http\Controllers\Dev\UserController::class, 'restore']);
    Route::post('user/delete/{id?}', [\App\Http\Controllers\Dev\UserController::class, 'delete']);
    // 
    Route::resource('user', \App\Http\Controllers\Dev\UserController::class);

    Route::resource('fakultas', \App\Http\Controllers\Dev\FakultasController::class);

    Route::resource('prodi', \App\Http\Controllers\Dev\ProdiController::class);
});

Route::middleware('operator')->prefix('operator')->group(function () {
    Route::get('/', [\App\Http\Controllers\Operator\HomeController::class, 'index']);
    // 
    Route::resource('proposal-list', \App\Http\Controllers\Operator\ProposalListController::class);
    // 
    Route::get('proposal-jadwal/menunggu', [\App\Http\Controllers\Operator\ProposalJadwalController::class, 'menunggu']);
    Route::post('proposal-jadwal/menunggu/{id}', [\App\Http\Controllers\Operator\ProposalJadwalController::class, 'kembalikan']);
    Route::post('proposal-jadwal/notif/{id}', [\App\Http\Controllers\Operator\ProposalJadwalController::class, 'notif']);
    Route::resource('proposal-jadwal', \App\Http\Controllers\Operator\ProposalJadwalController::class);
    // 
    Route::post('proposal-pendanaan/perbaikan/{id}', [\App\Http\Controllers\Operator\ProposalPendanaanController::class, 'perbaikan']);
    Route::post('proposal-pendanaan/setujui/{id}', [\App\Http\Controllers\Operator\ProposalPendanaanController::class, 'setujui']);
    Route::resource('proposal-pendanaan', \App\Http\Controllers\Operator\ProposalPendanaanController::class);
    // 
    Route::post('proposal-mou/setujui/{id}', [\App\Http\Controllers\Operator\ProposalMouController::class, 'setujui']);
    Route::post('proposal-mou/perbaikan/{id}', [\App\Http\Controllers\Operator\ProposalMouController::class, 'perbaikan']);
    Route::resource('proposal-mou', \App\Http\Controllers\Operator\ProposalMouController::class);
    // 
    Route::resource('proposal-riwayat', \App\Http\Controllers\Operator\ProposalRiwayatController::class);
    // 
    Route::post('penelitian-list/perbaikan/{id}', [\App\Http\Controllers\Operator\PenelitianListController::class, 'perbaikan']);
    Route::post('penelitian-list/setujui/{id}', [\App\Http\Controllers\Operator\PenelitianListController::class, 'setujui']);
    Route::resource('penelitian-list', \App\Http\Controllers\Operator\PenelitianListController::class);
    Route::resource('penelitian-riwayat', \App\Http\Controllers\Operator\PenelitianRiwayatController::class);
    // 
    Route::post('pengabdian-list/perbaikan/{id}', [\App\Http\Controllers\Operator\PengabdianListController::class, 'perbaikan']);
    Route::post('pengabdian-list/setujui/{id}', [\App\Http\Controllers\Operator\PengabdianListController::class, 'setujui']);
    Route::resource('pengabdian-list', \App\Http\Controllers\Operator\PengabdianListController::class);
    Route::resource('pengabdian-riwayat', \App\Http\Controllers\Operator\PengabdianRiwayatController::class);
    // 
    Route::get('dosen/reset/{id}', [\App\Http\Controllers\Operator\DosenController::class, 'reset']);
    Route::resource('dosen', \App\Http\Controllers\Operator\DosenController::class);
});

Route::middleware('dosen')->prefix('dosen')->group(function () {
    Route::get('/', [\App\Http\Controllers\Dosen\HomeController::class, 'index']);
    Route::get('jadwal/{id}', [\App\Http\Controllers\Dosen\HomeController::class, 'jadwal']);
    //
    Route::get('proposal/penelitian', [\App\Http\Controllers\Dosen\ProposalController::class, 'create_penelitian']);
    Route::post('proposal/penelitian', [\App\Http\Controllers\Dosen\ProposalController::class, 'store_penelitian']);
    Route::get('proposal/penelitian/{id}', [\App\Http\Controllers\Dosen\ProposalController::class, 'edit_penelitian']);
    Route::post('proposal/penelitian/{id}', [\App\Http\Controllers\Dosen\ProposalController::class, 'update_penelitian']);
    //
    Route::get('proposal/pengabdian', [\App\Http\Controllers\Dosen\ProposalController::class, 'create_pengabdian']);
    Route::post('proposal/pengabdian', [\App\Http\Controllers\Dosen\ProposalController::class, 'store_pengabdian']);
    Route::get('proposal/pengabdian/{id}', [\App\Http\Controllers\Dosen\ProposalController::class, 'edit_pengabdian']);
    Route::post('proposal/pengabdian/{id}', [\App\Http\Controllers\Dosen\ProposalController::class, 'update_pengabdian']);
    // 
    Route::post('proposal/perbaikan/{id}', [\App\Http\Controllers\Dosen\ProposalController::class, 'perbaikan']);
    Route::post('proposal/mou/{id}', [\App\Http\Controllers\Dosen\ProposalController::class, 'mou']);
    // Route::get('proposal/mou/{id}', [\App\Http\Controllers\Dosen\ProposalController::class, 'mou']);
    Route::resource('proposal', \App\Http\Controllers\Dosen\ProposalController::class);
    // 
    Route::get('jadwal/{id}', [\App\Http\Controllers\Dosen\HomeController::class, 'jadwal']);
    // 
    Route::post('penelitian/perbaikan/{id}', [\App\Http\Controllers\Dosen\PenelitianController::class, 'perbaikan']);
    Route::resource('penelitian', \App\Http\Controllers\Dosen\PenelitianController::class);
    // 
    Route::post('pengabdian/perbaikan/{id}', [\App\Http\Controllers\Dosen\PengabdianController::class, 'perbaikan']);
    Route::resource('pengabdian', \App\Http\Controllers\Dosen\PengabdianController::class);
    // 
    Route::middleware('ketua')->prefix('ketua')->group(function () {
        Route::resource('proposal-pendanaan', \App\Http\Controllers\Dosen\Ketua\ProposalPendanaanController::class);
        Route::resource('proposal-mou', \App\Http\Controllers\Dosen\Ketua\ProposalMouController::class);
        Route::resource('proposal-riwayat', \App\Http\Controllers\Dosen\Ketua\ProposalRiwayatController::class);
    });
    // 
    Route::middleware('peninjau')->prefix('peninjau')->group(function () {
        Route::post('review/perbaikan/{id}', [\App\Http\Controllers\Dosen\PeninjauReviewController::class, 'perbaikan']);
        Route::post('review/setujui/{id}', [\App\Http\Controllers\Dosen\PeninjauReviewController::class, 'setujui']);
        Route::get('review', [\App\Http\Controllers\Dosen\PeninjauReviewController::class, 'index']);
        // 
        Route::post('revisi/perbaikan/{id}', [\App\Http\Controllers\Dosen\PeninjauRevisiController::class, 'perbaikan']);
        Route::post('revisi/setujui/{id}', [\App\Http\Controllers\Dosen\PeninjauRevisiController::class, 'setujui']);
        Route::get('revisi', [\App\Http\Controllers\Dosen\PeninjauRevisiController::class, 'index']);
        // 
        Route::resource('riwayat', \App\Http\Controllers\Dosen\PeninjauRiwayatController::class);
    });
});
