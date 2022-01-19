
<?php $__env->startSection('title','銘柄カテゴリ編集'); ?>
<?php $__env->startSection('content'); ?>
        <form action="<?php echo e(route('MeigaraCategory.update',['meigaraCategory' => $meigaraCategory])); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <label>銘柄カテゴリ名
            <input type="text" name="category_name" value="<?php echo e($meigaraCategory->category_name); ?>"></label>
            <button class="btn btn-outline-primary"><i class="fas fa-check"></i>送信</button>
        </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.myapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sample\resources\views/MeigaraCategory/edit.blade.php ENDPATH**/ ?>