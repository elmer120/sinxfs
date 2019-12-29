<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRicevuteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ricevute', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('numero');
			$table->date('data');
			$table->float('importo', 10, 0);
			$table->string('causale', 75);
			$table->integer('fk_persone')->index('fk_ricevute_persone1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ricevute');
	}

}
