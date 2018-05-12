<?php $__env->startSection('header'); ?>
	<div class="col-lg-12">
		<h1 class="page-header">
		    Quantity Mapping <small>Page</small>
		</h1>
	</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Product & Components </h3>
		    </div>

		    <div class="panel-body">

		    	<div class="table-responsive">
		    		<table id="data_table" class="table table-bordered table-hover">
						<thead>
                            <tr>
                            	<th>item_name</th>
                                <th>quantity</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php $__currentLoopData = $quantity_obj; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<?php if( $is_raw ): ?>
									<td><?php echo link_to_route('order.super-detailed-history', $value->item_name, [$value->code_id, 'RAW']); ?></td>
								<?php else: ?>
									<td><?php echo link_to_route('order.super-detailed-history', $value->item_name, [$value->item_code, 'STOCK']); ?></td>
								<?php endif; ?>

								<td><?php echo e($value->quantity); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					</table>
				</div>
		    
		    </div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>