@extends('layouts.app')

@section('header')
	<div class="col-lg-12">
		<h1 class="page-header">
		    Construction <small>Page</small>
		</h1>
	</div>
@endsection


@section('content')

	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> List of Products </h3>
		    </div>

		    <div class="panel-body">

		    	@if (Session::has('message'))
   					<div class="alert alert-info">{{ Session::get('message') }}</div>
				@endif

		    	<div class="table-responsive">

		    		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="qty" class="col-md-1 control-label">Add Quantity</label>

                        <div class="col-md-4">
                            {!! Form::text('quantity_tmp', null, ['class'=>'form-control', 'id' => 'products_build_quantity']) !!}

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <br/>
                    <br/>

		    		<table  class="table table-bordered table-hover">
						<thead>
                            <tr>
                                <th>product_name</th>
                                <th>brand_new</th>
                                <th>refill</th>
                                <th>repaint</th>
                            </tr>
                        </thead>
                        <tbody>

							@foreach ( $products as $key => $value )
								
								<tr>
									<td>{{ $value->product_name }}
									</td>
									<td>
										@if( $value->is_brand_new == 1 ) 											
											{!! Form::open(['method' => 'POST', 'route'=>'products.build', 'role' => 'form']) !!}												
												{!! Form::submit('Brand New', ['class' => 'btn btn-lg btn-primary']) !!}
												{!! Form::hidden('service_type', 'brand_new', null) !!}
												{!! Form::hidden('product_code', $value->product_code, null) !!}
												{!! Form::text('quantity', null, ['class'=>'form-control hide products_build_quantity_final']) !!}
											{!! Form::close() !!}
										@else
											{!! Form::button('Brand New', ['class' => 'btn btn-primary', 'disabled' => 'disabled']) !!}
										@endif
									</td>
									<td>
										@if( $value->is_refill == 1 ) 
											{!! Form::open(['method' => 'POST', 'route'=>'products.build', 'role' => 'form']) !!}
												{!! Form::submit('Refill', ['class' => 'btn btn-lg btn-primary']) !!}
												{!! Form::hidden('service_type', 'refill', null) !!}
												{!! Form::hidden('product_code', $value->product_code, null) !!}
												{!! Form::text('quantity', null, ['class'=>'form-control hide products_build_quantity_final']) !!}
											{!! Form::close() !!}
										@else
											{!! Form::button('Refill', ['class' => 'btn btn-primary', 'disabled' => 'disabled']) !!}
										@endif
									 </td>
									 <td>
										@if( $value->is_repaint == 1 ) 	
											{!! Form::open(['method' => 'POST', 'route'=>'products.build', 'role' => 'form']) !!}
												{!! Form::submit('Repaint', ['class' => 'btn btn-lg btn-primary']) !!}
												{!! Form::hidden('service_type', 'repaint', null) !!}
												{!! Form::hidden('product_code', $value->product_code, null) !!}
												{!! Form::text('quantity', null, ['class'=>'form-control hide products_build_quantity_final']) !!}
											{!! Form::close() !!}
										@else
											{!! Form::button('Repaint', ['class' => 'btn btn-primary', 'disabled' => 'disabled']) !!}
										@endif
									 </td>
								</tr>
								
							@endforeach

						

					</table>
				</div>
		    
		    </div>
		</div>
	</div>

@endsection