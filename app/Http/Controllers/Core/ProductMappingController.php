<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\mapping;
use App\Models\products;
use App\Models\product_category;
use App\Models\quantity;
use App\Models\components;
use Redirect;

class ProductMappingController extends Controller
{
	private $product_obj;


    /*
     | ----------------------------------------------------------------
     | Create
     | ----------------------------------------------------------------
     |
     | Show mapping form
     |
     |
     */
    public function create()
    {
    	$product_list 	= products::where('is_active', '=', 1)->orderBy('product_id', 'DESC')->get()->pluck('product_name', 'product_code');
    	$component_list = components::get()->pluck('component_name', 'component_code');

    	return view('mapping.create', compact('product_list', 'component_list'));
    }


	/*
	 | ----------------------------------------------------------------------------
	 | @resource Save
	 | ----------------------------------------------------------------------------
	 | 
	 | @author <denmarkamanodaya@gmail.com>
	 | @date 
	 |
	 | @description Save a component
	 |
	 |
	 */
	public function save(Request $request)
	{
		try
		{

			// Get component id by component_code
			$component_obj 	= components::where('component_code', '=', $request->component_code)->first();


			// Get mapping type from products
			$product_obj	= products::where('product_code', '=', $request->product_code)->first();


			// Validate component_id & product_id if already mapped
			if( ! mapping::where('component_id', '=', $component_obj->component_id)
					->where('product_id', '=', $product_obj->product_id)
					->where('mapping_type', '=', $request->service_type)
					->exists())
			{

				// Compute for mapping type 
				// $mapping_type 	= ( $product_obj->is_brand_new == 1 ? 'BRAND_NEW' : ( $product_obj->is_refill == 1 ? 'REFILL' : 'N/A') );

				
				// Add parameters to request object
				$request->request->add([
					'mapping_type' 	=> $request->service_type,
					'product_id'	=> $product_obj->product_id,
					'component_id'	=> $component_obj->component_id

				]);


				mapping::create($request->except('_token'));


				return $this->create();

			}
			else
			{
				return array(
					'code'		=> 1,
					'message'	=> 'Product already mapped with the selected component'
				);
			}

		}
		catch(\Exception $e)
		{
			return $e->getMessage();
		}
	}


	/*
	 | ----------------------------------------------------------------
	 | Show
	 | ----------------------------------------------------------------
	 |
	 | SELECT * FROM brand_new_mapping WHERE product_id = 
		(SELECT product_id FROM products WHERE product_code = 'P001')
		AND product_type_id = (SELECT type_id FROM product_type WHERE type_name = 'ASSEMBLED') 
		AND product_category_id = (SELECT category_id FROM product_category WHERE category_name = 'FIRE EXTINGUISHER');

	 |
	 | Show proper product-component mapping using PRODUCT_CODE
	 |
	 |
	 */
	public function show($service_type, $product_code)
	{	

		// Normalize service type
        $service_type = app('App\Http\Controllers\Helper\FunctionsController')->serviceTypeMapping($service_type);


		$this->product_obj = products::where('product_code', '=', $product_code)->first();

		if( ! is_null($this->product_obj) )
		{	

			$mapping_obj = mapping::where('mapping_type', '=', $service_type)->where('product_id', '=', $this->product_obj->product_id);

			if( $mapping_obj->exists() )
			{
				return array(
					'code'		=> 1,
					'message'	=> $mapping_obj->get(['component_id','component_value'])
				);
			}
			else
			{
				return array(
					'code'		=> 1,
					'message'	=> 'Mapping for selected product is empty'
				);
			}

		}
		else
		{
			return array(
				'code' 		=> 1,
				'message'	=> 'Product code not found'
			);
		}
	}
}
