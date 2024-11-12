<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nidn')->unique()->nullable();
            $table->string('nipy')->unique()->nullable();
            $table->enum('gender', ['L', 'P']);
            $table->unsignedBigInteger('prodi_id')->nullable();
            $table->foreign('prodi_id')->references('id')->on('prodis')->restrictOnDelete();
            $table->string('telp')->unique()->nullable();
            $table->string('id_sinta')->unique()->nullable();
            $table->string('id_scopus')->unique()->nullable();
            $table->string('golongan')->nullable();
            $table->string('jabatan')->nullable();
            $table->text('alamat')->nullable();
            $table->boolean('is_ketua')->default(false);
            $table->boolean('is_peninjau')->default(false);
            $table->string('ttd')->nullable();
            $table->enum('role', ['dev', 'operator', 'dosen']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
