<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagamentiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pagamenti', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('al');
			$table->integer('fk_fatture')->nullable()->index('fk_pagamenti_fatture1_idx');
			$table->integer('fk_fondi')->index('fk_pagamenti_fondi1_idx');
			$table->integer('fk_ricevute')->nullable()->index('fk_pagamenti_ricevute1_idx');
			$table->integer('fk_persone')->index('fk_pagamenti_persone1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pagamenti');
	}

}
