<?php $__env->startSection('header'); ?>
	<div class="col-lg-12">
		<h1 class="page-header">
		    Detailed Order History<small>Page</small>
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

		    <h2><?php echo e($product_name); ?></h2>
		    <br/>

		    	<div class="table-responsive">
		    		<table id="data_table" class="table table-bordered table-hover">
						<thead>
                            <tr>
                                <th>item_name</th>
                                <th>item_value</th>
                                <th>service_type</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php $__currentLoopData = $order_meta_reference_obj; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td>
								<?php if( $value->item_type == 'STOCK' ): ?>
									<?php echo link_to_route('order.super-detailed-history', $value->item_name, [$value->item_code, 'STOCK']); ?>

								<?php else: ?>
									<?php echo link_to_route('order.super-detailed-history', $value->item_name, [$value->item_code, 'RAW']); ?>

								<?php endif; ?>
								</td>
								<td><?php echo e($value->item_value); ?></td>
								<td><?php echo e($value->item_type); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					</table>
				</div>
		    
		    </div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>