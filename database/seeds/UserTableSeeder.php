<?php

use App\User;
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
        $users = [
            'name'          => 'James Puro',
            'description'   => 'I am J',
            'dob'           => '1983-05-01',
            'phone'         => '+12-123-1234',
            'gender'        => 'male',
            'email'         => 'james@test.com',
            'password'      => Hash::make('123')
        ];

        User::create($users);
    }
}
