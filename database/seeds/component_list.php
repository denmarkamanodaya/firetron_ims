<?php

use Illuminate\Database\Seeder;

class component_list extends Seeder
{
	private $table_name = 'components';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table_name)->insert([
			'component_code' 			=> 'C001',
			'component_name'			=> 'MAP 40%',
			'component_category_id' 	=> 1,
			'added_by_id'				=> 1,
        ]);

        DB::table($this->table_name)->insert([
            'component_code'            => 'C002',
            'component_name'            => '1 lb. DC Cylinder',
            'component_category_id'     => 2,
            'added_by_id'               => 1,
        ]);

        DB::table($this->table_name)->insert([
            'component_code'            => 'C003',
            'component_name'            => 'DC Decal',
            'component_category_id'     => 3,
            'added_by_id'               => 1,
        ]);

        DB::table($this->table_name)->insert([
            'component_code'            => 'C004',
            'component_name'            => 'Plastic Cover',
            'component_category_id'     => 3,
            'added_by_id'               => 1,
        ]);


    }
}
