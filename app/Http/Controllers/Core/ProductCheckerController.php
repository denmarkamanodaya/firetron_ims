<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\quantity;
use App\Models\products;
use App\Models\mapping;
use App\Models\components;

use Response;

class ProductCheckerController extends Controller
{

	private $_product_code;
	private $_quantity;

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
    public function check($product_code, $quantity)
    {
        try
        {
            // check if product exists
            $product_obj = products::where('product_code', '=', $product_code);

            if( $product_obj->exists() )
            {

                $this->_product_code    = $product_code;
                $this->_quantity        = $quantity;

                #dd($this->process());

                return Response::json([$this->process()]);
            }
            else
            {
                return array(
                    'code' => 1,
                    'message' => 'Product does not exists!'
                );
            }
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
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
     | @return true or false
     |
     |
     */
    private function process()
    {   
        try
        {
            // First check if product has an available stock from quantity table
            $quantity_obj = quantity::where('code_id', '=', $this->_product_code)->first();

            // Compare stock quantitiy versus selected purchase quantity
            $deficit = $quantity_obj->quantity - $this->_quantity;

            if($deficit < 0)
            {   
                $normalized_deficit = abs($deficit);

                return array(
                    'code'      => 1,
                    'message'   => 'Product has no available stock'
                );
            }
            else
            {
                return array(
                    'code'      => 0,
                    'message'   => 'Product has available stock'
                );
            }
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }
    }
}
