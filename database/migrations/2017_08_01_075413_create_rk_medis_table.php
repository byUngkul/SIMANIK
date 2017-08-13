<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRKMedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('rk_medis', function (Blueprint $table) {
            $table->char('id', 10);
            $table->primary('id');
            $table->char('pasien_id', 10);
            $table->char('dokter_id', 10);
            $table->string('diagnosa');
            $table->string('keluhan');
            $table->text('anamnesis');
            $table->text('keterangan');
            $table->string('alergi_obat', 100);
            $table->float('bb');
            $table->float('tb');
            $table->float('tensi');
            $table->enum('bw', ['ya', 'tidak']);
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
        Schema::dropIfExists('rk_medis');
    }
}
