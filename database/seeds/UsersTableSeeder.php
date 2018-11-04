<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// Admin user
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
			'type' => 'admin',
			'api_token' => str_random(60),
			'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
		
		// Default users
		DB::table('users')->insert([
            'name' => 'mini',
            'email' => 'mini@gmail.com',
            'password' => bcrypt('user123'),
			'type' => 'user',
			'api_token' => str_random(60),
			'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
		DB::table('users')->insert([
            'name' => 'mini1',
            'email' => 'mini+1@gmail.com',
            'password' => bcrypt('user123'),
			'type' => 'user',
			'api_token' => str_random(60),
			'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
		DB::table('users')->insert([
            'name' => 'mini2',
            'email' => 'mini+2@gmail.com',
            'password' => bcrypt('user123'),
			'type' => 'user',
			'api_token' => str_random(60),
			'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
