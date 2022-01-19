
<?php $__env->startSection('title','銘柄カテゴリ名'); ?>
<?php $__env->startSection('content'); ?>
<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li><?php echo e($error); ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <form action="<?php echo e(route('MeigaraCategory.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <label>銘柄カテゴリ名
            <?php if($errors->has('category_name')): ?>
                <?php echo e($errors->first('category_name')); ?><br>
            <?php endif; ?>
            <input type="hidden" name="category_name" value="<?php echo e(request()->input('category_name')); ?>"></label>
            <?php echo e(request()->input('category_name')); ?>

            <button>送信</button>
        </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.myapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sample\resources\views/MeigaraCategory/storeConfirm.blade.php ENDPATH**/ ?>