@extends('layouts.app')

@section('header')
	<div class="col-lg-12">
		<h1 class="page-header">
		    Products <small>Page</small>
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

				{!! Form::open(['method' => 'POST', 'route'=>'products.save', 'role' => 'form']) !!}

					<div class="form-group">
						<label>Product Name</label>
						{!! Form::text('product_name', null, ['class'=>'form-control']) !!}
					</div>

					<div class="form-group">
						<label>Product Category</label>
						{!! Form::select('category_id', $product_category, null, ['class'=>'form-control']) !!}
					</div>

					<div class="form-group">
						<label>Product Type</label>
						{!! Form::select('type_id', $product_type, null, ['class'=>'form-control']) !!}
					</div>

					<div class="form-group">
						<label>Is Brand New?</label>
						{!! Form::checkbox('is_brand_new', '1');!!}
					</div>

					<div class="form-group">
						<label>Is Refill?</label>
						{!! Form::checkbox('is_refill', '1') !!}
					</div>

					<div class="form-group">
						<label>Is Repaint?</label>
						{!! Form::checkbox('is_repaint', '1') !!}
					</div>

					<div class="form-group">
						<label>Product Quantity</label>
						{!! Form::text('product_quantity', null, ['class'=>'form-control']) !!}
					</div>

					{!! Form::hidden('added_by_id', 1) !!} <br/>

					{!! Form::submit('Add New Product', ['class' => 'btn btn-lg btn-primary']) !!}

				{!! Form::close() !!}        
		    </div>
		</div>
	</div>

@endsection