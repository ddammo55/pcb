<?php

use Illuminate\Database\Seeder;

class PbasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(App\Pba::class, 50)->create();
    }
}
