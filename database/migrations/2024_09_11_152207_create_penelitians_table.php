<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penelitians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->string('tahun');
            $table->text('judul');
            $table->unsignedBigInteger('jenis_pendanaan_id');
            $table->foreign('jenis_pendanaan_id')->references('id')->on('jenis_pendanaans')->restrictOnDelete();
            $table->unsignedBigInteger('jenis_penelitian_id')->nullable();
            $table->foreign('jenis_penelitian_id')->references('id')->on('jenis_penelitians')->restrictOnDelete();
            $table->string('dana_sumber');
            $table->string('dana_setuju');
            $table->string('file')->nullable();
            $table->json('mahasiswas')->nullable();
            $table->enum('status', ['menunggu', 'revisi', 'selesai']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penelitians');
    }
};
