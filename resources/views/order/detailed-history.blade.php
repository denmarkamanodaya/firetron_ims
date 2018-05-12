@extends('layouts.app')

@section('header')
	<div class="col-lg-12">
		<h1 class="page-header">
		    Detailed Order History<small>Page</small>
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

		    <h2>{{ $product_name }}</h2>
		    <br/>

		    	<div class="table-responsive">
		    		<table id="data_table" class="table table-bordered table-hover">
						<thead>
                            <tr>
                                <th>item_name</th>
                                <th>item_value</th>
                                <th>service_type</th>
                            </tr>
                        </thead>
                        <tbody>
						@foreach ( $order_meta_reference_obj as $key => $value )
							<tr>
								<td>
								@if( $value->item_type == 'STOCK' )
									{!! link_to_route('order.super-detailed-history', $value->item_name, [$value->item_code, 'STOCK']) !!}
								@else
									{!! link_to_route('order.super-detailed-history', $value->item_name, [$value->item_code, 'RAW']) !!}
								@endif
								</td>
								<td>{{ $value->item_value }}</td>
								<td>{{ $value->item_type }}</td>
							</tr>
						@endforeach

					</table>
				</div>
		    
		    </div>
		</div>
	</div>

@endsection