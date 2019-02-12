<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSociTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('soci', function(Blueprint $table)
		{
			$table->foreign('fk_soci_tipologie', 'fk_soci_soci_tipologie')->references('id')->on('soci_tipologie')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('soci', function(Blueprint $table)
		{
			$table->dropForeign('fk_soci_soci_tipologie');
		});
	}

}
