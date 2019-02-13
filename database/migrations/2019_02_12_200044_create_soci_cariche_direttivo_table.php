<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSociCaricheDirettivoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('soci_cariche_direttivo', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('fk_soci')->index('fk_soci_idx');
			$table->integer('fk_cariche_direttivo')->index('fk_cariche_direttivo_idx');
			$table->date('carica_direttivo_dal')->nullable();
			$table->date('carica_direttivo_al')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('soci_cariche_direttivo');
	}

}
