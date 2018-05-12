@extends('layouts.app')

@section('header')
	<div class="col-lg-12">
		<h1 class="page-header">
		    Monitoring <small>Page</small>
		</h1>
	</div>
@endsection


@section('content')

	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Product & Component Monitoring </h3>
		    </div>

		    <div class="panel-body">

		    	<div class="table-responsive">
		    		<table id="data_table" class="table table-bordered table-hover">
						<thead>
                            <tr>
                                <th>type</th>
                                <th>item_name</th>
                                <th>quantity</th>
                            </tr>
                        </thead>
                        <tbody>
						@foreach ( $monitoring_obj as $key => $value )
							<tr>
								<td>{{ $value->type }}</td>
								<td>{{ $value->item_name }}</td>
								<td>{{ $value->quantity }}</td>
							</tr>
						@endforeach

					</table>
				</div>
		    
		    </div>
		</div>
	</div>

@endsection