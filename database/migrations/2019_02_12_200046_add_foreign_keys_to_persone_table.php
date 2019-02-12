<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPersoneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('persone', function(Blueprint $table)
		{
			$table->foreign('fk_comuni_nascita', 'fk_comuni_nascita')->references('id')->on('comuni')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('fk_associazioni', 'fk_persone_associazioni1')->references('id')->on('associazioni')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('fk_comuni', 'fk_persone_comuni1')->references('id')->on('comuni')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('fk_soci', 'fk_persone_soci1')->references('id')->on('soci')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('fk_responsabile', 'fk_responsabile')->references('id')->on('persone')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('persone', function(Blueprint $table)
		{
			$table->dropForeign('fk_comuni_nascita');
			$table->dropForeign('fk_persone_associazioni1');
			$table->dropForeign('fk_persone_comuni1');
			$table->dropForeign('fk_persone_soci1');
			$table->dropForeign('fk_responsabile');
		});
	}

}
