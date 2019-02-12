<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVociContoEconomicoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('voci_conto_economico', function(Blueprint $table)
		{
			$table->foreign('fk_conti_economici', 'fk_voci_conto_economico_conti_economici1')->references('id')->on('conti_economici')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('voci_conto_economico', function(Blueprint $table)
		{
			$table->dropForeign('fk_voci_conto_economico_conti_economici1');
		});
	}

}
