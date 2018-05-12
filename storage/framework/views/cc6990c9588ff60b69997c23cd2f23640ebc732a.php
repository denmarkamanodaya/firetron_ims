<?php $__env->startSection('header'); ?>
	<div class="col-lg-12">
		<h1 class="page-header">
		    Construction <small>Page</small>
		</h1>
	</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> List of Products </h3>
		    </div>

		    <div class="panel-body">

		    	<?php if(Session::has('message')): ?>
   					<div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
				<?php endif; ?>

		    	<div class="table-responsive">

		    		<div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                        <label for="qty" class="col-md-1 control-label">Add Quantity</label>

                        <div class="col-md-4">
                            <?php echo Form::text('quantity_tmp', null, ['class'=>'form-control', 'id' => 'products_build_quantity']); ?>


                            <?php if($errors->has('password')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <br/>
                    <br/>

		    		<table  class="table table-bordered table-hover">
						<thead>
                            <tr>
                                <th>product_name</th>
                                <th>brand_new</th>
                                <th>refill</th>
                                <th>repaint</th>
                            </tr>
                        </thead>
                        <tbody>

							<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								
								<tr>
									<td><?php echo e($value->product_name); ?>

									</td>
									<td>
										<?php if( $value->is_brand_new == 1 ): ?> 											
											<?php echo Form::open(['method' => 'POST', 'route'=>'products.build', 'role' => 'form']); ?>												
												<?php echo Form::submit('Brand New', ['class' => 'btn btn-lg btn-primary']); ?>

												<?php echo Form::hidden('service_type', 'brand_new', null); ?>

												<?php echo Form::hidden('product_code', $value->product_code, null); ?>

												<?php echo Form::text('quantity', null, ['class'=>'form-control hide products_build_quantity_final']); ?>

											<?php echo Form::close(); ?>

										<?php else: ?>
											<?php echo Form::button('Brand New', ['class' => 'btn btn-primary', 'disabled' => 'disabled']); ?>

										<?php endif; ?>
									</td>
									<td>
										<?php if( $value->is_refill == 1 ): ?> 
											<?php echo Form::open(['method' => 'POST', 'route'=>'products.build', 'role' => 'form']); ?>

												<?php echo Form::submit('Refill', ['class' => 'btn btn-lg btn-primary']); ?>

												<?php echo Form::hidden('service_type', 'refill', null); ?>

												<?php echo Form::hidden('product_code', $value->product_code, null); ?>

												<?php echo Form::text('quantity', null, ['class'=>'form-control hide products_build_quantity_final']); ?>

											<?php echo Form::close(); ?>

										<?php else: ?>
											<?php echo Form::button('Refill', ['class' => 'btn btn-primary', 'disabled' => 'disabled']); ?>

										<?php endif; ?>
									 </td>
									 <td>
										<?php if( $value->is_repaint == 1 ): ?> 	
											<?php echo Form::open(['method' => 'POST', 'route'=>'products.build', 'role' => 'form']); ?>

												<?php echo Form::submit('Repaint', ['class' => 'btn btn-lg btn-primary']); ?>

												<?php echo Form::hidden('service_type', 'repaint', null); ?>

												<?php echo Form::hidden('product_code', $value->product_code, null); ?>

												<?php echo Form::text('quantity', null, ['class'=>'form-control hide products_build_quantity_final']); ?>

											<?php echo Form::close(); ?>

										<?php else: ?>
											<?php echo Form::button('Repaint', ['class' => 'btn btn-primary', 'disabled' => 'disabled']); ?>

										<?php endif; ?>
									 </td>
								</tr>
								
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						

					</table>
				</div>
		    
		    </div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>