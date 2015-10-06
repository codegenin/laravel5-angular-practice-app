<?php

use App\Date;
use App\User;
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
        Model::unguard();

        User::truncate(); // Empty users table
        Date::truncate(); // Empty users table

        $this->call(UserTableSeeder::class);
        $this->call(DateTableSeeder::class);

        Model::reguard();
    }
}
