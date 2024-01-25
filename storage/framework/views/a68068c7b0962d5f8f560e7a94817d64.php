

<?php $__env->startSection('style'); ?>

<style>
    td > a{
            font-size:15px;
            text-decoration:none;
            color:black;
        }
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 style="float:left;font-weight:bold;">Your Order Received successfully</h3>
                 </div>

                <div class="card-body">
                    <h3><i>"We will Keep track Your delivery Process"</i></h3>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AnasAcademy\resources\views/checkout_success.blade.php ENDPATH**/ ?>