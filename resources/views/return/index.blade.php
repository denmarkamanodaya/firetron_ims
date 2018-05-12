@extends('layouts.app')

@section('header')
	<div class="col-lg-12">
		<h1 class="page-header">
		    Return Pruchase<small>Page</small>
		</h1>
	</div>
@endsection

@section('content')
	<div class="col-lg-6">

				@if (Session::has('message'))
   					<div class="alert alert-info">{{ Session::get('message') }}</div>
				@endif

		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Return </h3>
		    </div>

		    <div class="panel-body">

				{!! Form::open(['method' => 'POST', 'route'=>'return.process']) !!}

				<div class="form-group">
					<label>Processmaker APP_NUMBER</label>
					{!! Form::text('app_number', null, ['class'=>'form-control', 'required' => 'required']) !!}
				</div>

				<div class="form-group">
					<label>Note</label>
					{!! Form::textarea('description', null, ['class'=>'form-control', 'size' => '30x7', 'placeholder' => '(Optional)']) !!}
				</div>

				{!! Form::submit('Return Now', ['class' => 'btn btn-lg btn-primary']) !!}

				{!! Form::close() !!}

			</div>

		</div>
	</div>
@endsection