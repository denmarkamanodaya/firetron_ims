<?php $__env->startSection('header'); ?>
	<div class="col-lg-12">
		<h1 class="page-header">
		    Products Mapping <small>Page</small>
		</h1>
	</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Full Mapping Table </h3>
		    </div>

		    <div class="panel-body">

		    	<div class="table-responsive">
		    		<table id="data_table" class="table table-bordered table-hover">
						<thead>
                            <tr>
                                <th>mapping_type</th>
                                <th>product_code</th>
                                <th>product_name</th>
                                <th>component_name</th>
                                <th>component_value</th>
                                <th>is_active</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php $__currentLoopData = $product_mapping_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($value->mapping_type); ?></td>
								<td><?php echo e($value->product_code); ?></td>
								<td><?php echo e($value->product_name); ?></td>
								<td><?php echo e($value->component_name); ?></td>
								<td><?php echo e($value->component_value); ?></td>
								<td><?php echo e($value->is_active); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					</table>
				</div>
		    
		    </div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>