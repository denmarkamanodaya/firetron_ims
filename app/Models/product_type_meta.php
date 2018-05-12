<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_type_meta extends Model
{
    protected $table = 'product_type_meta';
    public $timestamps = false;

    /*
     | ----------------------------------------------------------------------------
     | @resource Product - Type Meta
     | ----------------------------------------------------------------------------
     | 
     | @author <denmarkamanodaya@gmail.com>
     | @date 
     |
     | @description Used in Processmaker Dynaform as dropdown dependencies
     |
     |
     */
    public static function createMeta($request_obj, $product_id)
    {
        $loop_array = [];

	    if( ! empty($request_obj->is_refill))
	    {
	        array_push($loop_array, "REFILL");
	    }

	    if( ! empty($request_obj->is_brand_new))
	    {
	       array_push($loop_array, "BRAND_NEW");
	    }

	    if( ! empty($request_obj->is_repaint))
	    {
	        array_push($loop_array, "REPAINT");
	    }

	    if( empty($request_obj->is_refill) && empty($request_obj->is_brand_new) && empty($request_obj->is_repaint) )
	    {
	        array_push($loop_array, "N/A");
	    }

        foreach( $loop_array AS $key => $value )
        {
    		$product_type_meta 				= new product_type_meta;

            $product_type_meta->product_id	= $product_id;
            $product_type_meta->type_name 	= $value;

            $product_type_meta->save();
        }
	}
}
