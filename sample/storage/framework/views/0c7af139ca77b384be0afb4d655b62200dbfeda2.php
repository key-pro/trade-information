
<?php $__env->startSection('titile','銘柄名'); ?>
<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('Meigara.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div>
        <label>新規銘柄<br>
        <input type="hidden" name="meigara_name" value="<?php echo e(request()->input('meigara_name')); ?>"></label>
                <?php echo e(request()->input('meigara_name')); ?>

    </div>
    <div>
        <label>シンボル<br>
        <input type="hidden" name="symbol" value="<?php echo e(request()->input('symbol')); ?>"></label>
                <?php echo e(request()->input('symbol')); ?>

    </div>

    <div>
        <label>通貨<br>
        <input type="hidden" name="currency" value="<?php echo e(request()->input('currency')); ?>"></label>
                <?php echo e(request()->input('currency')); ?>

    </div>
    
    <button>登録</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.myapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sample\resources\views/Meigara/storeConfirm.blade.php ENDPATH**/ ?>