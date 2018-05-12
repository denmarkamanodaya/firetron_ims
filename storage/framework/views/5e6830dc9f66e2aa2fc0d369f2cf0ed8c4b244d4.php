<?php $__env->startSection('header'); ?>
    <div class="col-lg-12">
        <h1 class="page-header">
            Home <small>Page</small>
        </h1>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>