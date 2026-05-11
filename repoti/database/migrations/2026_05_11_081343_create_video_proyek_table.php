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
        Schema::create('video_proyek', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('videoCode');
            $table->text('lokasi');
            $table->unsignedInteger('proyekId');
            $table->timestamps();

            $table->foreign('proyekId')->references('id')->on('proyek')->onDelete('cascade');
        });
    }
    public function down() { Schema::dropIfExists('video_proyek'); }
};
