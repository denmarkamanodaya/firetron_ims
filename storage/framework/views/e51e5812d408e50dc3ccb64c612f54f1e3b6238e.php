<?php $__env->startSection('header'); ?>
	<div class="col-lg-12">
		<h1 class="page-header">
		    Commission Mapping <small>Page</small>
		</h1>
	</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Agent-Commission Mapping </h3>
		    </div>

		    <div class="panel-body">

		    	<div class="table-responsive">
		    		<table id="data_table_commission" class="table table-bordered table-hover">
						<thead>
                            <tr>
                            	<th>app_number</th>
                                <!-- <th>agent_id</th> -->
                                <th>full_name</th>
                                <th>amount</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php $__currentLoopData = $commission_obj; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($value->app_number); ?></td>
								<!-- <td><?php echo e($value->agent_id); ?></td> -->
								<td><?php echo e($value->full_name); ?></td>
								<td><?php echo e($value->amount); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					</table>
				</div>
		    
		    </div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>