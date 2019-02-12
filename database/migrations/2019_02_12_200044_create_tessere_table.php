<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTessereTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tessere', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('numero', 45);
			$table->date('tessere_dal')->nullable();
			$table->string('tessere_tipo', 45)->nullable();
			$table->date('tessere_al')->nullable();
			$table->integer('fk_soci')->nullable()->index('fk_soci_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tessere');
	}

}
