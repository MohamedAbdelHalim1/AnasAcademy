

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 style="float:left;font-weight:bold;">Search Product</h3>
                </div>

                <div class="card-body">

                    <form class="form-horizontal" action="<?php echo e(route('search')); ?>" method="post" id="ajax-upload">
                        <?php echo csrf_field(); ?>
         
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="price"><b>Price:</b><span style="color:red;">*</span></label>
                            <div class="col-sm-10">
                            <input type="number" step="any" class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('price')); ?>" id="price" placeholder="Enter Price" name="price">
                            <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

      
                    
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10 mt-2">
                            <input type="submit" class="btn btn-primary" value="Search" />
                            </div>
                        </div>
                    </form>

                    <div class="filter-data">
                        <i>"Here we will appear all products which their price greater than your input"</i>
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
</div>





    <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


                $(document).ready(function(){
                  
                    $('#ajax-upload').on('submit',function(e){

                        e.preventDefault();
                        jQuery.ajax({
                            url : "<?php echo e(route('search')); ?>",
                            data: jQuery('#ajax-upload').serialize(),
                            type:'post',
                            success:function(data){
                                $('.filter-data').html(data);                                    }

                                })

                            });
                        });

           

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AnasAcademy\resources\views/filter.blade.php ENDPATH**/ ?>