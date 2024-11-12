<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hkis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->string('no_hki');
            $table->string('tahun');
            $table->text('judul');
            $table->unsignedBigInteger('jenis_hki_id');
            $table->foreign('jenis_hki_id')->references('id')->on('jenis_hkis')->restrictOnDelete();
            $table->string('no_pendaftaran');
            $table->enum('keterangan', ['terdaftar', 'granted']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hkis');
    }
};
