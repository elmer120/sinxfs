<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePersonaPhoneTo20Varchar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::table('persone', function (Blueprint $table) {
                $table->string('telefono',20)->change();
                $table->string('telefono_ext',20)->change();
            
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
                $table->string('telefono',15)->change();
                $table->string('telefono_ext',15)->change();
            });
        
    }
}
