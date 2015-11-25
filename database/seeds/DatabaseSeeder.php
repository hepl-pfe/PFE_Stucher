<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'prof',
            'email' => 'prof@prof.com',
            'password' => 'password',
            'status' => 1,
        ]);

        Model::unguard();

        // $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
