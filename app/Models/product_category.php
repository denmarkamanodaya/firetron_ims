<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_category extends Model
{
    protected $table = 'product_category';

    /*
     | ----------------------------------------------------------------
     | Get All Active
     | ----------------------------------------------------------------
     |
     | 
     |
     */
    public function scopeAll($query)
    {
        return $query->get();
    }
}
