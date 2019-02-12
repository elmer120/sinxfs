<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSociTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('soci', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('certificato_scadenza_al')->nullable();
			$table->date('richiesta_data')->nullable();
			$table->date('approvazione_data')->nullable();
			$table->date('quota_scadenza_al')->nullable();
			$table->date('scadenza_data')->nullable();
			$table->integer('fk_soci_tipologie')->index('fk_soci_tipologie');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('soci');
	}

}
