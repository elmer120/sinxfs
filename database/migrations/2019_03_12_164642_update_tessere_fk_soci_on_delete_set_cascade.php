<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTessereFkSociOnDeleteSetCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tessere', function (Blueprint $table) {
            $table->dropForeign('fk_soci');
            $table->foreign('fk_soci', 'fk_tessere_soci_idx')->references('id')->on('soci')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('tessere', function (Blueprint $table) {
            $table->dropForeign('fk_tessere_soci_idx');
            $table->foreign('fk_soci', 'fk_tessere_soci_idx')->references('id')->on('soci')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }
}
