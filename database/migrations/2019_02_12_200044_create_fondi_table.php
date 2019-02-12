<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFondiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fondi', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('numero', 45);
			$table->string('descrizione', 250)->nullable();
			$table->string('tipo', 45);
			$table->string('iban', 27)->nullable();
			$table->float('saldo', 10, 0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fondi');
	}

}
