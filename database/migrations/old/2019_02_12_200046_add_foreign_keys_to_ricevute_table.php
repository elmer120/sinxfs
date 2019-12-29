<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRicevuteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ricevute', function(Blueprint $table)
		{
			$table->foreign('fk_persone', 'fk_ricevute_persone1')->references('id')->on('persone')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ricevute', function(Blueprint $table)
		{
			$table->dropForeign('fk_ricevute_persone1');
		});
	}

}
