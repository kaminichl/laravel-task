<?php

use Illuminate\Database\Seeder;

class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
             DB::table('films')->insert([
            'name' => "abc",
            'descripion' => "Test description",
            'release_date' => "2018-11-21",
			'rating' => 5,
			'ticket_price' => "100.00",
			'country' => "India",
			'genre' => "Comedy",
			'photo' => "1.jpeg",
			'slug' => 'abc'
        ]);
		DB::table('films')->insert([
            'name' => "test",
            'descripion' => "Test description 2",
            'release_date' => "2018-11-23",
			'rating' => 4,
			'ticket_price' => "110.00",
			'country' => "India",
			'genre' => "Comedy",
			'photo' => "2.jpg",
			'slug' => 'test'
        ]);
		DB::table('films')->insert([
            'name' => "new",
            'descripion' => "Test description 3",
            'release_date' => "2018-12-21",
			'rating' => 3,
			'ticket_price' => "120.00",
			'country' => "India",
			'genre' => "Comedy",
			'photo' => "3.jpg",
			'slug' => 'new'
        ]);
    }
}


