<?php

use Illuminate\Database\Seeder;

class component_category extends Seeder
{
	private $table_name = 'component_category';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table_name)->insert([
			'category_name' 	=> 'CHEMICALS'
        ]);

        DB::table($this->table_name)->insert([
			'category_name' 	=> 'CYLINDER SETS'
        ]);

        DB::table($this->table_name)->insert([
			'category_name' 	=> 'FINISHING'
        ]);

        DB::table($this->table_name)->insert([
			'category_name' 	=> 'TEAR GAS'
        ]);

        DB::table($this->table_name)->insert([
			'category_name' 	=> 'FIREMAN EQUIPMENT'
        ]);
    }
}
