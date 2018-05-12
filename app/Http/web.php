<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


	Route::get('/', function () 
	{
	    if( ! is_null(Session::get('group_user')) )
	    {
	    	return view('home');
	    }
	    else
	    {
	    	return redirect('/logout');
	    }
	});


	Route::get('/login', ['uses' => 'Auth\LoginController2@index',		'as' => 'login.index'] );
	Route::post('/login', ['uses' => 'Auth\LoginController2@auth',		'as' => 'login.auth'] );
	Route::get('/logout', ['uses' => 'Auth\LoginController2@logout',	'as' => 'login.logout'] );



	// PRODUCT
	// Route::get('/x-products/create/',				['uses' => 'Core\ProductsController@create', 	'as' => 'products.create']);
	// Route::post('/x-products/create',				['uses' => 'Core\ProductsController@save', 		'as' => 'products.save']);
	Route::get('/products/view/mapping',		['uses' => 'Core\ProductsController@mapping',	'as' => 'products.mapping']);
	Route::get('/products/build',				['uses' => 'Core\ProductsController@show_build','as' => 'products.show-build']);
	Route::get('/products/build-process/{service_type}/{product_code}',	['uses' => 'Core\ProductsController@build',		'as' => 'products.build']); //mimic product create from components but with return pop message

	// CREATE PRODUCT FROM COMPONENTS
	Route::get('/product/create/{service_type}/{product_code}',		['uses' => 'Core\ProductsController@createProductFromMapping', 'as' => 'product.create']);

	// PRODUCT CHECKER
	Route::get('/check/{product_code}/{quantity}',['uses' => 'Core\ProductCheckerController@check', 'as' => 'product.check']);

	// COMPONENTS
	// Route::get('/x-components/create',			['uses' => 'Core\ComponentsController@create',	'as' => 'components.create']);
	// Route::post('/x-components/create',			['uses' => 'Core\ComponentsController@save',	'as' => 'components.save']);

	// Add value to components --- For components purchasing
	Route::post('/components/quantity/add/', 	['uses' => 'Core\ComponentsController@quantityAdd', 'as' => 'components.quantity-add']);

	// RETURN
	Route::get('/return',						['uses' => 'Core\ReturnController@index', 		'as' => 'return.index']);
	Route::post('/return',						['uses' => 'Core\ReturnController@process',		'as' => 'return.process']);
	Route::get('/cancellation/',				['uses' => 'Core\ReturnController@cancellationList', 'as' => 'cancellation.list']);

	// QUANTITY -- Used in Processmaker when purchasing 
	// Route::get('/products/quantity/less/{quantity}/{service_type}/{product_code}/{order_id}',	'Core\QuantityController@lessStock');
	Route::get('/quantity/mapping',				['uses' => 'Core\QuantityController@showMapping', 		'as' => 'quantity.show']);
	Route::get('/quantity/mapping/stock',		['uses' => 'Core\QuantityController@showMappingStock', 	'as' => 'quantity.show.stock']);
	Route::get('/quantity/mapping/raw',			['uses' => 'Core\QuantityController@showMappingRaw', 	'as' => 'quantity.show.raw']);

	// AGENT & COMMISSION
	Route::get('/agent/create',					['uses' => 'Core\CommissionsController@create',	'as' => 'agent.create']);
	Route::post('/agent/create',				['uses' => 'Core\CommissionsController@save',	'as' => 'agent.save']);
	Route::get('/commission/show',				['uses' => 'Core\CommissionsController@show',	'as' => 'commission.show']);
	Route::get('/commission/pending',			['uses' => 'Core\CommissionsController@pending','as' => 'commission.pending']);
	Route::post('/commission/pending',			['uses' => 'Core\CommissionsController@savePending','as' => 'commission.save-pending']);
	Route::post('/commission/add/',				['uses' => 'Core\CommissionsController@commissionAdd',	'as' => 'commission.add']);
	Route::get('/commission/paid/{app_uid}',	['uses' => 'Core\CommissionsController@commissionPaidTagging',	'as' => 'commission.paid']);
	Route::get('/commission/deactivate/{app_uid}',['uses' => 'Core\CommissionsController@commissionDeactivateTagging',	'as' => 'commission.deactivate']);


	// NEW MAPPING
	Route::get('/mapping/edit/{mapping_type}/{product_code}',	['uses' => 'Core\ConsolidatedGuiController@editProductMapping', 'as' => 'mapping.edit.product']);	
	Route::get('/mapping/add/{product_code}',					['uses' => 'Core\ConsolidatedGuiController@addProductMapping', 'as' => 'mapping.add.product']);	
	Route::get('/mapping/remove/{product_code}',				['uses' => 'Core\ConsolidatedGuiController@removeProductMapping', 'as' => 'mapping.remove.product']);	
	Route::post('/mapping/edit/save',							['uses' => 'Core\ConsolidatedGuiController@saveEditMapping', 'as' => 'mapping.save.edit']);	
	Route::post('/mapping/add/save',							['uses' => 'Core\ConsolidatedGuiController@saveAddMapping', 'as' => 'mapping.save.add']);
	Route::post('/mapping/remove/save',							['uses' => 'Core\ConsolidatedGuiController@saveRemoveMapping', 'as' => 'mapping.save.remove']);
	Route::get('/components/create',			['uses' => 'Core\ConsolidatedGuiController@createComponent', 'as' => 'components.create']);
	Route::post('/components/create-save',		['uses' => 'Core\ConsolidatedGuiController@saveNewComponent', 'as' => 'components.save']);
	Route::get('/products/create',				['uses' => 'Core\ConsolidatedGuiController@createProduct', 'as' => 'products.create']);
	Route::post('/products/create-save',		['uses' => 'Core\ConsolidatedGuiController@saveNewProduct', 'as' => 'products.save']);
	Route::get('/delete/{type}/{code}',			['uses' => 'Core\ConsolidatedGuiController@initialDelete', 'as' => 'initial.delete']);
	Route::post('/delete/{type}/{code}',		['uses' => 'Core\ConsolidatedGuiController@finalDelete', 'as' => 'final.delete']);
	// MAPPING
	Route::get('/mapping/{service_type}/{product_code}',		'Core\ProductMappingController@show');
	Route::get('/mapping/create',				['uses' => 'Core\ProductMappingController@create', 'as' => 'mapping.create']);
	Route::post('/mapping/create',				['uses' => 'Core\ProductMappingController@save', 'as' => 'mapping.save']);





	// QUANTITY MONITORING
	Route::get('/monitoring/',					['uses' => 'Core\MonitoringController@process', 'as' => 'monitoring.process']);



	// CONSOLIDATED GUI
	#Route::get('/gui/full/{type}/{product_id}/{component_id}/',				['uses' => 'Core\ConsolidatedGuiController@full', 'as' => 'gui.full']);
	#Route::get('/gui/detailed/{app_number}/{product_code}',					['uses' => 'Core\ConsolidatedGuiController@detailed', 'as' => 'gui.detailed']);
	Route::get('/gui/full/{component_id}/',									['uses' => 'Core\ConsolidatedGuiController@full', 'as' => 'gui.full.components']);
	Route::get('/gui/',														['uses' => 'Core\ConsolidatedGuiController@index', 'as' => 'gui.full']);
	Route::get('/gui/buy-and-sell/{product_code}',							['uses' => 'Core\ConsolidatedGuiController@buy_and_sell_index_content', 'as' => 'gui.buy-and-sell.content']);
	Route::get('/gui/buy-and-sell',											['uses' => 'Core\ConsolidatedGuiController@buy_and_sell_index', 'as' => 'gui.buy-and-sell']);
	Route::get('/gui/commission',											['uses' => 'Core\ConsolidatedGuiController@commission_index', 'as' => 'gui.commission']);
	Route::get('/gui/commission-paid/{value}/{commission_id}',					['uses' => 'Core\ConsolidatedGuiController@markCommission', 'as' => 'gui.commission-paid']);
	Route::get('/gui/commission-unpaid/{value}/{commission_id}',					['uses' => 'Core\ConsolidatedGuiController@markCommission', 'as' => 'gui.commission-unpaid']);




	// ORDER
	Route::get('/order/{app_number}/{service_type}/{product_code}/{quantity}',	['uses' => 'Core\OrderController@process', 					'as' => 'order.process']);
	Route::get('/order/show-single-history/{app_number}',						['uses' => 'Core\OrderController@showSingleHistory',		'as' => 'order.single-history']);
	Route::get('/order/show-detailed-history/{app_number}/{product_id}',		['uses' => 'Core\OrderController@showDetailedHistory',		'as' => 'order.detailed-history']);
	Route::get('/order/show-history',											['uses' => 'Core\OrderController@showHistory',				'as' => 'order.history']);
	Route::get('/order/show-super-detailed-history/{item_code}/{type}',			['uses' => 'Core\OrderController@showSuperDetailedHistory',	'as' => 'order.super-detailed-history']);


	// Auth::routes();

	// Route::get('/home', 'HomeController@index');

// routes
// app.blade.php
// ConsolidatedGUIController

