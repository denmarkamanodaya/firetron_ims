<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\products;
use App\Models\product_category;
use App\Models\product_type;
use App\Models\product_type_meta;
use App\Models\quantity;
use App\Models\mapping;
use App\Models\components;

class ProductsController extends Controller
{

    protected $model_prefix     = 'P';
    protected $model_pad_count  = 3;

    /*
     | ----------------------------------------------------------------
     | Create
     | ----------------------------------------------------------------
     |
     | Show product create form
     |
     |
     */
    public function create()
    {
        $product_type       = product_type::get()->pluck('type_name', 'type_id');
        $product_category   = product_category::get()->pluck('category_name', 'category_id');

        return view('products.create' , compact('product_category', 'product_type'));
    }


    /*
     | ----------------------------------------------------------------
     | Save
     | ----------------------------------------------------------------
     |
     | 1. Create product and create product_id
     | 2. Create product_type_meta mapping by using newly created product_id
     | 3. Create quantity from newly created product
     |
     |
     */
    public function save(Request $request)
    {
        try
        {

            $data           = products::create($request->except('_token'));
            $product_code   = $this->model_prefix . str_pad($data->id, $this->model_pad_count, '0', STR_PAD_LEFT);
            $product_obj    = products::where('product_id', '=', $data->id)->update([
                'product_code' => $product_code
            ]);


            // Product type meta mapping
            product_type_meta::createMeta($request, $data->id);


            // Create quantity
            quantity::createQuantity($product_code, $request->product_quantity);


            // If product type is ASSEMBLED, redirect to components view
            // So user could select proper components for newly created
            // product
            if($request->type_id == 1)
            {
                #return app('App\Http\Controllers\Core\ComponentsController')->create();
                return app('App\Http\Controllers\Core\ProductMappingController')->create();
            }
            

            return array(
                'code'      => 0,
                'message'   => 'Success'
            );

        }
        catch(\Exception $e)
        {
            print $e->getMessage();
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
    public function createProductFromMapping($service_type, $product_code, $loop = 1)
    {
        while( $loop != 0 )
        {
            // Subtract product based mapping   
            app('App\Http\Controllers\Core\QuantityController')->lessRaw("GUI", $product_code, $service_type);


            // No additional stock if REPAINT
            if( $service_type != 'REPAINT' )
            {
                // Add stock to product
                app('App\Http\Controllers\Core\QuantityController')->quantityAdd($product_code, 1);
            }

            $loop --;

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
    public function mapping()
    {
        $product_mapping_data = \DB::select("SELECT 
            m.mapping_type, 
            c.component_name, m.component_value, 
            p.product_name, p.product_code, p.is_active
            FROM mapping AS m
            INNER JOIN products AS p 
            ON m.product_id = p.product_id 
            INNER JOIN components AS c 
            ON m.component_id = c.component_id
            ORDER BY m.mapping_type ASC");

        return view('products.mapping' , compact('product_mapping_data'));
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
    public function show_build()
    {
        $products = products::where('is_active', '=', 1)->where('type_id', '=', 1)->get();
        // dd($products);
        return view('products.build', compact('products'));
    }

    /*
     | ----------------------------------------------------------------------------
     | @resource Build Product 
     | ----------------------------------------------------------------------------
     | 
     | @author <denmarkamanodaya@gmail.com>
     | @date 
     |
     | Mimics the product_create from mapping method but with additional feature
     | of pop message to notify the client.
     |
     |
     */
    // public function build( $service_type, $product_code, $quantity )
    public function build(Request $request)
    {
        //dd($request->service_type, $request->product_code, $request->quantity );
        #dd(app('App\Http\Controllers\Helper\FunctionsController')->serviceTypeMapping($request->service_type), $request->service_type, $request->product_code, $request->quantity);

        $this->createProductFromMapping( 
            app('App\Http\Controllers\Helper\FunctionsController')->serviceTypeMapping($request->service_type), 
            $request->product_code, 
            (empty($request->quantity) ? 1 : $request->quantity)
        );

        \Session::flash('message', "Product has been build.");

        return \Redirect::back();
    }

}
