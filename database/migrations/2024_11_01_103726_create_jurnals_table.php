<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurnals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->unsignedBigInteger('jenis_jurnal_id');
            $table->foreign('jenis_jurnal_id')->references('id')->on('jenis_jurnals')->restrictOnDelete();
            $table->string('tahun');
            $table->string('nama');
            $table->text('judul');
            $table->string('issn');
            $table->string('volume');
            $table->string('nomor');
            $table->string('halaman_awal');
            $table->string('halaman_akhir');
            $table->string('url');
            $table->string('file');
            $table->json('mahasiswas')->nullable();
            $table->enum('status', ['menunggu', 'revisi', 'selesai']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurnals');
    }
};
