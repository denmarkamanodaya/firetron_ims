<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\order;
use App\Models\order_meta;
use App\Models\order_meta_reference;

use App\Models\products;
use App\Models\quantity;

class OrderController extends Controller
{
	// private $product_obj;
	private $app_number;

	/*
	 | ----------------------------------------------------------------
	 | Purchase Order API
	 | ----------------------------------------------------------------
	 |
	 | This will lessen/minus 1 product in the inventory system 
	 | using PRODUCT_CODE as identifier. 
	 |
	 | Used in Processmaker
	 |
	 |
	 */
    public function process($app_number, $service_type , $product_code = null, $quantity = 0)
    {	

    	// Check if order already exists, if not create order_id
    	$order_obj = order::where('app_number', '=', $app_number);

        // Normalize service type
        $service_type = app('App\Http\Controllers\Helper\FunctionsController')->serviceTypeMapping($service_type);

    	if( ! $order_obj->exists() )
    	{

        	// Add to orders table to generate order ID for product servicing
            $order_id = order::createNew($app_number);
	    	
	    	// Lessen product or raw materials
            app('App\Http\Controllers\Core\QuantityController')->lessStock($app_number, $quantity, $service_type, $product_code, $order_id);

		}
		else
		{

            // Get order_id if already exists
            $order_id = order::where('app_number', '=', $app_number)->first()->order_id;

            // Lessen product or raw materials
            app('App\Http\Controllers\Core\QuantityController')->lessStock($app_number, $quantity, $service_type, $product_code, $order_id);
		}

    }

    /*
     | ----------------------------------------------------------------------------
     | @resource TITLE
     | ----------------------------------------------------------------------------
     | 
     | @author <denmarkamanodaya@gmail.com>
     | @date 
     |
     | @description
     |
     |
     */
    public function showHistory()
    {

    	$order_history = order::where('is_active', '=', 1)->get();

    	return view('order.history', compact('order_history'));

    }

    /*
     | ----------------------------------------------------------------------------
     | @resource TITLE
     | ----------------------------------------------------------------------------
     | 
     | @author <denmarkamanodaya@gmail.com>
     | @date 
     |
     | @description
     |
     |
     */
    public function showSingleHistory( $app_number )
    {
        
    	// Get order_id from oder obj by app_number
    	#$order_obj = order::where('app_number', '=', $app_number)->first();

    	// Get order_meta by order_id
    	// $order_meta_obj = order_meta::where('order_id', '=', $order_obj->order_id)->get();
        $order_meta_obj = \DB::select("SELECT count(p.product_id) AS item_total, p.product_name, p.product_id, p.order_id FROM order_meta AS p 
            INNER JOIN orders AS o 
            ON p.order_id = o.order_id 
            WHERE o.app_number = $app_number
            GROUP BY p.product_id, p.product_name, p.product_id, p.order_id");


    	return view('order.single-history', compact('order_meta_obj'));
        
    }

    /*
     | ----------------------------------------------------------------------------
     | @resource TITLE
     | ----------------------------------------------------------------------------
     | 
     | @author <denmarkamanodaya@gmail.com>
     | @date 
     |
     | @description
     |
     |
     */
    public function showDetailedHistory( $order_id, $product_id )
    {

        // Get order_id from order table by app_number
        #$order_obj = order::where('app_number', '=', $app_number)->first();

        // Get order_meta_obj
        #$order_meta_obj = \DB::select("SELECT count(order_meta_id) AS item_count, product_name, service_type FROM order_meta WHERE order_id = {$order_id} GROUP BY product_name, service_type ORDER BY item_count DESC");

        $app_number     = order::where('order_id', '=', $order_id)->first()->app_number;
        $product_code   = products::where('product_id', '=', $product_id)->first()->product_code;

        $order_meta_reference_obj = \DB::select("SELECT * FROM order_meta_reference WHERE product_code = '$product_code' AND app_number = $app_number");

        #dd($order_meta_reference_obj);

        $product_name = products::where('product_id', '=', $product_id)->first()->product_name;

        return view('order.detailed-history', compact('order_meta_reference_obj', 'product_name'));
    }

    /*
     | ----------------------------------------------------------------------------
     | @resource TITLE
     | ----------------------------------------------------------------------------
     | 
     | @author <denmarkamanodaya@gmail.com>
     | @date 
     |
     | @description
     |
     |
     */
    public function showSuperDetailedHistory( $item_code, $type)
    {
        $mapping_type       = ( strtoupper($type) == 'RAW' ? 'RAW_MATERIALS' : 'STOCK' );

        // $original_obj       = \DB::select("SELECT item_name FROM order_meta_reference WHERE item_code = '$item_code' LIMIT 1");
        // Get main obj
        if($mapping_type == 'RAW_MATERIALS')
        {
            $original_query = "SELECT * FROM components WHERE component_code = '$item_code'";
            $original_obj   = \DB::select($original_query);
            $original_name  = $original_obj[0]->component_name;
        }
        else
        {
            $original_query = "SELECT * FROM products WHERE product_code = '$item_code'";
            $original_obj   = \DB::select($original_query);
            $original_name  = $original_obj[0]->product_name;
        }

        $query = "SELECT omc.*, o.created_at, p.product_name FROM orders AS o INNER JOIN (
             SELECT count(*) AS total_count, item_value, item_value * count(*) AS total_value, 
             app_number, mapping_type, product_code, item_type
             FROM order_meta_reference WHERE item_code = '$item_code' 
             AND item_type = '$mapping_type'
             AND app_number IS NOT NULL 
             GROUP BY app_number, mapping_type, product_code, item_type, item_value
         ) AS omc ON omc.app_number = o.app_number 
         INNER JOIN products AS p 
         ON p.product_code = omc.product_code";

        $super_detailed_obj = \DB::select($query);
        $item_name          = $original_name;
        $item_quantity      = quantity::where('code_id', '=', $item_code)->first()->quantity;   

        // clean item_quantity based on type, if raw can have negative values, if stock maxed at 0
        $item_quantity      = ( ( $mapping_type == 'RAW_MATERIALS' ) ? $item_quantity : ( ( $item_quantity < 0 ) ? 0 : $item_quantity ) );

        // dd($item_code, $mapping_type, $super_detailed_obj, $item_name, $item_quantity);     

        return view('order.super-detailed-history', compact('super_detailed_obj', 'item_name', 'item_quantity'));
    }


}
