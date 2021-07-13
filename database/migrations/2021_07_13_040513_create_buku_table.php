<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->bigInteger('id_buku')->primary();
            $table->string('judul', 128);
            $table->string('pengarang', 128);
            $table->string('penerbit', 128);
            $table->integer('tahun_terbit');
            $table->string('foto', 128);
            $table->string('bahasa', 128);
            $table->string('genre', 128);
            $table->integer('jml_halaman');
            $table->integer('stok');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku');
    }
}
