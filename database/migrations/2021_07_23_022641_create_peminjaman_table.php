<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->bigInteger('id_peminjaman')->primary();
            $table->bigInteger('id_anggota')->unsigned();
            $table->foreign('id_anggota')->references('id')->on('users');
            $table->date('tgl_pinjam');
            $table->integer('perpanjang_pinjam')->nullable();
            $table->date('tgl_hrs_kembali');
            $table->bigInteger('id_petugas')->unsigned();
            $table->foreign('id_petugas')->references('id')->on('users');
            $table->string('status', 128);
            $table->dateTime('date_created');
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('date_deleted')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
