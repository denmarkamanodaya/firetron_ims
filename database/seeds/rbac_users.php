<?php

use Illuminate\Database\Seeder;

class rbac_users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('rbac_users')->insert([
			'user_username' 	=> 'admin',
			'user_last_name' 	=> 'Administrator',
			'user_first_name' 	=> 'Administrator',
			'is_active' 		=> 1
        ]);
    }
}
