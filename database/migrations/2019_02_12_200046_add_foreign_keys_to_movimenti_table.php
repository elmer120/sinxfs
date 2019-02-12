<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMovimentiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('movimenti', function(Blueprint $table)
		{
			$table->foreign('fk_fondi', 'fk_movimenti_fondi1')->references('id')->on('fondi')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('fk_pagamenti', 'fk_movimenti_pagamenti1')->references('id')->on('pagamenti')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('fk_prime_note', 'fk_movimenti_prime_note1')->references('id')->on('prime_note')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('fk_voci_conto_economico', 'fk_movimenti_voci_conto_economico1')->references('id')->on('voci_conto_economico')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('movimenti', function(Blueprint $table)
		{
			$table->dropForeign('fk_movimenti_fondi1');
			$table->dropForeign('fk_movimenti_pagamenti1');
			$table->dropForeign('fk_movimenti_prime_note1');
			$table->dropForeign('fk_movimenti_voci_conto_economico1');
		});
	}

}
