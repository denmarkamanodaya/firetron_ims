@extends('layouts.app')

@section('header')
	<div class="col-lg-12">
		<h1 class="page-header">
		    Commission <small>Page</small>
		</h1>
	</div>
@endsection


@section('content')

	<div class="col-lg-6">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Create </h3>
		    </div>

		    <div class="panel-body">

				{!! Form::open(['method' => 'POST', 'route'=>'agent.save', 'role' => 'form']) !!}

					<div class="form-group">
						<label>Agent Name</label>
						{!! Form::text('agent_full_name', null, ['class'=>'form-control']) !!}
					</div>

					{!! Form::hidden('added_by_id', 1) !!} <br/>

					{!! Form::submit('Add New Agent', ['class' => 'btn btn-lg btn-primary']) !!}

				{!! Form::close() !!}        
				
		    </div>
		</div>
	</div>

@endsection