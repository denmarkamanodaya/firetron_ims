<?php $__env->startSection('header'); ?>
	<div class="col-lg-12">
		<h1 class="page-header">
		    Cancellation List<small>Page</small>
		</h1>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="col-lg-12">

		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Cancellation List </h3>
		    </div>

		    <div class="panel-body">

		    	<div class="table-responsive">
		    		<table id="data_table_cancellation" class="table table-bordered table-hover">
						<thead>
                            <tr>
                            	<th>app_number</th>
                                <th>client_name</th>
                                <th>description</th>
                                <th>usr_username</th>
                                <th>created_at</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php $__currentLoopData = $cancellation_obj; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($value->app_number); ?></td>
								<td><?php echo e($value->client_name); ?></td>
								<td><?php echo e($value->description); ?></td>
								<td><?php echo e($value->usr_username); ?></td>
								<td><?php echo e($value->created_at); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					</table>
				</div>

			</div>

		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>