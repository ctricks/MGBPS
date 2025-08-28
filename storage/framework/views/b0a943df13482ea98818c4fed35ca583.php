<nav class="main-header navbar navbar-expand navbar-<?php echo e(Auth::user()->mode); ?> navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="submit" name="submit" value="Log out" class="btn btn-primary btn-sm">
                    
                </form>
        </li>
    </ul>
</nav>
<?php /**PATH D:\PAYROLL\PS\adminlte-laravel10\resources\views/components/navbar.blade.php ENDPATH**/ ?>