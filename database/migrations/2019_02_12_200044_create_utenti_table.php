<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUtentiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('utenti', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome')->nullable();
			$table->string('password', 60)->nullable();
			$table->string('immagine', 45)->nullable();
			$table->string('email')->nullable();
			$table->integer('livello')->nullable();
			$table->dateTime('creato_al')->nullable();
			$table->dateTime('aggiornato_al')->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->dateTime('ultimo_accesso')->nullable();
			$table->integer('fk_associazioni')->nullable()->index('fk_utenti_associazioni_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('utenti');
	}

}
