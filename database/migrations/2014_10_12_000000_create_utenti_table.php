<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtentiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utenti', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',100);
            $table->string('username')->unique();
            $table->string('password',255);
            //$table->string('email')->unique();
            //$table->timestamp('email_verified_at')->nullable();
            $table->integer('fk_utenti_livelli')->index('fk_utenti_utenti_livelli_idx');
            $table->string('immagine',255)->nullable();
            $table->timestamp('ultimo_accesso')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->integer('fk_associazioni')->index('fk_utenti_associazioni_idx')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utenti');
    }
}
