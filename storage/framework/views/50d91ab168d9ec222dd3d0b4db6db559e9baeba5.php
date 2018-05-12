<?php $__env->startSection('header'); ?>
	<div class="col-lg-12">
		<h1 class="page-header">
		    Return Pruchase<small>Page</small>
		</h1>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="col-lg-6">

				<?php if(Session::has('message')): ?>
   					<div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
				<?php endif; ?>

		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Return </h3>
		    </div>

		    <div class="panel-body">

				<?php echo Form::open(['method' => 'POST', 'route'=>'return.process']); ?>


				<div class="form-group">
					<label>Processmaker APP_NUMBER</label>
					<?php echo Form::text('app_number', null, ['class'=>'form-control', 'required' => 'required']); ?>

				</div>

				<div class="form-group">
					<label>Note</label>
					<?php echo Form::textarea('description', null, ['class'=>'form-control', 'size' => '30x7', 'placeholder' => '(Optional)']); ?>

				</div>

				<?php echo Form::submit('Return Now', ['class' => 'btn btn-lg btn-primary']); ?>


				<?php echo Form::close(); ?>


			</div>

		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>