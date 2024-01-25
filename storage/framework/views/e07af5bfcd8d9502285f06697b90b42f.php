<div class="filter-data">
    <?php if(count($products) > 0): ?>
     <ul>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <b><?php echo e($product->name); ?> </b> , <b><?php echo e($product->price); ?></b>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </ul>  
     <?php else: ?>  
     <i>"No products price greater than this input value"</i>
    
     <?php endif; ?>
</div><?php /**PATH C:\AnasAcademy\resources\views/search.blade.php ENDPATH**/ ?>