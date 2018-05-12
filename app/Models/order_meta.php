<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_meta extends Model
{
	
    protected $table = 'order_meta';
    public $timestamps = false;

    /*
     | ----------------------------------------------------------------------------
     | @resource Create Order Meta
     | ----------------------------------------------------------------------------
     | 
     | @author <denmarkamanodaya@gmail.com>
     | @date 
     |
     | @description Create order_meta, referenced by order_id
     | detailed description of the item, either
     | stock or raw materials
     |
     |
     */
    public static function createNew($order_id, $product_id, $product_code, $product_name, $service_type)
    {
		$order_meta_obj 			= new order_meta;

        $order_meta_obj->order_id	= $order_id;
        $order_meta_obj->product_id = $product_id;
        $order_meta_obj->product_code= $product_code;
        $order_meta_obj->product_name= $product_name;
        $order_meta_obj->service_type= $service_type;

        $order_meta_obj->save();

        return $order_meta_obj->id;
    }
}
