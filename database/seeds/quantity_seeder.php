<?php

use Illuminate\Database\Seeder;

class quantity_seeder extends Seeder
{
	private $table_name = 'quantity';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table_name)->insert([
			'code_id' 		=> 'P001',
			'quantity' 		=> 100,
			'added_by_id' 	=> 1
        ]);

        DB::table($this->table_name)->insert([
			'code_id' 		=> 'C001',
			'quantity' 		=> 200,
			'added_by_id' 	=> 1
        ]);

        DB::table($this->table_name)->insert([
			'code_id' 		=> 'C002',
			'quantity' 		=> 300,
			'added_by_id' 	=> 1
        ]);

        DB::table($this->table_name)->insert([
			'code_id' 		=> 'C003',
			'quantity' 		=> 400,
			'added_by_id' 	=> 1
        ]);

        DB::table($this->table_name)->insert([
			'code_id' 		=> 'C004',
			'quantity' 		=> 500,
			'added_by_id' 	=> 1
        ]);
    }
}
