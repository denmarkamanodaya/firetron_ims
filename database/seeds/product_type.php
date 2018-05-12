<?php

use Illuminate\Database\Seeder;

class product_type extends Seeder
{
    private $table_name = 'product_type';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table_name)->insert([
			'type_name' 	=> 'ASSEMBLED'
        ]);

        DB::table($this->table_name)->insert([
			'type_name' 	=> 'BUY & SELL'
        ]);
    }
}
