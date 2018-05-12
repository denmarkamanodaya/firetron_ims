<?php $__env->startSection('header'); ?>
	<div class="col-lg-12">
		<h1 class="page-header">
		    Mapping <small>Page</small>
		</h1>
	</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
	<div class="col-lg-6">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Create </h3>
		    </div>

		    <div class="panel-body">

				<?php echo Form::open(['method' => 'POST', 'route'=>'mapping.save']); ?>


				<div class="form-group">
					<label>List of Products</label>
					<?php echo Form::select('product_code', $product_list, null, ['class'=>'form-control']); ?>

				</div>

				<div class="form-group">
					<label>List of Components</label>
					<?php echo Form::select('component_code', $component_list, null, ['class'=>'form-control']); ?>

				</div>

				<div class="form-group">
					<label>Add Value to Component</label>
					<?php echo Form::text('component_value', null, ['class'=>'form-control']); ?>

				</div>

				<div class="form-group">
					<label>Service Type</label>
					<?php echo Form::select('service_type', ['BRAND_NEW' => 'BRAND_NEW','REFILL' => 'REFILL','REPAINT' => 'REPAINT', 'N/A' => 'N/A'], null, ['class'=>'form-control']); ?>

				</div>

				
				<?php echo Form::hidden('added_by_id', 1); ?> <br/>

				<?php echo Form::submit('Add New Mapping', ['class' => 'btn btn-lg btn-primary']); ?>

				
				<br/><br/>

				Do you want to? 
				<?php echo link_to_route('products.create', 'Create New Product'); ?>

				or
				<?php echo link_to_route('components.create', 'Add A Component'); ?>


				<?php echo Form::close(); ?>


			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>