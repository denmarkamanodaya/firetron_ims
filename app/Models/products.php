<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
	protected $fillable = [
		'product_name', 
		'category_id', 
		'type_id', 
		'is_brand_new',
		'is_refill',
		'is_repaint',
		'added_by_id'
	];
}
