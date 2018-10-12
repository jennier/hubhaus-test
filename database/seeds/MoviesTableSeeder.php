<?php

use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies')->insert([
            'movie_name' => str_random(100),
            'up_votes' => rand(0,100),
            'down_votes' => rand(0,100),
        ]);
    }
}
