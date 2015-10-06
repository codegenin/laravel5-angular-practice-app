<?php

use Illuminate\Database\Seeder;

class DateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Date::class, 20)->create();
    }
}
