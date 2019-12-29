<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePagamentiFkRicevuteOnDeleteSetCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagamenti', function (Blueprint $table) {
            $table->dropForeign('fk_pagamenti_ricevute1');
            $table->foreign('fk_ricevute', 'fk_pagamenti_ricevute1_idx')->references('id')->on('ricevute')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagamenti', function (Blueprint $table) {
            $table->dropForeign('fk_pagamenti_ricevute1');
            $table->foreign('fk_ricevute', 'fk_pagamenti_ricevute1_idx')->references('id')->on('ricevute')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }
}
