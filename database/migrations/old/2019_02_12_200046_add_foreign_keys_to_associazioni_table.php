<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAssociazioniTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('associazioni', function(Blueprint $table)
		{
			$table->foreign('fk_associazioni_links', 'fk_associazioni_associazioni_links')->references('id')->on('associazioni_links')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('fk_comuni', 'fk_associazioni_comuni1')->references('id')->on('comuni')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('associazioni', function(Blueprint $table)
		{
			$table->dropForeign('fk_associazioni_associazioni_links');
			$table->dropForeign('fk_associazioni_comuni1');
		});
	}

}
