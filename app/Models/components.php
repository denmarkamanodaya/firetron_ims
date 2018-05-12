<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class components extends Model
{
    protected $table = 'components';

	protected $fillable = [
		'component_name', 
		'component_category_id',
		'added_by_id'
	];
}
