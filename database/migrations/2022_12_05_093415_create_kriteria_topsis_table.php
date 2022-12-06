<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriteria_topsis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kriteria');
            $table->integer('user_id');
            $table->string('nama_kriteria');
            $table->enum('atribut_kriteria', ['cost', 'benefit']);
            $table->integer('bobot')->nullable();
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
        Schema::dropIfExists('kriteria_topsis');
    }
};
