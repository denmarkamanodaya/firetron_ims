@extends('layouts.app')

@section('header')
	<div class="col-lg-12">
		<h1 class="page-header">
		    Commission Mapping <small>Page</small>
		</h1>
	</div>
@endsection


@section('content')

	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Agent-Commission Mapping </h3>
		    </div>

		    <div class="panel-body">

		    	<div class="table-responsive">
		    		<table id="data_table_commission" class="table table-bordered table-hover">
						<thead>
                            <tr>
                            	<th>app_number</th>
                                <!-- <th>agent_id</th> -->
                                <th>full_name</th>
                                <th>amount</th>
                            </tr>
                        </thead>
                        <tbody>
						@foreach ( $commission_obj as $key => $value )
							<tr>
								<td>{{ $value->app_number }}</td>
								<!-- <td>{{ $value->agent_id }}</td> -->
								<td>{{ $value->full_name }}</td>
								<td>{{ $value->amount }}</td>
							</tr>
						@endforeach

					</table>
				</div>
		    
		    </div>
		</div>
	</div>

@endsection