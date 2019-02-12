<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFattureDettagliTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fatture_dettagli', function(Blueprint $table)
		{
			$table->foreign('fk_fatture', 'fk_fatture_fk')->references('id')->on('fatture')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fatture_dettagli', function(Blueprint $table)
		{
			$table->dropForeign('fk_fatture_fk');
		});
	}

}
