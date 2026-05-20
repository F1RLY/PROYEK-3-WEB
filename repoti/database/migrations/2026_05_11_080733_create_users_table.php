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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('kode')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'mahasiswa', 'dosen'])->default('mahasiswa');
            $table->string('foto', 255)->nullable();
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('users'); }
};
