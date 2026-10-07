// database/migrations/2024_01_01_000001_create_penyakits_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyakitsTable extends Migration
{
    public function up()
    {
        Schema::create('penyakits', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penyakit')->unique();
            $table->string('nama_penyakit');
            $table->text('deskripsi');
            $table->text('gejala_umum');
            $table->text('saran_penanganan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penyakits');
    }
}