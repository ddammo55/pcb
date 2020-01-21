<?php

use Illuminate\Database\Seeder;

class BoardnamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Boardname::class, 50)->create();
    }
}
