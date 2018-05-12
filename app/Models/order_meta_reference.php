<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_meta_reference extends Model
{
	
    protected $table = 'order_meta_reference';
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
    public static function createNew( 
        $app_number = null, 
        $product_code,
        $item_code, 
        $item_name, 
        $item_value, 
        $mapping_type,
        $item_type,
        $build_type)
    {
		$order_meta_reference_obj 			= new order_meta_reference;

        $order_meta_reference_obj->app_number	= $app_number;
        $order_meta_reference_obj->product_code	= $product_code;
        $order_meta_reference_obj->item_code    = $item_code;
        $order_meta_reference_obj->item_name 	= $item_name;
        $order_meta_reference_obj->item_value	= $item_value;
        $order_meta_reference_obj->mapping_type = $mapping_type;
        $order_meta_reference_obj->item_type	= $item_type;
        $order_meta_reference_obj->build_type   = $build_type;

        $order_meta_reference_obj->save();

        return $order_meta_reference_obj->id;
    }
}
