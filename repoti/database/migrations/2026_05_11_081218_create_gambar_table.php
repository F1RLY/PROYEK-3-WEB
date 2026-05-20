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
        Schema::create('gambar', function (Blueprint $table) {
            $table->increments('id');
            $table->text('lokasi');
            $table->text('imageCode');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }
    public function down() { Schema::dropIfExists('gambar'); }
};
