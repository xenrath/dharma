<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('luarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->unsignedBigInteger('jenis_luaran_id');
            $table->foreign('jenis_luaran_id')->references('id')->on('jenis_luarans')->restrictOnDelete();
            $table->string('tahun');
            $table->text('judul');
            $table->text('deskripsi');
            $table->string('url');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('luarans');
    }
};
