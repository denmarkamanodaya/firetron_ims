@extends('layouts.app')

@section('header')
	<div class="col-lg-12">
		<h1 class="page-header">
		    Single Order History<small>Page</small>
		</h1>
	</div>
@endsection


@section('content')

	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Single History </h3>
		    </div>

		    <div class="panel-body">

		    	<div class="table-responsive">
		    		<table id="data_table" class="table table-bordered table-hover">
						<thead>
                            <tr>
                            	<th>item_count</th>
                                <th>item_name</th>
                            </tr>
                        </thead>
                        <tbody>
						@foreach ( $order_meta_obj as $key => $value )
							<tr>
								<td>{{ $value->item_total }}</td>
								<td>{!! link_to_route('order.detailed-history', $value->product_name, ['order_id' => $value->order_id, 'product_id' => $value->product_id] ) !!}</td>
							</tr>
						@endforeach

					</table>
				</div>
		    
		    </div>
		</div>
	</div>

@endsection