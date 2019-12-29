<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTessereTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tessere', function(Blueprint $table)
		{
			$table->foreign('fk_soci', 'fk_soci')->references('id')->on('soci')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tessere', function(Blueprint $table)
		{
			$table->dropForeign('fk_soci');
		});
	}

}
