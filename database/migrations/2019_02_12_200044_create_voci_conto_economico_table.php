<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVociContoEconomicoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('voci_conto_economico', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('descrizione')->nullable();
			$table->string('tipo', 1);
			$table->float('importo', 10, 0);
			$table->integer('fk_conti_economici')->index('fk_voci_conto_economico_conti_economici1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('voci_conto_economico');
	}

}
