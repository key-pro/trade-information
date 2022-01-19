
<?php $__env->startSection('title','銘柄カテゴリ削除'); ?>
<?php $__env->startSection('content'); ?>
        <h1><i class="fas fa-question-circle"></i>以下の銘柄カテゴリ名を削除しますか</h1>
        <form action="<?php echo e(route('MeigaraCategory.destroy',['meigaraCategory' => $meigaraCategory])); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <label>銘柄カテゴリ名
            <input type="text" name="category_name" value="<?php echo e($meigaraCategory->category_name); ?>"></label>
            <button class="btn btn-outline-primary"><i class="fas fa-exclamation-triangle"></i>送信</button>
        </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.myapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sample\resources\views/MeigaraCategory/delete.blade.php ENDPATH**/ ?>