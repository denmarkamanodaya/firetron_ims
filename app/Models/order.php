<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table = 'orders';


    /*
     | ----------------------------------------------------------------------------
     | @resource Create Order
     | ----------------------------------------------------------------------------
     | 
     | @author <denmarkamanodaya@gmail.com>
     | @date 
     |
     | @description Create order, uses order_id in order_meta table
     | for referencing
     |
     |
     */
    public static function createNew($app_number)
    {
		$order_obj 				= new order;

        $order_obj->app_number	= $app_number;
        
        $order_obj->save();

        return $order_obj->id;
    }
}
