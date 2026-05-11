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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('userID');
            $table->string('angkatan', 4);
            $table->string('kelas', 1);
            $table->text('link')->nullable();
            $table->timestamps();

            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    public function down() { Schema::dropIfExists('mahasiswa'); }
};
