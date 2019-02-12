<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComuniTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comuni', function(Blueprint $table)
		{
			$table->foreign('fk_province', 'fk_province')->references('id')->on('province')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comuni', function(Blueprint $table)
		{
			$table->dropForeign('fk_province');
		});
	}

}
