<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrimeNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prime_note', function(Blueprint $table)
		{
			$table->integer('id')->primary();
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
		Schema::drop('prime_note');
	}

}
