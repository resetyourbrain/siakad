<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" data-topbar="light" data-sidebar-image="none">

    <head>
    <meta charset="utf-8" />
    <title><?php echo $__env->yieldContent('title'); ?> | SIAKAD - Sistem Informasi Akademik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(URL::asset('build/images/alfaprima_white.ico')); ?>">
        <?php echo $__env->make('layouts.head-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </head>

    <?php echo $__env->yieldContent('body'); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('layouts.vendor-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html>
<?php /**PATH /home/reset/LEARN/sistem-akademik/resources/views/layouts/master-without-nav.blade.php ENDPATH**/ ?>