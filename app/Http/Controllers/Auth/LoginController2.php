<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController2 extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest', ['except' => 'logout']);
    // }


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
    public function index()
    {
        return view('auth.login');
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
    public function auth(Request $request)
    {
        // dd($request->all());

        // $pm_user_data   = \DB::connection('rb_workflow')->select("SELECT 
        //     USR_UID, USR_USERNAME, USR_FIRSTNAME, USR_LASTNAME, USR_EMAIL
        //     FROM USERS 
        //     WHERE USR_USERNAME = '$request->username' 
        //     AND USR_PASSWORD = MD5('$request->password')");

        $client = new \SoapClient(env('PM_URL').'services/wsdl2');

        // $params = array(array('userid' => $request->username, 'password' => $request->password));
        
        $result = $client->__SoapCall('login', [[
                'userid'    => $request->username, 
                'password'  => $request->password        
        ]]);


        if($result->status_code == 0)
        {

            $user_array = \DB::connection('rb_workflow')->select("SELECT 
                USR_UID, USR_USERNAME, USR_FIRSTNAME, USR_LASTNAME, USR_EMAIL
                FROM USERS 
                WHERE USR_USERNAME = '$request->username'");

            $user_id = ($user_array[0]->USR_UID);

            $group_data   = \DB::connection('rb_workflow')->select("SELECT GW.GRP_TITLE FROM GROUP_USER AS G 
                INNER JOIN GROUPWF AS GW 
                ON G.GRP_UID = GW.GRP_UID
                WHERE G.USR_UID = '$user_id'");
    
            // Normalize Group Array
            foreach($group_data AS $key => $value)
            {
                $group_array[$key] = $value->GRP_TITLE;
            }

            \Session::put('logged_user',    $user_array); 
            \Session::put('group_user',     $group_array); 

            return redirect('/');
        }   
        else
        {
            \Session::flash('flash_message', 'User not found!');
            \Session::flash('flash_type',    'danger');
                
            return view('auth.login');
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
    public function logout()
    {
        \Session::flush();
        return redirect('/login');
    }
}
