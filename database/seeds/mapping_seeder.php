<?php

use Illuminate\Database\Seeder;

class mapping_seeder extends Seeder
{
	private $table_name = 'mapping';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table_name)->insert([
			'product_id' 			=> 1,
			'mapping_type'			=> 'BRAND_NEW',
			'product_type_id' 		=> 1,
			'product_category_id' 	=> 1,
			'component_category_id' => 1,
			'component_id' 			=> 1,
			'component_value' 		=> '0.45',
			'added_by_id'			=> 1
        ]);

		DB::table($this->table_name)->insert([
			'product_id' 			=> 1,
			'mapping_type'			=> 'BRAND_NEW',
			'product_type_id' 		=> 1,
			'product_category_id' 	=> 1,
			'component_category_id' => 2,
			'component_id' 			=> 2,
			'component_value' 		=> '1',
			'added_by_id'			=> 1
        ]);

        DB::table($this->table_name)->insert([
			'product_id' 			=> 1,
			'mapping_type'			=> 'BRAND_NEW',
			'product_type_id' 		=> 1,
			'product_category_id' 	=> 1,
			'component_category_id' => 3,
			'component_id' 			=> 3,
			'component_value' 		=> '1',
			'added_by_id'			=> 1
        ]);

        DB::table($this->table_name)->insert([
			'product_id' 			=> 1,
			'mapping_type'			=> 'BRAND_NEW',
			'product_type_id' 		=> 1,
			'product_category_id' 	=> 1,
			'component_category_id' => 3,
			'component_id' 			=> 4,
			'component_value' 		=> '1',
			'added_by_id'			=> 1
        ]);
    }
}
