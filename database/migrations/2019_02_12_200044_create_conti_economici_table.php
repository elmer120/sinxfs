<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContiEconomiciTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conti_economici', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('anno');
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
		Schema::drop('conti_economici');
	}

}
