<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssociazioniLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('associazioni_links', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('web_site', 1000)->nullable();
			$table->string('web_mail', 1000)->nullable();
			$table->string('web_mail_pec', 1000)->nullable();
			$table->string('facebook', 1000)->nullable();
			$table->string('instagram', 1000)->nullable();
			$table->string('youtube', 1000)->nullable();
			$table->string('twitter', 1000)->nullable();
			$table->string('home_banking', 1000)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('associazioni_links');
	}

}
