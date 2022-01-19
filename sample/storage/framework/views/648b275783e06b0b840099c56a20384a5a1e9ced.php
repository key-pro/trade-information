
<?php $__env->startSection('title','銘柄編集'); ?>
<?php $__env->startSection('content'); ?>
<!-- <?php
var_dump($meigara);
?> -->
    <form action="<?php echo e(route('Meigara.update',['meigara' => $meigara])); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <label>銘柄名
        <input type="text" name="meigara_name" value="<?php echo e($meigara->meigara_name); ?>"></label>
        <button class="btn btn-outline-primary"><i class="fas fa-check"></i>送信</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.myapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sample\resources\views/Meigara/edit.blade.php ENDPATH**/ ?>