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
        Schema::create('mahasiswa_sosial_media', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mahasiswa_id');
            $table->unsignedInteger('sosial_media_id');
            $table->text('link');

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('sosial_media_id')->references('id')->on('sosial_media')->onDelete('cascade');
        });
    }
    public function down() { Schema::dropIfExists('mahasiswa_sosial_media'); }
};
