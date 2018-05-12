<?php $__env->startSection('header'); ?>
	<div class="col-lg-12">
		<h1 class="page-header">
		    Super Detailed Order History<small>Page</small>
		</h1>
	</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Detailed History </h3>
		    </div>

		    <div class="panel-body">

		    <h2><?php echo e($item_name); ?></h2>
		    <h3>Current Quantity: <?php echo e($item_quantity); ?></h3>
		    <br/>

		    	<div class="table-responsive">
		    		<table id="data_table_inventory_level" class="table table-bordered table-hover">
						<thead>
                            <tr>
                            	<th>total_count</th>
                            	<th>item_value</th>
                                <th>total_value</th>
                                <th>app_number</th>
                                <th>client_name</th>
                                <th>product_name</th>
                                <th>created_at</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php $__currentLoopData = $super_detailed_obj; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($value->total_count); ?></td>
								<td><?php echo e($value->item_value); ?></td>
                                <td><?php echo e($value->total_value); ?></td>
								<td><?php echo e($value->app_number); ?></td>
								<td><?php echo app('App\Http\Controllers\Helper\FunctionsController')->getClientNameByAppNumber($value->app_number); ?></td>
								<td><?php echo e($value->product_name); ?></td>
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