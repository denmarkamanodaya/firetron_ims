<?php

use Illuminate\Database\Seeder;

class product_category extends Seeder
{
	private $table_name = 'product_category';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table_name)->insert([
			'category_name' 	=> 'FIRE EXTINGUISHER'
        ]);

        DB::table($this->table_name)->insert([
			'category_name' 	=> 'MISC'
        ]);

        DB::table($this->table_name)->insert([
			'category_name' 	=> 'EMERGENCY LIGHT'
        ]);

        DB::table($this->table_name)->insert([
			'category_name' 	=> 'EXIT SIGN'
        ]);

        DB::table($this->table_name)->insert([
			'category_name' 	=> 'FIREMAN EQUIPMENT'
        ]);

        DB::table($this->table_name)->insert([
			'category_name' 	=> 'FIRE HOSE'
        ]);

        DB::table($this->table_name)->insert([
			'category_name' 	=> 'REPLACEMENTS'
        ]);
    }
}
