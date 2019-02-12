<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMovimentiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movimenti', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('data');
			$table->string('causale', 250)->nullable();
			$table->float('importo', 10, 0)->nullable();
			$table->string('tipo', 1)->nullable();
			$table->integer('fk_pagamenti')->nullable()->index('fk_movimenti_pagamenti1_idx');
			$table->integer('fk_fondi')->index('fk_movimenti_fondi1_idx');
			$table->integer('fk_prime_note')->index('fk_movimenti_prime_note1_idx');
			$table->integer('fk_voci_conto_economico')->index('fk_movimenti_voci_conto_economico1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('movimenti');
	}

}
