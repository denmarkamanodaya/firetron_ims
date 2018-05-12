<?php $__env->startSection('header'); ?>
	<div class="col-lg-12">
		<h1 class="page-header">
		    Products <small>Page</small>
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

				<?php echo Form::open(['method' => 'POST', 'route'=>'products.save', 'role' => 'form']); ?>


					<div class="form-group">
						<label>Product Name</label>
						<?php echo Form::text('product_name', null, ['class'=>'form-control']); ?>

					</div>

					<div class="form-group">
						<label>Product Category</label>
						<?php echo Form::select('category_id', $product_category, null, ['class'=>'form-control']); ?>

					</div>

					<div class="form-group">
						<label>Product Type</label>
						<?php echo Form::select('type_id', $product_type, null, ['class'=>'form-control']); ?>

					</div>

					<div class="form-group">
						<label>Is Brand New?</label>
						<?php echo Form::checkbox('is_brand_new', '1');; ?>

					</div>

					<div class="form-group">
						<label>Is Refill?</label>
						<?php echo Form::checkbox('is_refill', '1'); ?>

					</div>

					<div class="form-group">
						<label>Is Repaint?</label>
						<?php echo Form::checkbox('is_repaint', '1'); ?>

					</div>

					<div class="form-group">
						<label>Product Quantity</label>
						<?php echo Form::text('product_quantity', null, ['class'=>'form-control']); ?>

					</div>

					<?php echo Form::hidden('added_by_id', 1); ?> <br/>

					<?php echo Form::submit('Add New Product', ['class' => 'btn btn-lg btn-primary']); ?>


				<?php echo Form::close(); ?>        
		    </div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>