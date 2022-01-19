
<?php $__env->startSection('title',"銘柄新規登録"); ?>
<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('Meigara.storeConfirm')); ?>" method="POST">
        <?php echo csrf_field(); ?>
    <div>
        <label>新規銘柄<br>
        <?php if($errors -> has("meigara_name")): ?>
             <?php echo e($errors-> first("meigara_name")); ?><br>
        <?php endif; ?>
        <input type="text" name="meigara_name"></label>
    </div>
    
    <div>
        <label>シンボル<br>
        <input type="text" name="symbol"></label>
            
        <?php if($errors -> has("symbol")): ?>
            <?php echo e($errors-> first("symbol")); ?><br>
        <?php endif; ?>    
    </div>
        
    <div>
        <label>通貨<br>
        <input type="text" name="currency"></label>
        <?php if($errors -> has("currency")): ?>

            <?php echo e($errors-> first("currency")); ?><br>
        <?php endif; ?>    
    </div>
        <button>確認</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.myapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sample\resources\views/Meigara/create.blade.php ENDPATH**/ ?>