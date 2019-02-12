<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFattureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fatture', function(Blueprint $table)
		{
			$table->foreign('fk_persone', 'fk_fatture_persone1')->references('id')->on('persone')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fatture', function(Blueprint $table)
		{
			$table->dropForeign('fk_fatture_persone1');
		});
	}

}
