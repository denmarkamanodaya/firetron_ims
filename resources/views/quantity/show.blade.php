@extends('layouts.app')

@section('header')
	<div class="col-lg-12">
		<h1 class="page-header">
		    Quantity Mapping <small>Page</small>
		</h1>
	</div>
@endsection


@section('content')

	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Product & Components </h3>
		    </div>

		    <div class="panel-body">

		    	<div class="table-responsive">
		    		<table id="data_table" class="table table-bordered table-hover">
						<thead>
                            <tr>
                            	<th>item_name</th>
                                <th>quantity</th>
                            </tr>
                        </thead>
                        <tbody>
						@foreach ( $quantity_obj as $key => $value )
							<tr>
								@if( $is_raw )
									<td>{!! link_to_route('order.super-detailed-history', $value->item_name, [$value->code_id, 'RAW']) !!}</td>
								@else
									<td>{!! link_to_route('order.super-detailed-history', $value->item_name, [$value->item_code, 'STOCK']) !!}</td>
								@endif

								<td>{{ $value->quantity }}</td>
							</tr>
						@endforeach

					</table>
				</div>
		    
		    </div>
		</div>
	</div>

@endsection