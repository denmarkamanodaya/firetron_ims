@extends('layouts.app')

@section('header')
	<div class="col-lg-12">
		<h1 class="page-header">
		    Components <small>Page</small>
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

				{!! Form::open(['method' => 'POST', 'route'=>'components.save']) !!}

				<div class="form-group">
					<label>Component Name</label>
					{!! Form::text('component_name', null, ['class'=>'form-control']) !!}
				</div>

				<div class="form-group">
					<label>Component Category</label>
					{!! Form::select('component_category_id', $component_category, null, ['class'=>'form-control']) !!}
				</div>

				<div class="form-group">
					<label>Component Quantity</label>
					{!! Form::text('component_quantity', null, ['class'=>'form-control']) !!}
				</div>

				{!! Form::hidden('added_by_id', 1) !!} <br/>

				{!! Form::submit('Add New Component', ['class' => 'btn btn-lg btn-primary']) !!}

				{!! Form::close() !!}

			</div>

		</div>
	</div>
@endsection