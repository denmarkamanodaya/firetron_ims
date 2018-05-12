<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\agent;
use App\Models\commission;

class CommissionsController extends Controller
{
    /*
     | ----------------------------------------------------------------
     | Create
     | ----------------------------------------------------------------
     |
     | Show commssion create form
     |
     |
     */
    public function create()
    {
        return view('commission.create');
    }

    /*
     | ----------------------------------------------------------------
     | Save
     | ----------------------------------------------------------------
     |
     | Save agent
     |
     |
     */
    public function save(Request $request)
    {
        try
        {
            $agent_obj          = agent::where('full_name', '=', strtoupper( $request->agent_full_name ));

            if( $agent_obj->exists() )
            {
                return array(
                    'code'      => 1,
                    'message'   => 'Agent already exists!'
                );
            }
            else
            {
                agent::createAgent($request);

                return \Redirect::back();
            }
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
    public function commissionAdd(Request $request)
    {	
        // error_log("/n" . print_r(array($request), true), 3, '/tmp/test_commission_log');

    	try
    	{
			// Check commission if already been mapped using app_number
			if( commission::where('app_number', '=', $request->app_number)->exists() )
			{
                return array(
                    'code'      => 1,
                    'message'   => 'Commission has already been added, cant add more that 1 commission per app_number'
                );
            }
            else
            {
				commission::commissionAdd($request->amount, $request->app_number, $request->notes, $request->agent_name);

                return array(
                    'code'      => 0,
                    'message'   => 'Commission has been added with value of ' . $request->amount . ' under case # ' . $request->app_number,
                );
            }
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
    public function commissionPaidTagging($app_number)
    {
        try
        {  
            commission::commissionPaidTagging($app_number);

            return array(
                'code'      => 0,
                'message'   => 'Commission status for APP_NUMBER ' . $app_number . ' is now changed to PAID.',
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
     public function show()
     {
        $commission_obj = 
            \DB::select("SELECT c.app_number, c.amount, c.notes
            FROM commission AS c 
            AND c.is_paid = 1
            ORDER BY c.app_number");

		return view('commission.mapping' , compact('commission_obj'));
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
    public function pending()
    {
        $pending_obj = commission::pending();
        // dd($pending_obj);
        return view('commission.pending' , compact('pending_obj'));
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
    public function savePending(Request $request)
    {
        $request_obj = $request->all();

        if( ! empty($request_obj['commission_array']) )
        {
            foreach( $request_obj['commission_array'] AS $key => $value )
            {
                commission::commissionPaidTagging( $value );
            }

            return \Redirect::route('commission.pending');
        }
        else
        {
            return array(
                'code'      => 1,
                'message'   => 'Commission data is empty!',
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
    public function deactivateComission($app_number)
    {
        commission::commissionDeactivateTagging($app_number);
    }
}
