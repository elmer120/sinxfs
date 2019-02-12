<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssociazioniTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('associazioni', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome', 100);
			$table->string('tipo', 100)->nullable();
			$table->integer('anno_fondazione')->nullable();
			$table->string('indirizzo', 100)->nullable();
			$table->string('codice_fiscale', 50)->nullable();
			$table->string('vat', 45)->nullable();
			$table->string('telefono', 15)->nullable();
			$table->string('telefono_ext', 15)->nullable();
			$table->string('logo', 45)->nullable();
			$table->string('email')->nullable();
			$table->string('email_pec')->nullable();
			$table->string('registration', 45)->nullable();
			$table->string('partita_iva', 50)->nullable();
			$table->integer('fk_comuni')->nullable()->index('fk_associazioni_comuni1_idx');
			$table->integer('fk_associazioni_links')->nullable()->index('fk_associazioni_associazioni_links');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('associazioni');
	}

}
