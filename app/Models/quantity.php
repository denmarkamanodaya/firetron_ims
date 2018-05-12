<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class quantity extends Model
{
    protected $table = 'quantity';

    /*
     | ----------------------------------------------------------------------------
     | @resource Create Initial Quantity
     | ----------------------------------------------------------------------------
     | 
     | @author <denmarkamanodaya@gmail.com>
     | @date 
     |
     | @description Create initial quantity for PRODUCT_CODE
     | Since it's automated, added_by should always be 1 (Admin)
     |
     |
     */
    public static function createQuantity($code_id, $quantity)
    {
		$quantity_obj 				= new quantity;

        $quantity_obj->code_id		= $code_id;
        $quantity_obj->quantity 	= ( $quantity == "" ? 0 : $quantity );
        $quantity_obj->added_by_id 	= 1;

        $quantity_obj->save();
    }
}
