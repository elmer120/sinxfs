<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePersonaFkSociOnDeleteSetNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('persone', function (Blueprint $table) {
            $table->dropForeign('fk_persone_soci1');
            $table->foreign('fk_soci', 'fk_persone_soci1')->references('id')->on('soci')->onUpdate('NO ACTION')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('persone', function (Blueprint $table) {
            $table->dropForeign('fk_persone_soci1');
            $table->foreign('fk_soci', 'fk_persone_soci1')->references('id')->on('soci')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }
}
