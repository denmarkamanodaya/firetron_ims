<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\order;
use App\Models\order_meta;
use App\Models\order_meta_reference;

use App\Models\products;
use App\Models\quantity;
use App\Models\return_order;


class ReturnController extends Controller
{

	private $print_desc = "";

	public function index()
	{
		return view('return.index');
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
    public function process(Request $request)
    {
        // error_log("\n" . print_r(array($request->app_number), true), 3, '/tmp/test_log');

        try
        {
            $app_number = $request->app_number;

            // Get the order_id from app_number
            // $order_ref_obj = order_meta_reference::where('app_number', '=', $app_number)->get();
            $order_ref_obj = \DB::select("SELECT (count(item_code) * item_value) AS add_back_value, count(item_code) AS count, item_code, item_name, item_value FROM order_meta_reference WHERE app_number = {$app_number} GROUP BY item_code, item_value, item_name");
            
            if( ! empty($order_ref_obj) )
            {

	            foreach( $order_ref_obj AS $key => $value )
	            {
	                // $this->print_desc .= "Item Name: " . $value->item_name .  " Total Count: " . $value->count . 
	                	// " Total Returned Value: " . $value->add_back_value . " Original Value: " . $value->item_value . "<br/>";

	                app('App\Http\Controllers\Core\QuantityController')->quantityAdd($value->item_code, $value->add_back_value);
	                
	                #app('App\Http\Controllers\Core\QuantityController')->quantitySub($value->item_code, $value->add_back_value);
	            }

	            // Change order is_active status to 0
	            order::where('app_number', '=', $app_number)->update(['is_active' => 0]);

                // Get Client Name
                $client_name = app('App\Http\Controllers\Helper\FunctionsController')->getClientNameByAppNumber($app_number);

	            // Return order log
	            return_order::createReturnOrder($app_number, $request->description, $client_name, 'Administrator');

                // Disable comission
                app('App\Http\Controllers\Core\CommissionsController')->deactivateComission($app_number);

	            // \Session::flash('message', "Purchases returned successfully.");
                return 'Purchases returned successfully.';

	        }
	        else
	        {
	        	// \Session::flash('message', "APP_NUMBER not found!");	
                return 'APP_NUMBER not found!';
	        }

        	// return \Redirect::back();

        }
        catch(\Exception $e)
        {
            return print $e->getMessage();
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
    public function cancellationList()
    {
        $cancellation_obj = return_order::get();

        return view('return.cancellation_list', compact('cancellation_obj'));
    }
}
