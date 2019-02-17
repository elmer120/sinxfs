<?php

use Illuminate\Database\Seeder;

class SeedSocioTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Socio::class,35)->create();
    }
}
