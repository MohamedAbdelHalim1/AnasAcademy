

<?php $__env->startSection('style'); ?>

<style>
    td > a{
            font-size:15px;
            text-decoration:none;
        }
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 style="float:left;font-weight:bold;">Users List</h3>
                </div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($user->name); ?></td>
                            
                                <td>
                                    <a href="#" onclick="delete_user(<?php echo e($user->id); ?>)">Delete</a>
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
        function delete_user(id){
            Swal.fire({
                title: "Delete this product! Are You Sure?",
                showCancelButton: true,

                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                        $.ajax({
                        type : "POST",
                        url : "delete_user/" + id,
                        data :{ "_token": "<?php echo e(csrf_token()); ?>",
                                },
                        success : function(response){
                                    location.reload();
                                    }
                        });




                }
                });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AnasAcademy\resources\views/users.blade.php ENDPATH**/ ?>