<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class return_order extends Model
{
    protected $table = 'return_order';

    /*
     | ----------------------------------------------------------------------------
     | @resource Create Return Order Log
     | ----------------------------------------------------------------------------
     | 
     | @author <denmarkamanodaya@gmail.com>
     | @date 
     |
     | @description Create return log
     |
     |
     */
    public static function createReturnOrder($app_number, $description, $client_name, $usr_username)
    {
		$return_order 				= new return_order;

        $return_order->app_number 	= $app_number;
        $return_order->description  = $description;
        $return_order->usr_username = $usr_username;
        $return_order->client_name  = $client_name;

        $return_order->save();
    }
}
