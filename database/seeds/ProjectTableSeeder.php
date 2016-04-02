<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\Code\Entities\Project::truncate();
        factory(\Code\Entities\Project::class, 10)->create();
    }
}
