@extends('layouts.app')

@section('header')
	<div class="col-lg-12">
		<h1 class="page-header">
		    Super Detailed Order History<small>Page</small>
		</h1>
	</div>
@endsection


@section('content')

	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Detailed History </h3>
		    </div>

		    <div class="panel-body">

		    <h2>{{ $item_name }}</h2>
		    <h3>Current Quantity: {{ $item_quantity }}</h3>
		    <br/>

		    	<div class="table-responsive">
		    		<table id="data_table_inventory_level" class="table table-bordered table-hover">
						<thead>
                            <tr>
                            	<th>total_count</th>
                            	<th>item_value</th>
                                <th>total_value</th>
                                <th>app_number</th>
                                <th>client_name</th>
                                <th>product_name</th>
                                <th>created_at</th>
                            </tr>
                        </thead>
                        <tbody>
						@foreach ( $super_detailed_obj as $key => $value )
							<tr>
								<td>{{ $value->total_count }}</td>
								<td>{{ $value->item_value }}</td>
                                <td>{{ $value->total_value }}</td>
								<td>{{ $value->app_number }}</td>
								<td>{!! app('App\Http\Controllers\Helper\FunctionsController')->getClientNameByAppNumber($value->app_number) !!}</td>
								<td>{{ $value->product_name }}</td>
								<td>{{ $value->created_at }}</td>
							</tr>
						@endforeach

					</table>
				</div>
		    
		    </div>
		</div>
	</div>

@endsection