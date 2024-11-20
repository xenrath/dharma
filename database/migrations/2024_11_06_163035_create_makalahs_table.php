<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('makalahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->enum('tingkat', ['regional', 'nasional', 'internasional']);
            $table->string('tahun');
            $table->text('judul');
            $table->string('forum');
            $table->string('institusi');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->string('tempat');
            $table->enum('status', ['biasa', 'spesial']);
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('makalahs');
    }
};
