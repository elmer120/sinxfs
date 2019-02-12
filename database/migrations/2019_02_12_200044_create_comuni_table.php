<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComuniTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comuni', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('fk_province')->nullable()->index('fk_province');
			$table->string('nome', 200)->nullable();
			$table->string('cap', 200);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comuni');
	}

}
