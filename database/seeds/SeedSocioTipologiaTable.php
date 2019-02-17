<?php

use Illuminate\Database\Seeder;

class SeedSocioTipologiaTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\SocioTipologia::class,3)->create();
    }
}
