<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->enum('tingkat', ['regional', 'internasional', 'nasional']);
            $table->string('tahun');
            $table->text('judul');
            $table->string('nama');
            $table->string('institusi');
            $table->string('tanggal_awal');
            $table->string('tanggal_akhir');
            $table->string('tempat');
            $table->enum('keterangan', ['invited', 'pemakalah']);
            $table->json('mahasiswas')->nullable();
            $table->enum('status', ['menunggu', 'revisi', 'selesai']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('makalahs');
    }
};
