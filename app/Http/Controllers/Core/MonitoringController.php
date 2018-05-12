<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\components;
use App\Models\quantity;
use App\Models\products;

class MonitoringController extends Controller
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
    public function process()
    {
        // $commission_obj = 
        //     \DB::select("SELECT a.agent_id, a.last_name, a.first_name, 
        //     SUM(c.amount) AS total_commission 
        //     FROM commission AS c 
        //     INNER JOIN agent AS a 
        //     ON c.agent_id = a.agent_id 
        //     WHERE a.is_active = 1 
        //     AND c.is_paid = 1
        //     GROUP BY a.agent_id, a.last_name, a.first_name 
        //     ORDER BY a.last_name ASC");

       	$statement = "SELECT 'PRODUCT' AS type, p.product_name AS item_name, q.quantity FROM quantity AS q
		INNER JOIN products AS p 
		ON p.product_code = q.code_id 
		UNION 
		SELECT 'COMPONENT' AS type, c.component_name AS item_name, q.quantity FROM quantity AS q
		INNER JOIN components AS c 
		ON c.component_code = q.code_id";

		$monitoring_obj = \DB::select($statement);

		return view('monitoring/show', compact('monitoring_obj'));
    }
}
