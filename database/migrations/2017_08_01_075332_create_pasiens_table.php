<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->char('id', 10);
            $table->primary('id');
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['pria', 'wanita']);
            $table->text('alamat');
            $table->date('tgl_lahir');
            $table->string('telp', 13);
            $table->string('pekerjaan', 40);
            $table->enum('status', ['antri', 'periksa', 'obat', 'selesai']);
            $table->string('layanan_dokter', 15);
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
        Schema::dropIfExists('pasiens');
    }
}
