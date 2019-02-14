<?php

use Illuminate\Database\Seeder;
use App\Models\AssociazioneLinks;

class SeedAssociazioneLinksTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\AssociazioneLinks::class,3)->create();
    }
}
