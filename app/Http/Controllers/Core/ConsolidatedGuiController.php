<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConsolidatedGuiController extends Controller
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
	public function index()
	{
		try
		{	
			$this->htmlHeaders()->process()->htmlFooter();
		}	
		catch(\Exception $e)
		{
			dd($e->getMessage());
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
	private function type_unknown()
	{
		echo 'ERROR';
		return $this;
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
	public function buy_and_sell_index()
	{
		try
		{	
			$this->htmlHeaders()->process2()->htmlFooter();
		}	
		catch(\Exception $e)
		{
			dd($e->getMessage());
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
	public function commission_index()
	{
		try
		{
			$this->htmlHeaders()->commissionProcess()->htmlFooter();
		}
		catch(\Exception $e)
		{
			dd($e->getMessage());
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
	public function selection()
	{
		echo "<a href='/gui/brand-new'>BRAND NEW</a> <br/>";
		echo "<a href='/gui/refill'>REFILL</a> <br/>";
		echo "<a href='/gui/buy_and_sell'>BUY & SELL</a> <br/>";
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
	public function process()
	{
		// SELECT * FROM products WHERE is_refill = 1;
		$products_obj = \DB::select("SELECT product_id, product_code, product_name FROM products WHERE is_active = 1 AND type_id = 1");
		
		$thead = "<tr><td style='min-width: 420px; background-color:#fff'>
		<br/>Visit <a href='/gui/buy-and-sell'>Buy & Sell</a> Interface?<br/><br/>
		Mapping Type: <span class='toggle_type_info'>BRAND_NEW</span><span class='toggle_type_info' style='display: none'>REFILL</span> <a href='#' class='toggle-type'>[!?]</a><br/>
		<br/>
		Component <a id='add-new-component' data-type='components' href='#'>[+]</a> 
		<br/>
		Product <a id='add-new-product' data-type='products' href='#'>[+]</a>
		</td>";

		foreach($products_obj AS $key => $value)
		{
			// Get quantity
			$remaining_obj = \DB::select("SELECT quantity FROM quantity WHERE code_id = '{$value->product_code}'");

			$thead .= "<td style='background-color:#fff; min-width: 75px'  class='touchable {$value->product_code}' data-col='{$value->product_code}'>
				{$value->product_name} / {$remaining_obj[0]->quantity} 
					<br/>
					<a class='edit-mapping' data-product-code='{$value->product_code}' href='#'>[e]</a>  
					<a class='add-mapping' data-product-code='{$value->product_code}' href='#''>[+]</a>  
					<a style='color:#ff0000' class='remove-mapping' data-product-code='{$value->product_code}' href='#''>[-]</a> --  
					<a style='color:#ff0000' href='#' class='delete-product' data-type='products' data-code='{$value->product_code}'>[x]</a>
			</td>";		

			$product_code_array[] = $value->product_code;
		}

		$thead .= '</tr>';
		
		$components_obj = \DB::select("SELECT * FROM components");

		foreach($components_obj AS $key => $value)
		{	
			foreach($product_code_array AS $key_1 => $value_1)
			{
				#$omr_obj = \DB::select("SELECT SUM(item_value) AS total_quantity FROM order_meta_reference WHERE product_code = '{$value_1}' AND item_code = '{$value->component_code}'");
				// Add initial data
                if($key_1 == 0)
                {
                    $remaining_obj = \DB::select("SELECT quantity FROM quantity WHERE code_id = '{$value->component_code}'");
                    $row_data[$value->component_code][$value->component_code] = "<a class='tracking-content-button' data-component-code='{$value->component_code}' href='#'>" . $value->component_name . " / " . $remaining_obj[0]->quantity . "</a> 
<a style='color:#ff0000' href='#' class='add-raw-component' data-type='add' data-code='{$value->component_code}'>[+]</a>
                    	<a style='color:#ff0000' href='#' class='subtract-raw-component' data-type='subtract' data-code='{$value->component_code}'>[-]</a>
                    	--
<a style='color:#ff0000' href='#' class='delete-component' data-type='components' data-code='{$value->component_code}'>[x]</a>";
                }

                // Get product& component ids
                $product_obj = \DB::select("SELECT product_id FROM products WHERE product_code = '{$value_1}'");

                // Get mapping
				$mapping_obj_refill = \DB::select("SELECT component_value FROM mapping WHERE product_id = {$product_obj[0]->product_id} AND component_id = {$value->component_id} AND mapping_type = 'REFILL'");

				$test['refill'][$value->component_code][$value_1] = ( empty($mapping_obj_refill) ? null : ( is_null($mapping_obj_refill[0]->component_value) ? null : 
					"" . $mapping_obj_refill[0]->component_value . "" ) );

				$mapping_obj_brand_new = \DB::select("SELECT component_value FROM mapping WHERE product_id = {$product_obj[0]->product_id} AND component_id = {$value->component_id} AND mapping_type = 'BRAND_NEW'");

				$test['brand_new'][$value->component_code][$value_1] = ( empty($mapping_obj_brand_new) ? null : ( is_null($mapping_obj_brand_new[0]->component_value) ? null : 
					"" . $mapping_obj_brand_new[0]->component_value . "" ) );


				$row_data[$value->component_code][$value_1] = "<span class='toggle-refill'>" . $test['refill'][$value->component_code][$value_1] . "</span>"
				 . "<span class='toggle-brand-new'>" . $test['brand_new'][$value->component_code][$value_1] . "</span>";
			}
		}

		// dd($test['refill']['C031'], $test['brand_new']['C031']);

		// Display
		echo "<table bgcolor='#bbb' cellspacing='1' cellpadding='3' id='main-table-ui'>" . $thead;
		
		foreach($row_data AS $key => $value)
		{
			echo "<tr class='main-tr-ui' style='background-color: #fff'>";
			foreach($value AS $key_1 => $value_1)
			{
				echo "<td data-row='{$key}' data-col='{$key_1}' class='touchable {$key_1} " . ( $key == $key_1 ? 'sticky' : '' ) . "'>" . $value_1 . '</td>';
			}
			echo '</tr>';
		}

		return $this;
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
	private function process2()
	{
		echo "<table bgcolor='#bbb' cellspacing='1' cellpadding='3' id='main-table-ui'>";

		echo "<tr><td style='background-color:#fff'>Product Code</td><td style='background-color:#fff'>Product Name</td><td style='background-color:#fff'>Quantity</td><td style='background-color:#fff'>Total # of Purchase</td><td style='background-color:#fff'></td></tr>";

		$product_obj = \DB::select("SELECT product_name, product_code FROM products WHERE type_id = 2 AND is_active = 1");

		foreach($product_obj AS $key => $value)
		{
			$products_obj = \DB::select("SELECT p.product_code, p.product_name, q.quantity
				FROM products AS p 
				INNER JOIN quantity AS q
				ON q.code_id = p.product_code
				WHERE p.type_id = 2 AND p.is_active = 1
				AND p.product_code = '{$value->product_code}'");

			echo "<tr class='main-tr-ui' style='background-color: #fff'>
			<td>
			<a href='#' class='buy-and-sell-button' data-code='{$value->product_code}'>{$products_obj[0]->product_code}</a>
			</td><td>{$products_obj[0]->product_name}</td><td>{$products_obj[0]->quantity}</td>";

			// Get total purchased
			$purchased_obj = \DB::select("SELECT count(order_meta_id) AS total_purchased FROM order_meta WHERE product_code = '{$value->product_code}'");

			echo "<td>{$purchased_obj[0]->total_purchased}</td><td> <a style='color:#ff0000' href='#' class='delete-product' data-type='products' data-code='{$value->product_code}'>[x]</a></td>";

			echo "</tr>";

		}

		echo "</table>";

		return $this;
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
	public function buy_and_sell_index_content($product_code)
	{
		$product_obj = \DB::select("SELECT product_name FROM products WHERE product_code = '{$product_code}'");

		echo "<span style='float:right'><a href='#' id='tracking-content-container-x2-button'>[x]</a></span>";

		$order_meta_obj = \DB::select("SELECT count(*) AS total, app_number FROM order_meta_reference WHERE product_code = '{$product_code}' GROUP BY app_number");

		if( ! empty($order_meta_obj))
		{
			echo "<h3>{$product_obj[0]->product_name}</h3>";
			echo "<table bgcolor='#bbb' cellspacing='1' cellpadding='5'><tr><td style='background-color='#fff'>APP_NUMBER</td><td style='background-color='#fff'>TOTAL</td></tr>";
			
			foreach($order_meta_obj AS $key => $value)
			{
				echo "<tr><td style='background-color: #fff'>{$value->app_number}</td><td style='background-color: #fff'>{$value->total}</td></tr>";
			}

			echo "</table>";
		}
		else
		{
			echo "No data. <br/><br/>";
			ob_end_flush();

			return \Redirect::away('http://192.168.1.100:8080/gui/buy-and-sell');
		}

		echo "<script src='/twb/js/jquery.js'></script><script src='/twb/js/gui.js'></script>";
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
	public function commissionProcess()
	{
		$commission_obj = \DB::select("SELECT * FROM commission ORDER BY created_at DESC");

		if( ! empty($commission_obj))
		{
			echo "<table bgcolor='#bbb' cellspacing='1' cellpadding='3' id='main-table-ui'>";

			echo "<tr>
					<td style='background-color:#fff'>App Number</td>
					<td style='background-color:#fff'>Amount</td>
					<td style='background-color:#fff'>Is Paid?</td>
					
					<td style='background-color:#fff; min-width: 200px'>Agent Name</td>
					<td style='background-color:#fff; min-width: 200px'>Commission Notes</td>
					<td style='background-color:#fff; min-width: 50px'>Actions</td>
				  </tr>";

			foreach( $commission_obj AS $key => $value )
			{					
				echo "<tr  class='main-tr-ui' style='background-color: #fff'>
						<td><a href='#'>{$value->app_number}</a></td>
						<td style='min-width: 100px'>Php {$value->amount}</td>
						<td>". ($value->is_paid == 1 ? 'Yes' : 'No') . "</td>
						
						<td>{$value->agent_name}</td>
						<td>{$value->notes}</td>";

				echo "<td>" . ($value->is_paid == 0 ? 
							"<a href='/gui/commission-paid/1/{$value->commission_id}'>Paid</a>" 
					 : 
							"<a href='/gui/commission-unpaid/0/{$value->commission_id}'>Unpaid</a>" 

					 ) . "</td>";
				
				echo "</tr>";
			}

			echo "</table>";
		}
		else
		{
			echo "No data. <br/><br/>";
			ob_end_flush();

			return \Redirect::away('http://192.168.1.100:8080/gui/');
		}

		echo "<script src='/twb/js/jquery.js'></script><script src='/twb/js/gui.js'></script>";

		return $this;
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
		//Get product details
		$product_obj 	= \DB::select("SELECT * FROM products WHERE product_code = '{$product_code}'");

		// Get quantity 
		$quantity_obj = \DB::select("SELECT quantity FROM quantity WHERE code_id = '{$product_code}'");

		$order_meta_obj = \DB::select("SELECT DISTINCT om.order_id, om.product_name, om.product_code, o.app_number, COUNT(om.order_id) AS total FROM order_meta AS om INNER JOIN orders AS o ON om.order_id = o.order_id WHERE om.product_code = '{$product_code}' 
			GROUP BY om.order_id, om.product_name, om.product_code, o.app_number");


		echo "<h1>{$product_obj[0]->product_name}</h1><b>Remaining Quantity: {$quantity_obj[0]->quantity}</b><br/<br/><br/><table bgcolor='#bbb' cellspacing='2' cellpadding='5'>";

		if($order_meta_obj)
		{
			echo "<tr><td style='background-color: #fff'>APP_NUMBER</td><td style='background-color: #fff'>TOTAL # OF ITEMS</td></tr>";

			foreach($order_meta_obj AS $key => $value)
			{
				echo "<tr><td style='background-color: #fff'><a href ='/gui/detailed/{$value->app_number}/{$product_code}'>{$value->app_number}</a></td><td style='background-color: #fff'>-{$value->total}</td></tr>";
			}
		}
		else
		{
			echo "No data.";
		}
	 */

	public function full($component_code)
	{
		$order_meta_obj = \DB::select("

SELECT * 
FROM
(
	SELECT '-' AS operand, sub.app_number, sub.item_value, sub.mapping_type, sub.total_product, sub.total, p.product_name, sub.item_name, sub.created_at
	FROM products AS p 
	RIGHT JOIN 
	(
		SELECT o.item_value, o.mapping_type, o.app_number, count(o.product_code) AS total_product, sum(o.item_value) AS total, 
		o.product_code,
		o.item_name, r.created_at
		FROM order_meta_reference AS o
		INNER JOIN orders AS r 
		ON o.app_number = r.app_number
		WHERE o.item_code = '{$component_code}' 
		AND o.item_type = 'RAW_MATERIALS'
		GROUP BY o.app_number, o.product_code, o.item_name, o.item_value, o.mapping_type, r.created_at
	) AS sub
	ON sub.product_code = p.product_code

UNION

	SELECT 
	operator AS operand,
	NULL AS app_number, 
	NULL AS item_value, 
	NULL AS mapping_type,
	NULL AS total_product,
	total,
	description AS product_name,
	description as item_name,
	timestamp AS created_at FROM 
	component_raw_trail
	WHERE component_id = '{$component_code}'
)
sub
ORDER BY created_at DESC;
		");
		
		if( ! empty($order_meta_obj))
		{
			// Get component_name
			$component_obj = \DB::select("SELECT component_name FROM components WHERE component_code = '{$component_code}'");

			// Get quantity 
			$quantity_obj = \DB::select("SELECT quantity FROM quantity WHERE code_id = '{$component_code}'");

			echo "<span style='float:right'><a href='#' id='tracking-content-container-x-button'>[x]</a></span>";
			echo "<h3>{$component_obj[0]->component_name}</h3>Remaining Quantity: {$quantity_obj[0]->quantity}<br/<br/><br/><table bgcolor='#bbb' cellspacing='1' cellpadding='5'>";
			echo "<tr><td style='background-color: #fff'>APP_NUMBER</td><td style='background-color: #fff'>PRODUCT_NAME / DESC</td><td style='background-color: #fff'>TYPE</td><td style='background-color: #fff'>MAPPING_VALUE</td><td style='background-color: #fff'>TOTAL_PRODUCT</td><td style='background-color: #fff'>TOTAL</td><td style='background-color: #fff'>CREATED_AT</td></tr>";

			foreach($order_meta_obj AS $key => $value)
			{
				echo "<tr><td style='background-color: #fff'>{$value->app_number}</td>
				<td style='background-color: #fff'>{$value->product_name}</td>
				<td style='background-color: #fff'>{$value->mapping_type}</td>
				<td style='background-color: #fff'>{$value->item_value}</td>
				<td style='background-color: #fff'>{$value->total_product}</td>
				<td style='background-color: #fff'>{$value->operand}{$value->total}</td>
				<td style='background-color: #fff'>{$value->created_at}</td></tr>";
			}
		}
		else
		{
			echo "No data. <br/><br/>";
			ob_end_flush();

			return \Redirect::away('http://192.168.1.100:8080/gui');
		}
		echo "<script src='/twb/js/jquery.js'></script><script src='/twb/js/gui.js'></script>";
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
		$omr_obj = \DB::SELECT("SELECT product_code, item_code, count(item_code) total, mapping_type, item_type, build_type 
			FROM order_meta_reference WHERE app_number = $app_number AND product_code = '$product_code'
			GROUP BY mapping_type, item_code, product_code, item_type, build_type");

		echo "<h1>APP_NUMBER: {$app_number}</h1><table bgcolor='#bbb' cellspacing='2' cellpadding='5'>";
		echo "<tr>

		<td style='background-color: #fff'>ITEM</td>
		<td style='background-color: #fff'>TOTAL</td>
		<td style='background-color: #fff'>MAPPING VALUE</td>
		<td style='background-color: #fff'>TOTAL DEDUCTED VALUE</td>
		<td style='background-color: #fff'>MAPPING_TYPE</td>
		<td style='background-color: #fff'>ITEM_TYPE</td>
		<td style='background-color: #fff'>BUILD_TYPE</td></tr>";
		foreach($omr_obj AS $key => $value)
		{
			// Get product details
			$product_obj = \DB::select("SELECT * FROM products WHERE product_code = '{$value->product_code}'");

			//Normalize counts
			$obj = \DB::select( strtoupper(substr($value->item_code, 0, 1)) == 'P' ? 
				"SELECT * FROM products WHERE product_code = '{$value->item_code}'" : "SELECT * FROM components WHERE component_code = '{$value->item_code}'" );


			if(strtoupper(substr($value->item_code, 0, 1)) == 'P')
			{ 
				$mapping_value = 1;
			}
			else
			{
				$tmp_obj = \DB::select("SELECT component_value FROM mapping WHERE product_id = {$product_obj[0]->product_id} 
					AND mapping_type = '{$value->mapping_type}' AND component_id = '{$obj[0]->component_id}'");
				$mapping_value = $tmp_obj[0]->component_value;
			}

			echo "<tr>
			<td style='background-color: #fff'>" . ( strtoupper(substr($value->item_code, 0, 1)) == 'P' ? $obj[0]->product_name : $obj[0]->component_name ) . "</td>
			<td style='background-color: #fff'>{$value->total}</td>
			<td style='background-color: #fff'>{$mapping_value}</td>
			<td style='background-color: #fff'>-" . ($mapping_value * $value->total) . "</td>
			<td style='background-color: #fff'>{$value->mapping_type}</td>
			<td style='background-color: #fff'>{$value->item_type}</td>
			<td style='background-color: #fff'>{$value->build_type}</td>
			</tr>";
		}
	 */
	public function detailed($app_number, $product_code)
	{
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
	public function htmlHeaders()
	{
		echo "<!DOCTYPE html><meta charset='UTF-8'><html><head><title>Firetron Safety System | GUI</title><style>
		#mapping-edit-container, #edit-mapping-container { box-shadow: 1px 1px 10px #ddd; }
		h3 { margin: 0px; margin-bottom: 10px; border-bottom: 1px solid #ccc }
		tr.main-tr-ui td, tr.main-tr-ui { background-color: #fff }
		tr.main-tr-ui:hover td { background-color: #F2EDE5  !important }
		.sticky {  }
		.shadow { box-shadow: 1px 1px 10px #ccc }
		select { font-size: 10px }
		</style></head><body style='font-family: Arial; font-size: 8pt; margin: 0px'>";

		return $this;
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
	public function htmlFooter()
	{
		echo "
		<div id='overlay' style='display: none; background-color: rgba(255,255,255,0.9); height: 100%; widht: 100%; width: 100%; position: fixed;'></div>

		<div 
		id='edit-mapping-container' 
		style='min-height: 500;padding: 10px;height: 200px;width: 650px;border: 1px solid #ccc;background-color: #fff;float: left;position: fixed;left: 30%;top: 15%;display: none' 
		class='shadow'>
			<span style='float:right'><a href='#' id='edit-mapping-container-button'>[x]</a></span>
			<h3>Edit Mapping</h3>
			<label style='min-width:160px; float:left'>Choose mapping type</label>
			<select id='mapping-type-dropdown' data-product-code='test'><option value='BRAND_NEW'>Brand New</option><option value='REFILL'>Refill</option><option value='REPAINT'>Repaint</option></select><br/>
			<input type='hidden' id='data-catcher' /><br/>
			<label style='min-width:160px; float:left'>&nbsp;</label><a href='#' id='edit-mapping-proceed-button'>Proceed</a>
		</div>

		<div
		id='mapping-edit-container'
		style='min-height: 500;padding: 10px;width: 650px;border: 1px solid #ccc;background-color: #fff;float: left;position: fixed;left: 30%;top: 15%;display: none'
		class='shadow'>
		</div>

		<div 
		id='add-mapping-container' 
		style='min-height: 500;padding: 10px;width: 650px;border: 1px solid #ccc;background-color: #fff;float: left;position: fixed;left: 30%;top: 15%;display: none'
		class='shadow'>
		</div>

		<div 
		id='remove-mapping-container' 
		style='min-height: 1000;padding: 10px;width: 650px;border: 1px solid #ccc;background-color: #fff;float: left;position: fixed;left: 30%;top: 15%;display: none'
		class='shadow'>
		</div>

		<div 
		class='create-component-product-container tracking-content-container tracking-bns-content-container delete-component-product-container component-raw-container shadow' 
		style='min-height: 1000;padding: 10px;width: 650px; height:450px;overflow-y:scroll;border: 1px solid #ccc;background-color: 
		#fff;float: left;position: fixed;left: 30%;top: 15%;display: none'>
		</div>

		<script src='/twb/js/jquery.js'></script><script src='/twb/js/gui.js'></script>

		</body></html>";
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
	public function editProductMapping($mapping_type, $product_code)
	{
		$mapping_obj = \DB::select("SELECT * FROM mapping WHERE product_id = (SELECT product_id FROM products WHERE product_code = '$product_code') AND mapping_type = '$mapping_type'");
		$product_obj = \DB::select("SELECT product_name FROM products WHERE product_code = '{$product_code}'");

		echo "
		<span style='float:right'><a href='#' id='mapping-edit-container-button'>[x]</a></span>
		<form action='/mapping/edit/save' method='POST' id='edit-mapping-form-id'><h3>{$product_obj[0]->product_name}</h3>
		Modify quantity below:<br/><br/>
		<table bgcolor='#bbb' cellspacing='1' cellpadding='5'>
		<tr><td style='background-color: #fff'>COMPONENT_NAME</td><td style='background-color: #fff'>MAPPING_VALUE</td></tr>";
		foreach($mapping_obj AS $key => $value)
		{
			$label = \DB::select("SELECT component_name FROM components WHERE component_id = $value->component_id");
			echo "<tr><td style='background-color: #fff'><label>{$label[0]->component_name}</label></td><td style='background-color: #fff'>
			<input type='text' name='{$value->bnm_id}' value='{$value->component_value}' /></td></tr>";
		}
		echo "<tr><td style='background-color: #fff'><label>&nbsp;</label></td><td style='background-color: #fff'>
		<input type='button' id='edit-mapping-button' value='Save' onClick='submitEditMapping()' />
		</td></tr></table></form>";
		echo "<script src='/twb/js/jquery.js'></script><script src='/twb/js/gui.js'></script>";
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
	public function addProductMapping($product_code)
	{
		$components_obj = \DB::select("SELECT component_id, component_name FROM components");
		$product_obj = \DB::select("SELECT product_id, product_name FROM products WHERE product_code = '{$product_code}'");
		$this->htmlHeaders();
		echo "
		<span style='float:right'><a href='#' id='add-mapping-container-x-button'>[x]</a></span>
		<form action='/mapping/add/save' method='POST' id='add-mapping-form-id'><h3>{$product_obj[0]->product_name}</h3>
		<input type='hidden' name='product_id' value='{$product_obj[0]->product_id}' />
		<label style='min-width:160px; float:left'>Select Mapping Type</label><select id='add-mapping-type-dropdown' name='mapping_type'><option value='BRAND_NEW'>Brand New</option><option value='REFILL'>Refill</option><option value='REPAINT'>Repaint</option></select>
		<br/><br/>
		<label style='min-width:160px; float:left'>Select Component</label><select id='add-mapping-component-dropdown' name='component_id'>";
		foreach($components_obj AS $key => $value) { echo "<option value={$value->component_id}>{$value->component_name}</option>"; }
		echo "</select>
		<br/>
		<label style='min-width:160px; float:left'>Add Value</label><input type='text' name='component_value' value='' />
		<br/></br/>
		<label style='min-width:160px; float:left'>&nbsp;</label>
		<input type='button' id='add-mapping-save-button' value='Save' onClick='submitAddMapping()' />
		</form>";
		echo $this->htmlFooter();
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
	public function removeProductMapping($product_code)
	{
		$products_obj = \DB::select("
		SELECT m.*, c.component_name FROM mapping AS m
		LEFT JOIN components AS c
		ON c.component_id = m.component_id
		WHERE m.product_id = (SELECT product_id FROM products WHERE product_code = '{$product_code}')
		");
		$product_obj = \DB::select("SELECT product_id, product_name FROM products WHERE product_code = '{$product_code}'");
		echo "
		<span style='float:right'><a href='#' id='remove-mapping-container-x-button'>[x]</a></span>
		<form action='/mapping/remove/save' method='POST' id='remove-mapping-form-id'>
		<h3>{$product_obj[0]->product_name}</h3>
		Check components to remove:<br/><br/>
		<table bgcolor='#bbb' cellspacing='1' cellpadding='5'>";
		echo "<tr><td style='background-color: #fff'></td><td style='background-color: #fff'>COMPONENT_NAME</td><td style='background-color: #fff'>MAPPING_TYPE</td></tr>
		<input type='hidden' name='product_code' value='{$product_code}'/>";
		foreach($products_obj AS $key => $value)
		{
			echo "<tr><td style='background-color: #fff'><input type='checkbox' name='component[]' value='{$value->bnm_id}'></td>
			<td style='background-color: #fff'>{$value->component_name}</td><td style='background-color: #fff'>{$value->mapping_type}</td></tr>";
		}
		echo "<tr><td style='background-color: #fff'></td>
			 <td style='background-color: #fff'></td>
			 <td style='background-color: #fff'>
			 <input type='button' id='remove-mapping-save-button' value='Save' onClick='submitRemoveMapping()' /></td></tr></table></form>";
		echo "<script src='/twb/js/jquery.js'></script><script src='/twb/js/gui.js'></script>";
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
	public function createComponent()
	{
		echo "<span style='float:right'><a href='#' id='create-product-component-container-x-button'>[x]</a></span>";
		echo "
		<form action='/components/create-save' method='POST' id='create-component-container'>
		<h3>Create Component</h3>
		<label style='min-width:160px; float:left'>Select Category</label><select name='component_category_id'>";
		foreach(\DB::select("SELECT category_id, category_name FROM component_category") AS $key => $value) 
		{ 
			echo "<option value={$value->category_id}>{$value->category_name}</option>"; 
		}
		echo "</select><br style='clear:both' />
		<label style='min-width:160px; float:left'>Component Name</label><input type='text' name='component_name' value='' /><br/>
		<label style='min-width:160px; float:left'>Add Quantity</label><input type='text' name='component_quantity' value='' /><br/>
		<label style='min-width:160px; float:left'>&nbsp;</label><input type='button' value='Create' onClick='saveCreatedComponent()' />
		<input type='hidden' value='1' name='added_by_id' />
		</form>";
		echo "<script src='/twb/js/jquery.js'></script><script src='/twb/js/gui.js'></script>";
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
	public function createProduct()
	{
		echo "<span style='float:right'><a href='#' id='create-product-component-container-x-button'>[x]</a></span>
		<form action='/products/create-save' method='POST' id='create-component-container'>
		<h3>Create Product</h3>
		<label style='min-width:160px; float:left'>Product Category</label><select name='category_id'>";
        foreach(\DB::select("SELECT type_id, type_name FROM product_type") AS $key => $value){ echo "<option value={$value->type_id}>{$value->type_name}</option>"; }
        echo "</select><br style='clear:both' />";

        echo "<label style='min-width:160px; float:left'>Product Type</label><select name='type_id'>";
        foreach(\DB::select("SELECT category_id, category_name FROM product_category") AS $key => $value){ echo "<option value={$value->category_id}>{$value->category_name}</option>"; }
        echo "</select><br style='clear:both' />
        <label style='min-width:160px; float:left'>Product Name</label><input type='text' name='product_name' value='' /><br style='clear:both' />
        <label style='min-width:160px; float:left'>Is Brand New?</label><input name='is_brand_new' type='checkbox' value='1'><br style='clear:both' />
		<label style='min-width:160px; float:left'>Is Refill?</label><input name='is_refill' type='checkbox' value='1'><br style='clear:both'  />
		<label style='min-width:160px; float:left'>Is Repaint?</label><input name='is_repaint' type='checkbox' value='1'><br style='clear:both' />
		<label style='min-width:160px; float:left'>Add Quantity</label><input type='text' name='product_quantity' value='' /><br style='clear:both' />
		<label style='min-width:160px; float:left'>&nbsp;</label><input type='button' value='Create' onClick='saveCreatedProduct()'/>
		<input type='hidden' value='1' name='added_by_id' />
		</form>
		<script src='/twb/js/jquery.js'></script><script src='/twb/js/gui.js'></script>";
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
	public function saveEditMapping(Request $request)
	{
		foreach($request->all() AS $key => $value)
		{
			\DB::select("UPDATE mapping SET component_value = $value WHERE bnm_id = $key");
		}

		return \Redirect::away('http://192.168.1.100:8080/gui');
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
	public function saveAddMapping(Request $request)
	{
		// Validate non-existing mapping
		$validate = \App\Models\mapping::where('component_id', '=', $request->component_id)
					->where('product_id', '=', $request->product_id)
					->where('mapping_type', '=', $request->mapping_type)
					->exists();

		// dd($request->all(), $validate);

		if( ! $validate)
		{
			$request->request->add([
				'mapping_type' 	=> $request->mapping_type,
				'product_id'	=> $request->product_id,
				'component_id'	=> $request->component_id,
				'added_by_id'	=> 1
			]);

			\App\Models\mapping::create($request->except('_token'));

			echo "Component successfully added! <br/><br/>";
			ob_end_flush();

			return \Redirect::away('http://192.168.1.100:8080/gui');
		}
		else
		{
			echo "Mapping already exist! <br/><br/>";
			ob_end_flush();

			return \Redirect::away('http://192.168.1.100:8080/gui');
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
	public function saveRemoveMapping(Request $request)
	{
		if(!empty($request->component))
		{
			foreach($request->component AS $key => $value)
			{
				\DB::select("DELETE FROM mapping WHERE bnm_id = {$value}");
			}

			echo "Mapping successfullly removed! <br/><br/>";
			ob_end_flush();

			return \Redirect::away('http://192.168.1.100:8080/gui');			
		}
		else
		{
			echo "Please select component to remove! <br/><br/>";
			ob_end_flush();

			return \Redirect::away('http://192.168.1.100:8080/gui');
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
	public function saveNewComponent(Request $request)
	{
		if(!empty($request->component_name))
		{
			$data           	= \App\Models\components::create($request->except('_token', 'quantity'));
		    $component_code   	= 'C' . str_pad($data->id, 3, '0', STR_PAD_LEFT);
		    $component_obj    	= \App\Models\components::where('component_id', '=', $data->id)->update([
		        'component_code' => $component_code
		    ]);

		    \App\Models\quantity::createQuantity($component_code, $request->component_quantity);

			echo "New component successfully created! <br/><br/>";
			ob_end_flush();

			return \Redirect::away('http://192.168.1.100:8080/gui');	
		}
		else
		{
			echo "Data must not be empty! <br/><br/>";
			ob_end_flush();

			return \Redirect::away('http://192.168.1.100:8080/gui');
		}
	}

	public function saveNewProduct(Request $request)
	{
		if(!empty($request->product_name))
		{
			$data           	= \App\Models\products::create($request->except('_token'));
		    $product_code   	= 'P' . str_pad($data->id, 3, '0', STR_PAD_LEFT);
			$product_obj    	= \App\Models\products::where('product_id', '=', $data->id)->update([
                'product_code' => $product_code
            ]);

		    \App\Models\product_type_meta::createMeta($request, $data->id);

		    \App\Models\quantity::createQuantity($product_code, $request->product_quantity);

			echo "New product successfully created! <br/><br/>";
			ob_end_flush();

			return \Redirect::away('http://192.168.1.100:8080/gui');	
		}
		else
		{
			echo "Data must not be empty! <br/><br/>";
			ob_end_flush();

			return \Redirect::away('http://192.168.1.100:8080/gui');
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
	public function markCommission($value, $commission_id)
	{
		\DB::select("UPDATE commission SET is_paid = $value WHERE commission_id = $commission_id");

		return \Redirect::away('http://192.168.1.100:8080/gui/commission');
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
	public function initialDelete($type, $code)
	{
		echo "
		<span style='float:right'><a href='#' id='delete-product-component-container-x-button'>[x]</a></span>
		<h3>Delete {$type}</h3>
		<form action='/delete/{$type}/{$code}' method='POST' id='delete-form-id'>";
		if($type == 'components')
		{
			$component_obj 	= \DB::select("SELECT component_name FROM components WHERE component_code = '{$code}'");
			$name 			= $component_obj[0]->component_name;
		}
		else
		{
			$product_obj  	= \DB::select("SELECT product_name FROM products WHERE product_code = '{$code}'");
			$name 			= $product_obj[0]->product_name;
		}
		echo "
		Deleting {$name} will cascade its data <br/> Resulting to loss its relationship from all tables: <br/> MAPPING, HISTORY & ORDER<br/><br/>
		<input type='checkbox' id='delete_verification' style='float: left'><label>Are you sure you want to delete <b>{$name}</b>?</label>
		<br style='clear: both'/> <br/>
		<input type='button' id='delete_component_button' value='Delete' onClick='finalDelete()'>
		<input type='hidden' name='type' value='{$type}' />
		<input type='hidden' name='code' value='{$code}' />
		</form>";
		echo "<script src='/twb/js/jquery.js'></script><script src='/twb/js/gui.js'></script>";
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
	public function finalDelete(Request $request)
	{
		if($request->type == 'products')
		{
			$product_obj 	= \DB::select("SELECT product_id, product_name FROM products WHERE product_code = '{$request->code}'");
			$product_id 	= $product_obj[0]->product_id;
			$name 			= $product_obj[0]->product_name;

			\DB::select("DELETE FROM mapping WHERE product_id = {$product_id}");
			\DB::select("DELETE FROM products WHERE product_code = '{$request->code}'");
			\DB::select("DELETE FROM quantity WHERE code_id = '{$request->code}'");
		}
		else
		{
			$component_obj 	= \DB::select("SELECT component_id, component_name FROM components WHERE component_code = '{$request->code}'");
			$component_id 	= $component_obj[0]->component_id;
			$name 			= $component_obj[0]->component_name;

			\DB::select("DELETE FROM mapping WHERE component_id = {$component_id}");
			\DB::select("DELETE FROM components WHERE component_code = '{$request->code}'");
			\DB::select("DELETE FROM quantity WHERE code_id = '{$request->code}'");
		}

		echo "{$name} successfully deleted! <br/><br/>";
		ob_end_flush();

		return \Redirect::away('http://192.168.1.100:8080/gui');	
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
	public function modifyComponentQuantity($type, $code)
	{
		$component_obj 	= \DB::select("SELECT component_id, component_name FROM components WHERE component_code = '{$code}'");
		echo "
		<span style='float:right'><a href='#' id='remove-mapping-container-x-button'>[x]</a></span>
		<form action='/components/quantity' method='POST' id='component-quantity-modify-form-id'>
		<h3>{$component_obj[0]->component_name}</h3>
		Check components to remove:<br/><br/>
		<table bgcolor='#bbb' cellspacing='1' cellpadding='5'>";
		echo "<tr><td style='background-color: #fff'>OPERATOR</td><td style='background-color: #fff'>QUANTITY</td><td style='background-color: #fff'>DESC</td><td style='background-color: #fff'></td></tr>
		";
	
		echo "<tr><td style='background-color: #fff'>{$type}</td>
			 <td style='background-color: #fff'><input type='text' name='component-quantity-value' id='component-quantity-value' /></td>
			 <td style='background-color: #fff'><input type='text' name='component-quantity-desc' id='component-quantity-desc' /></td>
			 <td style='background-color: #fff'>
			 <input type='button' id='component-quantity-modify-save-button' value='Save' onClick='saveComponentQuantityModify()' /></td></tr></table>
			<input type='hidden' name='type' value='{$type}' />
			<input type='hidden' name='code' value='{$code}' />
			</form>";
		echo "<script src='/twb/js/jquery.js'></script><script src='/twb/js/gui.js'></script>";	
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
	public function modifyComponentQuantitySave(Request $request)
	{
		// Insert to raw trail table
		$desc 		= $request->{'component-quantity-desc'};
		$total 		= $request->{'component-quantity-value'};
		$operator 	= (strtoupper($request->type) == 'ADD' ? '+' : '-');
		$quantity_obj 		= \DB::select("SELECT quantity FROM quantity WHERE code_id = '{$request->code}'");
		$current_quantity 	= $quantity_obj[0]->quantity;

		\DB::select("INSERT into component_raw_trail (component_id, description, total, operator) VALUES ('{$request->code}', '{$desc}', '{$total}', '{$operator}')");

		// Update quantity table
		\DB::select("UPDATE quantity SET quantity = ({$current_quantity} {$operator} {$total}) WHERE code_id = '{$request->code}'");		


		ob_end_flush();

		return \Redirect::away('http://192.168.1.100:8080/gui');	
	}
}
