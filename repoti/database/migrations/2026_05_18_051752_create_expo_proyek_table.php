<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('expo_proyek', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expo_id');
            $table->integer('proyek_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expo_proyek');
    }
};