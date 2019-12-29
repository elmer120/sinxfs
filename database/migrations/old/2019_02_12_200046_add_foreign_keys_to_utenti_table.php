<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUtentiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('utenti', function(Blueprint $table)
		{
			$table->foreign('fk_associazioni', 'fk_associazioni')->references('id')->on('associazioni')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('utenti', function(Blueprint $table)
		{
			$table->dropForeign('fk_associazioni');
		});
	}

}
