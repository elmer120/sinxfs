<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSociCaricheDirettivoFkSociOnDeleteSetCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('soci_cariche_direttivo', function (Blueprint $table) {
            $table->dropForeign('fk_soci_idx');
            $table->foreign('fk_soci', 'fk_soci_cariche_direttivo_socio_idx')->references('id')->on('soci')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('soci_cariche_direttivo', function (Blueprint $table) {
            $table->dropForeign('fk_soci_cariche_direttivo_socio_idx');
            $table->foreign('fk_soci', 'fk_soci_cariche_direttivo_socio_idx')->references('id')->on('soci')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }
}
