<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFattureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fatture', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('numero', 45);
			$table->date('data');
			$table->date('scadenza_al');
			$table->float('importo', 10, 0);
			$table->integer('fk_persone')->index('fk_fatture_persone1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fatture');
	}

}
