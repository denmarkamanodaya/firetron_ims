<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class commission extends Model
{
    protected $table = 'commission';

    /*
     | ----------------------------------------------------------------------------
     | @resource Save Commission 
     | ----------------------------------------------------------------------------
     | 
     | @author <denmarkamanodaya@gmail.com>
     | @date 
     |
     | @description
     |
     |
     */
    public static function commissionAdd($amount, $app_number, $note, $agent_name)
    {
    	$commission_obj = new commission;

    	$commission_obj->app_number   = $app_number;
    	$commission_obj->amount 	  = $amount;
        $commission_obj->agent_name   = $agent_name;
        $commission_obj->notes = $note;

    	$commission_obj->save();
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
    public static function commissionPaidTagging($app_number)
    {
        $commission_obj = commission::where('app_number', '=', $app_number)
                            ->update(['is_paid' => 1]);
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
     | Tag as 0 if deleted
     |
     |
     */
    public static function commissionDeactivateTagging($app_number)
    {
        $commission_obj = commission::where('app_number', '=', $app_number)
                            ->update(['is_active' => 0]);
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
    public static function scopePending($query)
    {
        #return $query->where('is_paid', '=', 0)->get();

        // return $query->join('agent', 'agent.agent_id', '=', 'commission.agent_id')
        //     ->where('commission.is_paid', '=', 0)
        //     ->get();

        return commission::where('is_paid', '=', 0)->get();
    }
}
