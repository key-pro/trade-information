
<?php $__env->startSection('title','銘柄カテゴリ新規作成'); ?>
<?php $__env->startSection('content'); ?>
        <form action="<?php echo e(route('MeigaraCategory.storeCofirm')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <label>銘柄カテゴリ名
            <input type="text" name="category_name"></label>
            <button>送信</button>
        </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.myapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sample\resources\views/MeigaraCategory/create.blade.php ENDPATH**/ ?>