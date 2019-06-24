<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	//Seed roles
    	$this->call(RolesTableSeeder::class);
        
        //Create 1 administrator user
    	$this->call(AdministratorSeeder::class);

    	//Create some random customer users
    	factory(User::class, 20)->create();
    }
}
