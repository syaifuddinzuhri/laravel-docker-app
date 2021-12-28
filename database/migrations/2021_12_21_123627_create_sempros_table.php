<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemprosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sempros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
            $table->date('waktu')->nullable();
            $table->text('judul_1')->nullable();
            $table->text('judul_2')->nullable();
            $table->text('judul_3')->nullable();
            $table->string('tempat')->nullable();
            $table->string('nama_ruang')->nullable();
            $table->text('link')->nullable();
            $table->string('pembimbing_1')->nullable();
            $table->string('pembimbing_2')->nullable();
            $table->string('pendamping')->nullable();
            $table->tinyInteger('status_judul_1')->nullable()->default(0);
            $table->tinyInteger('status_judul_2')->nullable()->default(0);
            $table->tinyInteger('status_judul_3')->nullable()->default(0);
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skripsis');
    }
}
