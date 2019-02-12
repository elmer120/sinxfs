<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersoneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('persone', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome', 45);
			$table->string('cognome', 45);
			$table->date('data_nascita')->nullable();
			$table->string('indirizzo', 100)->nullable();
			$table->string('telefono', 15)->nullable();
			$table->string('telefono_ext', 15)->nullable();
			$table->string('email')->nullable();
			$table->string('codice_fiscale', 50)->nullable();
			$table->string('note')->nullable();
			$table->integer('fk_responsabile')->nullable()->index('fk_responsabile');
			$table->string('image', 45)->nullable();
			$table->integer('fk_associazioni')->index('fk_persone_associazioni1_idx');
			$table->integer('fk_soci')->nullable()->index('fk_persone_soci1_idx');
			$table->string('iban', 27)->nullable();
			$table->string('banca', 45)->nullable();
			$table->string('partita_iva', 45)->nullable();
			$table->integer('fk_comuni')->index('fk_persone_comuni1_idx');
			$table->integer('fk_comuni_nascita')->index('fk_comuni_nascita_idx');
			$table->boolean('privacy')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('persone');
	}

}
