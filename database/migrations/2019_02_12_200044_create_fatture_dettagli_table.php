<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFattureDettagliTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fatture_dettagli', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('descrizione', 250)->nullable();
			$table->integer('quantita');
			$table->float('prezzo_unitario', 10, 0);
			$table->float('iva', 10, 0);
			$table->integer('fk_fatture')->nullable()->index('fk_fatture_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fatture_dettagli');
	}

}
