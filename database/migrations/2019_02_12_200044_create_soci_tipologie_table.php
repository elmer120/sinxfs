<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSociTipologieTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('soci_tipologie', function(Blueprint $table)
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
		Schema::drop('soci_tipologie');
	}

}
