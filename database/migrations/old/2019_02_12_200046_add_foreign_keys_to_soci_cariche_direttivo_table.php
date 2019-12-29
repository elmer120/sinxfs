<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSociCaricheDirettivoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('soci_cariche_direttivo', function(Blueprint $table)
		{
			$table->foreign('fk_cariche_direttivo', 'fk_cariche_direttivo_idx')->references('id')->on('cariche_direttivo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('fk_soci', 'fk_soci_idx')->references('id')->on('soci')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('soci_cariche_direttivo', function(Blueprint $table)
		{
			$table->dropForeign('fk_cariche_direttivo_idx');
			$table->dropForeign('fk_soci_idx');
		});
	}

}
