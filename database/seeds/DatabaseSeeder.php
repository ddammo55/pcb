<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

    	$sqlite = in_array(config('database.default'), ['sqlite', 'testing'], true);
    	if (! $sqlite) {
    		DB::statement('SET FOREIGN_KEY_CHECKS=0');
    	}

    	App\User::truncate();
    	$this->call(UsersTableSeeder::class);

    	App\Post::truncate();
    	$this->call(PostsTableSeeder::class);

    	App\Project::truncate();
    	$this->call(ProjectTableSeeder::class);

        App\Boardname::truncate();
        $this->call(BoardnamesTableSeeder::class);

        App\Pba::truncate();
        $this->call(PbasTableSeeder::class);

        App\Pba::truncate();
        $this->call(TasksTableSeeder::class);

    	if (! $sqlite) {
    		DB::statement('SET FOREIGN_KEY_CHECKS=1');
    	}
    }
}
