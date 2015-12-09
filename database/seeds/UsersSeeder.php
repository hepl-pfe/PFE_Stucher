<?php
use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('fr_FR'); // create a French faker
		for ($i=0; $i < 10; $i++) {
	  		User::create([ 
	  			'name' => $faker->name,
	  			'email' => $faker->unique()->email,
	  			'password' => bcrypt('password'),
	  			'remember_token' => remember()
	  		 ]);
		}
    }
}
