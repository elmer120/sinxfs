<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCaricheDirettivoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cariche_direttivo', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cariche_direttivo');
	}

}
