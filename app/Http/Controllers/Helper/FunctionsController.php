<?php

namespace App\Http\Controllers\Helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FunctionsController extends Controller
{
    
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
    public function serviceTypeMapping($service_type)
    {
    	switch($service_type)
    	{
    		case 'brand-new':
            case 'BRAND_NEW':
    			$return = 'BRAND_NEW';
    			break;
    		
    		case 'refill':
            case 'REFILL':
    			$return = 'REFILL';
    			break;
    		
    		case 'repaint':
            case 'REPAINT':
    			$return = 'REPAINT';
    			break;
    		
    		default:
    			$return = 'N/A';
    			break;
    	}

    	return  $return;
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
    public function getClientNameByAppNumber($app_number)
    {
        if( ! is_null($app_number))
        {
            $app_data = (array) \DB::select("SELECT APP_DATA FROM wf_workflow.APPLICATION WHERE APP_NUMBER = '$app_number'");
            // dd($app_data);
            $normalized_app_data = unserialize($app_data[0]->APP_DATA);

            return $normalized_app_data['CLIENT_NAME'];
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
    public function getSINumberByAppNumber($app_number)
    {
        if( ! is_null($app_number))
        {
            $app_data = (array) \DB::select("SELECT APP_DATA FROM wf_workflow.APPLICATION WHERE APP_NUMBER = '$app_number'");
            // dd($app_data);
            $normalized_app_data = unserialize($app_data[0]->APP_DATA);

            return $normalized_app_data['SI_NUMBER'];
        }
    }
}
