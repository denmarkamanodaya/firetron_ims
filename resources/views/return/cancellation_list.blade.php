@extends('layouts.app')

@section('header')
	<div class="col-lg-12">
		<h1 class="page-header">
		    Cancellation List<small>Page</small>
		</h1>
	</div>
@endsection

@section('content')
	<div class="col-lg-12">

		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Cancellation List </h3>
		    </div>

		    <div class="panel-body">

		    	<div class="table-responsive">
		    		<table id="data_table_cancellation" class="table table-bordered table-hover">
						<thead>
                            <tr>
                            	<th>app_number</th>
                                <th>client_name</th>
                                <th>description</th>
                                <th>usr_username</th>
                                <th>created_at</th>
                            </tr>
                        </thead>
                        <tbody>
						@foreach ( $cancellation_obj as $key => $value )
							<tr>
								<td>{{ $value->app_number }}</td>
								<td>{{ $value->client_name }}</td>
								<td>{{ $value->description }}</td>
								<td>{{ $value->usr_username }}</td>
								<td>{{ $value->created_at }}</td>
							</tr>
						@endforeach

					</table>
				</div>

			</div>

		</div>
	</div>
@endsection