@extends('layouts.app')

@section('header')
	<div class="col-lg-12">
		<h1 class="page-header">
		    Products Mapping <small>Page</small>
		</h1>
	</div>
@endsection


@section('content')

	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Full Mapping Table </h3>
		    </div>

		    <div class="panel-body">

		    	<div class="table-responsive">
		    		<table id="data_table" class="table table-bordered table-hover">
						<thead>
                            <tr>
                                <th>mapping_type</th>
                                <th>product_code</th>
                                <th>product_name</th>
                                <th>component_name</th>
                                <th>component_value</th>
                                <th>is_active</th>
                            </tr>
                        </thead>
                        <tbody>
						@foreach ( $product_mapping_data as $key => $value )
							<tr>
								<td>{{ $value->mapping_type }}</td>
								<td>{{ $value->product_code }}</td>
								<td>{{ $value->product_name }}</td>
								<td>{{ $value->component_name }}</td>
								<td>{{ $value->component_value }}</td>
								<td>{{ $value->is_active }}</td>
							</tr>
						@endforeach

					</table>
				</div>
		    
		    </div>
		</div>
	</div>

@endsection