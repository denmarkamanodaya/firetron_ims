<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class agent extends Model
{
    protected $table = 'agent';

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
    public static function createAgent($request)
    {
		$agent 				= new agent;

        $agent->full_name	= strtoupper( $request->agent_full_name );
        // $agent->first_name 	= strtoupper( $request->agent_first_name );
        $agent->added_by_id	= $request->added_by_id;

        $agent->save();
    }

    /*
     | ----------------------------------------------------------------------------
     | @resource Get All Active Agents
     | ----------------------------------------------------------------------------
     | 
     | @author <denmarkamanodaya@gmail.com>
     | @date 
     |
     | @description
     |
     |
     */
    public static function scopeGetAllActive($query)
    {
    	return $query->where('is_active', '=', 1)->get();
    }
}
