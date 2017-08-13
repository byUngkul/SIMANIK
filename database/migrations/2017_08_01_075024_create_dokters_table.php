<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoktersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokters', function (Blueprint $table) {
            $table->char('id', 10);
            $table->primary('id');
            $table->string('username', 50);
            $table->string('password', 100);
            $table->string('nama', 100);
            $table->text('alamat');
            $table->date('tgl_lahir');
            $table->smallInteger('spesialis_id');
            $table->string('level', 50);
            $table->string('photo', 255);
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokters');
    }
}
