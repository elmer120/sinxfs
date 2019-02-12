<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProvinceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('province', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('fk_regioni')->nullable()->index('fk_regioni');
			$table->string('nome', 200);
			$table->string('sigla', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('province');
	}

}
