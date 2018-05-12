<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\quantity;
use App\Models\products;
use App\Models\mapping;
use App\Models\components;
use App\Models\order_meta;
use App\Models\order_meta_reference;

class QuantityController extends Controller
{

    private $app_number;
    private $order_id;
    private $order_meta_id;
    private $service_type;

    /*
     | ----------------------------------------------------------------
     | 
     | ----------------------------------------------------------------
     |
     | 
     |
     */
    public function quantityAdd($product_code, $add_value)
    {
    	quantity::where('code_id', '=', $product_code)
    		->update([
                'quantity' => quantity::where('code_id', '=', $product_code)
                    ->first()
                    ->quantity + $add_value
            ]);
    }

    /*
     | ----------------------------------------------------------------------------
     | @resource Subtract
     | ----------------------------------------------------------------------------
     | 
     | @author <denmarkamanodaya@gmail.com>
     | @date 
     |
     | @description Main update query for quantity subtraction
     |
     |
     */
    public function quantitySub($code_id, $sub_value)
    {
        
        quantity::where('code_id', '=', $code_id)
            ->update([
                'quantity' => quantity::where('code_id', '=', $code_id)
                    ->first()
                    ->quantity - $sub_value
            ]);
    }


    /*
     | ----------------------------------------------------------------------------
     | @resource Less Stock
     | ----------------------------------------------------------------------------
     | 
     | @author <denmarkamanodaya@gmail.com>
     | @date 
     |
     | @description subtract 1 whole product in the inventory
     | If product already out of stock, subtract from components
     | automatically
     |
     |
     */
    public function lessStock($app_number, $quantity = 1, $service_type, $product_code, $order_id)
    {

        $this->app_number   = $app_number;
        $this->order_id     = $order_id;


        // Normalize service type
        $this->service_type = app('App\Http\Controllers\Helper\FunctionsController')->serviceTypeMapping($service_type);
        
        while( $quantity != 0 )
        {

            // Get product object
            $product_obj = products::where('product_code', '=', $product_code);


            // If product exists, subract 1 to quantity table 
            // If quantity of the product < 0
            // Perform subtraction from mapping table
            if( $product_obj->exists() )
            {

                // Store to order_meta table for history referencing
                $this->order_meta_id = order_meta::createNew(
                    $this->order_id, 
                    $product_obj->first()->product_id, 
                    $product_obj->first()->product_code, 
                    $product_obj->first()->product_name,
                    $this->service_type);


                // Get quantity for product, by product_code
                $quantity_obj = quantity::where('code_id', '=', $product_code);


                // Validate if product quantity is !< 0
                if( $quantity_obj->first()->quantity >= 1 )
                {

                    $this->quantitySub($product_code, 1);

                    // Add to order_meta_reference
                    order_meta_reference::createNew(
                        $this->app_number, 
                        $product_obj->first()->product_code, 
                        $product_obj->first()->product_code, // same: basically product is the same as item_code in stock
                        $product_obj->first()->product_name, 
                        1, 
                        $this->service_type,
                        'STOCK',
                        'PROCESSMAKER'
                    );

                }
                else
                {     

                    // Still minus the stock product to reflect negative value
                    $this->quantitySub($product_code, 1);


                    
                    // If product quantity is already empty
                    // Subtract from components mapping
                    $this->lessRaw('PROCESSMAKER', $product_code, $this->service_type);

                }

            }
            else
            {
                return array(
                    'code'      => 1,
                    'message'   => 'Product does not exists'
                );
            }


            $quantity--;

        }
    }


    /*
     | ----------------------------------------------------------------------------
     | @resource Less Raw
     | ----------------------------------------------------------------------------
     | 
     | @author <denmarkamanodaya@gmail.com>
     | @date 
     |
     | @description Subtract via components
     |
     |
     */
    public function lessRaw($build_type, $product_code, $mapping_type)
    {

        $code = 1;
        
        // Initially get product id
        $product_obj = products::where('product_code', '=', $product_code);

        if( $product_obj->exists() )
        { 

            // Get all component mappings using product code
            $mapping_obj = mapping::where('product_id', '=', $product_obj->first()->product_id)->where('mapping_type', '=', $mapping_type);
            
            if( $mapping_obj->exists() )
            {

                // Loop through mapping object to get component_id
                foreach( $mapping_obj->get() AS $key => $value )
                {
                    $component_obj  = components::where('component_id', '=', $value->component_id)->first();

                    $component_name = $component_obj->component_name;
                    $component_code = $component_obj->component_code;

                    // Validate product if has quantity
                    if( quantity::where('code_id', '=', $component_code)->exists() )
                    {

                        $this->quantitySub($component_code, $value->component_value);

                        // Add order_meta_reference
                        order_meta_reference::createNew(
                            ( $build_type == 'PROCESSMAKER' ? $this->app_number : null), 
                            $product_code, 
                            $component_code,
                            $component_name, 
                            $value->component_value, 
                            $mapping_type,
                            'RAW_MATERIALS',
                            ( $build_type == 'PROCESSMAKER' ? 'PROCESSMAKER' : 'GUI' )
                        );
                    }
                    else
                    {
                        return array(
                            'code'      => 1,
                            'message'   => "{$component_code} has no quantity"
                        );
                    }

                }

            }
            else
            {
                return array(
                    'code'      => 1,
                    'message'   => 'Product mapping does not exist'
                ); 
            }

        }
        else
        {
            return array(
                'code'      => 1,
                'message'   => 'Product does not exist'
            );                 
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
    public function showMapping()
    {
        $quantity_obj = \DB::select("SELECT p.product_name AS item_name, q.quantity FROM products AS p
            INNER JOIN quantity AS q 
            ON p.product_code = q.code_id
            UNION
            SELECT c.component_name AS item_name, q.quantity FROM components AS c
            INNER JOIN quantity AS q 
            ON c.component_code = q.code_id");

        return view('quantity.show', compact('quantity_obj'));
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
    public function showMappingStock()
    {
        $quantity_obj = \DB::select("SELECT p.product_name AS item_name, q.quantity, p.product_code AS item_code FROM products AS p
            INNER JOIN quantity AS q 
            ON p.product_code = q.code_id");

        $is_raw = false;
        
        return view('quantity.show', compact('quantity_obj', 'is_raw'));
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
    public function showMappingRaw()
    {
        $quantity_obj = \DB::select("SELECT c.component_name AS item_name, q.quantity, q.code_id FROM components AS c
            INNER JOIN quantity AS q 
            ON c.component_code = q.code_id");
        
        $is_raw = true;

        return view('quantity.show', compact('quantity_obj', 'is_raw'));
    }
}
