




<?php echo Form::open(['method' => 'POST', 'route'=>'payment.save', 'class' => 'form-horizontal']); ?>


	<?php echo Form::text('first_name', null, ['id' => 'first_name', 'class'=>'form-control' , 'placeholder'=>'first_name']); ?> 
	<?php if($errors->has('first_name')): ?><strong><?php echo e($errors->first('first_name')); ?></strong><?php endif; ?><br/>
	<?php echo Form::text('middle_name', null, ['id' => 'middle_name', 'class'=>'form-control' , 'placeholder'=>'middle_name']); ?> 
	<?php if($errors->has('middle_name')): ?><strong><?php echo e($errors->first('middle_name')); ?></strong><?php endif; ?><br/>
	<?php echo Form::text('last_name', null, ['id' => 'last_name', 'class'=>'form-control' , 'placeholder'=>'last_name']); ?> 
	<?php if($errors->has('last_name')): ?><strong><?php echo e($errors->first('last_name')); ?></strong><?php endif; ?><br/>
	<?php echo Form::text('address_1', null, ['id' => 'address_1', 'class'=>'form-control' , 'placeholder'=>'address_1']); ?> 
	<?php if($errors->has('address_1')): ?><strong><?php echo e($errors->first('address_1')); ?></strong><?php endif; ?><br/>
	<?php echo Form::text('address_2', null, ['id' => 'address_2', 'class'=>'form-control' , 'placeholder'=>'address_2']); ?> 
	<?php if($errors->has('address_2')): ?><strong><?php echo e($errors->first('address_2')); ?></strong><?php endif; ?><br/>
	<?php echo Form::text('city', null, ['id' => 'city', 'class'=>'form-control' , 'placeholder'=>'city']); ?> 
	<?php if($errors->has('city')): ?><strong><?php echo e($errors->first('city')); ?></strong><?php endif; ?><br/>
	<?php echo Form::text('state', null, ['id' => 'state', 'class'=>'form-control' , 'placeholder'=>'state']); ?> 
	<?php if($errors->has('state')): ?><strong><?php echo e($errors->first('state')); ?></strong><?php endif; ?><br/>
	<?php echo Form::text('country', null, ['id' => 'country', 'class'=>'form-control' , 'placeholder'=>'country']); ?> 
	<?php if($errors->has('country')): ?><strong><?php echo e($errors->first('country')); ?></strong><?php endif; ?><br/>
	<?php echo Form::text('zip_code', null, ['id' => 'zip_code', 'class'=>'form-control' , 'placeholder'=>'zip_code']); ?> 
	<?php if($errors->has('zip_code')): ?><strong><?php echo e($errors->first('zip_code')); ?></strong><?php endif; ?><br/>

	<?php echo Form::text('email_address', null, ['id' => 'email_address', 'class'=>'form-control' , 'placeholder'=>'email_address']); ?> 
    <?php if($errors->has('email_address')): ?><strong><?php echo e($errors->first('email_address')); ?></strong><?php endif; ?><br/>
	<?php echo Form::text('phone_number', null, ['id' => 'phone_number', 'class'=>'form-control' , 'placeholder'=>'phone_number']); ?> 
	<?php if($errors->has('phone_number')): ?><strong><?php echo e($errors->first('phone_number')); ?></strong><?php endif; ?><br/>
	<?php echo Form::text('mobile_number', null, ['id' => 'mobile_number', 'class'=>'form-control', 'placeholder'=>'mobile_number']); ?> 
	<?php if($errors->has('mobile_number')): ?><strong><?php echo e($errors->first('mobile_number')); ?></strong><?php endif; ?><br/>
	<?php echo Form::text('sbc_account_number', null, ['id' => 'sbc_account_number', 'class'=>'form-control', 'placeholder'=>'sbc_account_number']); ?> 
	<?php if($errors->has('sbc_account_number')): ?><strong><?php echo e($errors->first('sbc_account_number')); ?></strong><?php endif; ?><br/>
	<?php echo Form::text('deposit_amount', null, ['id' => 'deposit_amount', 'class'=>'form-control', 'placeholder'=>'deposit_amount']); ?> 
	<?php if($errors->has('deposit_amount')): ?><strong><?php echo e($errors->first('deposit_amount')); ?></strong><?php endif; ?><br/>
	<?php echo Form::text('fees', null, ['id' => 'fees', 'class'=>'form-control', 'placeholder'=>'fees']); ?> 
	<?php if($errors->has('fees')): ?><strong><?php echo e($errors->first('fees')); ?></strong><?php endif; ?><br/>
	<?php echo Form::text('promo_code', null, ['id' => 'promo_code', 'class'=>'form-control', 'placeholder'=>'promo_code']); ?> 
	<?php if($errors->has('promo_code')): ?><strong><?php echo e($errors->first('promo_code')); ?></strong><?php endif; ?><br/>
	<?php echo Form::text('discount', null, ['id' => 'discount', 'class'=>'form-control', 'readonly', 'placeholder'=>'discount']); ?> 
	<?php if($errors->has('discount')): ?><strong><?php echo e($errors->first('discount')); ?></strong><?php endif; ?><br/>
	<?php echo Form::text('net_payment', null, ['id' => 'net_payment', 'class'=>'form-control', 'readonly', 'placeholder'=>'net_payment']); ?> 
	<?php if($errors->has('net_payment')): ?><strong><?php echo e($errors->first('net_payment')); ?></strong><?php endif; ?><br/>

	<?php echo Form::text('currency', null, ['id' => 'currency', 'class'=>'form-control', 'placeholder'=>'currency']); ?> 
	<?php if($errors->has('currency')): ?><strong><?php echo e($errors->first('currency')); ?></strong><?php endif; ?><br/>

	<?php echo Form::text('secure_3d', null, ['id' => 'secure_3d', 'class'=>'form-control', 'placeholder'=>'secure_3d']); ?> 
	<?php if($errors->has('secure_3d')): ?><strong><?php echo e($errors->first('secure_3d')); ?></strong><?php endif; ?><br/>

	<button type="submit" class="btn btn-primary">Next</button>
	
<?php echo Form::close(); ?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="<?php echo e(asset('js/ajax-compute-discount.js')); ?>"></script>