<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/my.css')); ?>">
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous">
    </script>
    <?php echo $__env->yieldContent('header_js'); ?>

</head>
<body>
       
    <!-- ヘッダー -->
    <header>
        tradeインフォメーション
    </header>
 
    <!-- メインコンテンツ -->
    <main>
        <h1><?php echo $__env->yieldContent('title'); ?></h1>
        <?php if(session()->has("message")): ?>
            <?php echo e(session('message')); ?>

        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>
 
    <!-- フッター -->
    <footer>
        &copy;kamiyuki
    </footer>
 
   
    <!-- <script src="sample.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\sample\resources\views/layouts/myapp.blade.php ENDPATH**/ ?>