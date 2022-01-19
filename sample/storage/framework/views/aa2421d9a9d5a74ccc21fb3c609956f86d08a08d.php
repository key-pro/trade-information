
<?php $__env->startSection('title','銘柄削除'); ?>
<?php $__env->startSection('content'); ?>
        <h1><i class="fas fa-question-circle"></i>以下の銘柄名を削除しますか</h1>
        <form action="<?php echo e(route('Meigara.destroy',['meigara' => $meigara])); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <label>銘柄カテゴリ名
            <input type="text" name="meigara_name" value="<?php echo e($meigara->meigara_name); ?>"></label>
            <button class="btn btn-outline-primary"><i class="fas fa-exclamation-triangle"></i>送信</button>
        </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.myapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sample\resources\views/Meigara/delete.blade.php ENDPATH**/ ?>