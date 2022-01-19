
<?php $__env->startSection('title','銘柄カテゴリ名一覧'); ?>
<?php $__env->startSection('content'); ?>
        <form action="<?php echo e(route('Meigara.index')); ?>" method="get">
            <input type="text" name="text_meigara_name_part">
            <button>検索</button>
        </form>
        <?php $__currentLoopData = $meigaras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meigara): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="meigara-entry">
            <?php echo e($meigara->id); ?>

            <?php echo e($meigara->meigara_name); ?>

            <?php echo e($meigara->created_at->format('Y/m/d H:i')); ?>

            <a class="btn-outline-primary btn" href="<?php echo e(route('Meigara.show',['meigara' => $meigara])); ?>"><i class="fas fa-cog"></i>詳細</a>
            <a class="btn-outline-primary btn" href="<?php echo e(route('Meigara.edit',['meigara' => $meigara])); ?>"><i class="fas fa-cog"></i>編集</a>
            <a class="btn-outline-primary btn" href="<?php echo e(route('Meigara.delete',['meigara' => $meigara])); ?>"><i class="fas fa-trash-alt"></i>削除</a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($meigaras->onEachSide(3)->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.myapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sample\resources\views/Meigara/index.blade.php ENDPATH**/ ?>