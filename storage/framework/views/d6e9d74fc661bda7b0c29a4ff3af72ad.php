<div class="row">
    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo e($user); ?></h3>
                    <p>Total Users</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="<?php echo e(route('admin.user.index')); ?>" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?php echo e($employee); ?></h3>
                    <p>Total Employees</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list-alt"></i>
                </div>
                <a href="<?php echo e(route('admin.employee.index')); ?>" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3><?php echo e($product); ?></h3>
                    <p>Total Products</p>
                </div>
                <div class="icon">
                    <i class="fas fas fa-th"></i>
                </div>
                <a href="<?php echo e(route('admin.product.index')); ?>" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3><?php echo e($collection); ?></h3>
                    <p>Total Collections</p>
                </div>
                <div class="icon">
                    <i class="fas fas fa-file-pdf"></i>
                </div>
                <a href="<?php echo e(route('admin.collection.index')); ?>" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH D:\PAYROLL\PS\adminlte-laravel10\resources\views/components/dashboard.blade.php ENDPATH**/ ?>