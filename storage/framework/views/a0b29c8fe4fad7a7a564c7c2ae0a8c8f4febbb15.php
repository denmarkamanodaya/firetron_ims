<?php $__env->startSection('header'); ?>
	<div class="col-lg-12">
		<h1 class="page-header">
		    Commission <small>Page</small>
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

				<?php echo Form::open(['method' => 'POST', 'route'=>'agent.save', 'role' => 'form']); ?>


					<div class="form-group">
						<label>Agent Name</label>
						<?php echo Form::text('agent_full_name', null, ['class'=>'form-control']); ?>

					</div>

					<?php echo Form::hidden('added_by_id', 1); ?> <br/>

					<?php echo Form::submit('Add New Agent', ['class' => 'btn btn-lg btn-primary']); ?>


				<?php echo Form::close(); ?>        
				
		    </div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>