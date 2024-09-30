<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengabdian_personels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengabdian_id');
            $table->foreign('pengabdian_id')->references('id')->on('pengabdians')->restrictOnDelete();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengabdian_personels');
    }
};
