@extends('layouts.app')

@section('header')
	<div class="col-lg-12">
		<h1 class="page-header">
		    Commission <small>Page</small>
		</h1>
	</div>
@endsection


@section('content')

	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Pending Commission</h3>
		    </div>

		    <div class="panel-body">

		    	{!! Form::open(['method' => 'POST', 'route'=>'commission.pending', 'role' => 'form']) !!}

			    	<div class="table-responsive">

				    		<table id="data_table" class="table table-bordered table-hover">
								<thead>
		                            <tr>
		                            	<th></th>
		                            	<th>app_number</th>
		                                <!-- <th>agent_id</th> -->
		                                <th>full_name</th>
		                                <th>amount</th>
		                            </tr>
		                        </thead>
		                        <tbody>
								@foreach ( $pending_obj as $key => $value )
									<tr>
										<td>{!! Form::checkbox('commission_array[]', $value->app_number) !!}</td>
										<td>{{ $value->app_number }}</td>
										<!-- <td>{{ $value->agent_id }}</td> -->
										<td>{{ $value->full_name }}</td>
										<td>{{ $value->amount }}</td>
									</tr>
								@endforeach
							</table>

							{!! Form::hidden('added_by_id', 1) !!} <br/>

					</div>

				{!! Form::submit('Save Commission', ['class' => 'btn btn-lg btn-primary']) !!}

		</div>
	</div>

@endsection