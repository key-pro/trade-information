
<?php $__env->startSection('title','銘柄カテゴリ名一覧'); ?>
<?php $__env->startSection('content'); ?>
        <form action="<?php echo e(route('MeigaraCategory.index')); ?>" method="get">
            <input type="text" name="text_category_name_part">
            <button>検索</button>
        </form>
        <?php $__currentLoopData = $meigaraCategorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meigaraCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="meigara-category-entry">
            <?php echo e($meigaraCategory->category_name); ?>

            <?php echo e($meigaraCategory->created_at->format('Y/m/d H:i')); ?>

            <a class="btn-outline-primary btn" href="<?php echo e(route('MeigaraCategory.edit',['meigaraCategory' => $meigaraCategory])); ?>"><i class="fas fa-cog"></i>編集</a>
            <a class="btn-outline-primary btn" href="<?php echo e(route('MeigaraCategory.delete',['meigaraCategory' => $meigaraCategory])); ?>"><i class="fas fa-trash-alt"></i>削除</a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($meigaraCategorys->onEachSide(3)->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.myapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sample\resources\views/MeigaraCategory/index.blade.php ENDPATH**/ ?>