<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(\Code\Entities\User::class, 10)->create();
        factory(\Code\Entities\User::class)->create([
            'name' => 'Marcelo',
            'email' => 'marcelobjr@hotmail.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]);
    }
}
