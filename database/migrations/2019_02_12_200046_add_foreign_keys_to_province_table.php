<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProvinceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('province', function(Blueprint $table)
		{
			$table->foreign('fk_regioni', 'fk_regioni')->references('id')->on('regioni')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('province', function(Blueprint $table)
		{
			$table->dropForeign('fk_regioni');
		});
	}

}
