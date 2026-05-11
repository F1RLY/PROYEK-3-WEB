<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kelompok', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mahasiswa')->nullable();
            $table->string('nama')->nullable();
            $table->unsignedInteger('proyek');
            $table->timestamps();

            $table->foreign('mahasiswa')->references('id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('proyek')->references('id')->on('proyek')->onDelete('cascade');
        });
    }
    public function down() { Schema::dropIfExists('kelompok'); }
};
