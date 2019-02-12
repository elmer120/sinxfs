<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPagamentiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pagamenti', function(Blueprint $table)
		{
			$table->foreign('fk_fatture', 'fk_pagamenti_fatture1')->references('id')->on('fatture')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('fk_fondi', 'fk_pagamenti_fondi1')->references('id')->on('fondi')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('fk_persone', 'fk_pagamenti_persone1')->references('id')->on('persone')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('fk_ricevute', 'fk_pagamenti_ricevute1')->references('id')->on('ricevute')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pagamenti', function(Blueprint $table)
		{
			$table->dropForeign('fk_pagamenti_fatture1');
			$table->dropForeign('fk_pagamenti_fondi1');
			$table->dropForeign('fk_pagamenti_persone1');
			$table->dropForeign('fk_pagamenti_ricevute1');
		});
	}

}
