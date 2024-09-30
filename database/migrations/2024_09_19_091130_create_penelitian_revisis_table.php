<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penelitian_revisis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penelitian_id');
            $table->foreign('penelitian_id')->references('id')->on('penelitians')->restrictOnDelete();
            $table->text('keterangan');
            $table->string('file')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penelitian_revisis');
    }
};
