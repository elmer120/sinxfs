<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMovimentiFkPagamentiOnDeleteSetCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movimenti', function (Blueprint $table) {
            $table->dropForeign('fk_movimenti_pagamenti1');
            $table->foreign('fk_pagamenti', 'fk_movimenti_pagamenti1_idx')->references('id')->on('pagamenti')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movimenti', function (Blueprint $table) {
            $table->dropForeign('fk_movimenti_pagamenti1');
            $table->foreign('fk_pagamenti', 'fk_movimenti_pagamenti1_idx')->references('id')->on('pagamenti')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }
}
