<?php

use Illuminate\Database\Seeder;

class SeedPersonaTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Persona::class,35)->create();
    }
}
