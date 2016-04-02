<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\Code\Entities\Client::truncate();
        factory(\Code\Entities\Client::class, 10)->create();
    }
}
