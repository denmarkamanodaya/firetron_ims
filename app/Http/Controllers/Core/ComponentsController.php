<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\component_category;
use App\Models\components;
use App\Models\quantity;
use Redirect;

class ComponentsController extends Controller
{

    protected $model_prefix     = 'C';
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
        $component_category   = component_category::get()->pluck('category_name', 'category_id');
        
        return view('components.create' , compact('component_category'));
    }


	/*
	 | ----------------------------------------------------------------------------
	 | @resource Save
	 | ----------------------------------------------------------------------------
	 | 
	 | @author <denmarkamanodaya@gmail.com>
	 | @date 
	 |
	 | @description save a component
	 |
	 |
	 */
	public function save(Request $request)
	{
		try
		{
			$data           	= components::create($request->except('_token', 'quantity'));
            $component_code   	= $this->model_prefix . str_pad($data->id, $this->model_pad_count, '0', STR_PAD_LEFT);
            $component_obj    	= components::where('component_id', '=', $data->id)->update([
                'component_code' => $component_code
            ]);


            // Set quantity
			quantity::createQuantity($component_code, $request->component_quantity);

			return Redirect::route('components.create');

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
	public function quantityAdd(Request $request)
	{	
		// Add new quantity by component_id from quantity table
		app('App\Http\Controllers\Core\QuantityController')->quantityAdd($request->component_id, $request->quantity);
	}
}
