<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembalianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->bigInteger('id_pengembalian')->primary();
            $table->bigInteger('id_peminjaman')->unsigned();
            $table->foreign('id_peminjaman')->references('id_peminjaman')->on('peminjaman');
            $table->date('tgl_kembali');
            $table->integer('terlambat')->nullable();
            $table->integer('denda')->nullable();
            $table->bigInteger('id_petugas')->unsigned();
            $table->foreign('id_petugas')->references('id_petugas')->on('users');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembalian');
    }
}
