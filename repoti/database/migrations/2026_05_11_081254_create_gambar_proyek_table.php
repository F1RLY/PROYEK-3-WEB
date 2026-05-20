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
        Schema::create('gambar_proyek', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('proyekId');
            $table->unsignedInteger('gambarId');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('proyekId')->references('id')->on('proyek')->onDelete('cascade');
            $table->foreign('gambarId')->references('id')->on('gambar')->onDelete('cascade');
        });
    }
    public function down() { Schema::dropIfExists('gambar_proyek'); }
};
