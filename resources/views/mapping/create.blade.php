@extends('layouts.app')

@section('header')
	<div class="col-lg-12">
		<h1 class="page-header">
		    Mapping <small>Page</small>
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

				{!! Form::open(['method' => 'POST', 'route'=>'mapping.save']) !!}

				<div class="form-group">
					<label>List of Products</label>
					{!! Form::select('product_code', $product_list, null, ['class'=>'form-control']) !!}
				</div>

				<div class="form-group">
					<label>List of Components</label>
					{!! Form::select('component_code', $component_list, null, ['class'=>'form-control']) !!}
				</div>

				<div class="form-group">
					<label>Add Value to Component</label>
					{!! Form::text('component_value', null, ['class'=>'form-control']) !!}
				</div>

				<div class="form-group">
					<label>Service Type</label>
					{!! Form::select('service_type', ['BRAND_NEW' => 'BRAND_NEW','REFILL' => 'REFILL','REPAINT' => 'REPAINT', 'N/A' => 'N/A'], null, ['class'=>'form-control']) !!}
				</div>

				
				{!! Form::hidden('added_by_id', 1) !!} <br/>

				{!! Form::submit('Add New Mapping', ['class' => 'btn btn-lg btn-primary']) !!}
				
				<br/><br/>

				Do you want to? 
				{!! link_to_route('products.create', 'Create New Product')  !!}
				or
				{!! link_to_route('components.create', 'Add A Component')  !!}

				{!! Form::close() !!}

			</div>
		</div>
	</div>
@endsection