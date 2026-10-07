// database/migrations/2024_01_01_000004_create_diagnosas_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosasTable extends Migration
{
    public function up()
    {
        Schema::create('diagnosas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('penyakit_id')->constrained()->onDelete('cascade');
            $table->decimal('cf_result', 5, 2);
            $table->json('gejala_terpilih');
            $table->text('hasil_diagnosa');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diagnosas');
    }
}