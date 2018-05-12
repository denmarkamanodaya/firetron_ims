<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mapping extends Model
{
    protected $table = 'mapping';

    public $timestamps = false;

	protected $fillable = [
		'mapping_type', 
		'product_id',
		'product_type_id',
		'product_category_id',
		'component_category_id',
		'component_id',
		'component_value',
		'added_by_id'
	];
}
