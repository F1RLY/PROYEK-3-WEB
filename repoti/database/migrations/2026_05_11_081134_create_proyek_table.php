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
        Schema::create('proyek', function (Blueprint $table) {
            $table->increments('id');
            $table->text('repoCode')->nullable();
            $table->string('judul');
            $table->text('deskripsi');
            $table->text('link')->nullable();
            $table->text('file_laporan')->nullable();
            $table->text('file_ppt')->nullable();
            $table->unsignedInteger('dosenId')->nullable();
            $table->tinyInteger('verifikasi')->default(0);
            $table->tinyInteger('proposal')->default(0);
            $table->tinyInteger('laporan')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();

            $table->foreign('dosenId')->references('id')->on('dosen')->onDelete('set null');
        });
    }
    public function down() { Schema::dropIfExists('proyek'); }
};
