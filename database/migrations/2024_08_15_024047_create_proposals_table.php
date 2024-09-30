<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['penelitian', 'pengabdian']);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->string('tahun');
            $table->text('judul');
            $table->unsignedBigInteger('jenis_pendanaan_id');
            $table->foreign('jenis_pendanaan_id')->references('id')->on('jenis_pendanaans')->restrictOnDelete();
            $table->unsignedBigInteger('jenis_penelitian_id')->nullable();
            $table->foreign('jenis_penelitian_id')->references('id')->on('jenis_penelitians')->restrictOnDelete();
            $table->unsignedBigInteger('jenis_pengabdian_id')->nullable();
            $table->foreign('jenis_pengabdian_id')->references('id')->on('jenis_pengabdians')->restrictOnDelete();
            $table->string('dana_sumber');
            $table->string('dana_usulan');
            $table->string('dana_setuju')->nullable();
            $table->string('berkas'); // Laporan Proposal
            $table->date('tanggal')->nullable();
            $table->string('jam')->nullable();
            $table->unsignedBigInteger('peninjau_id')->nullable();
            $table->foreign('peninjau_id')->references('id')->on('users')->restrictOnDelete();
            $table->unsignedBigInteger('jadwal_id')->nullable();
            $table->enum('status', ['menunggu', 'proses', 'revisi1', 'setuju', 'revisi2', 'pendanaan', 'selesai']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
