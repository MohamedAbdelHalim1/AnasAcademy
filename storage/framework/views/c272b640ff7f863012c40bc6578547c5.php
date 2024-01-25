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
                    <h3 style="float:left;font-weight:bold;">Products List</h3>
                    <a href="<?php echo e(route('filter')); ?>" class="btn btn-primary" style="margin:0 0 0 280px;">Filter By Price</a>
                    <a href="<?php echo e(route('create')); ?>" class="btn btn-primary" style="float:right;">Add New Product</a>
                </div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quntity</th>
                                <th>Category ID</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($product->name); ?></td>
                                <td><?php echo e($product->price); ?></td>
                                <td><?php echo e($product->quantity); ?></td>
                                <td>
                                    <?php echo e($product->category_id); ?>

                                </td>
                            
                                <td>
                                <a href="<?php echo e(route('edit_product',$product->id)); ?>">Edit</a> | <a href="#" onclick="delete_product(<?php echo e($product->id); ?>)">Delete</a>  <form action="<?php echo e(route('checkout',$product->id)); ?>" method="post"><?php echo csrf_field(); ?><button type="submit" style="border:none;background:transparent;">Checkout</button></form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
        function delete_product(id){
            Swal.fire({
                title: "Delete this product! Are You Sure?",
                showCancelButton: true,

                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                        $.ajax({
                        type : "POST",
                        url : "delete_product/" + id,
                        data :{ "_token": "<?php echo e(csrf_token()); ?>",
                                },
                        success : function(response){
                            if (response.message) {
                                    swal({
                                        title:"403",
                                        text:response.message
                                    })
                                }else{
                                    location.reload();
                                }
                                    
                                    }
                        });




                }
                });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AnasAcademy\resources\views/show_products.blade.php ENDPATH**/ ?>