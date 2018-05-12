@extends('layouts.app')

@section('header')
	<div class="col-lg-12">
		<h1 class="page-header">
		    Order History <small>Page</small>
		</h1>
	</div>
@endsection


@section('content')

	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Order History </h3>
		    </div>

		    <div class="panel-body">

		    	<div class="table-responsive">
		    		<table id="data_table_order_history" class="table table-bordered table-hover">
						<thead>
                            <tr>
                                <th>app_number</th>
                                <th>client_name</th>
                                <th>sales_invoice</th>
                                <th>created_at</th>
                            </tr>
                        </thead>
                        <tbody>
						@foreach ( $order_history as $key => $value )
							<tr>
								<td>{!! link_to_route('order.single-history', $value->app_number, [$value->app_number]) !!}</td>
								<td>{!! app('App\Http\Controllers\Helper\FunctionsController')->getClientNameByAppNumber($value->app_number) !!}</td>
								<td>{!! app('App\Http\Controllers\Helper\FunctionsController')->getSINumberByAppNumber($value->app_number) !!}</td>
								<td>{{ $value->created_at }}</td>
							</tr>
						@endforeach

					</table>
				</div>
		    
		    </div>
		</div>
	</div>

@endsection