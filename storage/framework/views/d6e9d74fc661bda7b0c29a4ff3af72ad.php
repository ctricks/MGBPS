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
            <div class="small-box bg-info">
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
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo e($processAttendance); ?></h3>
                    <p>Processed Attendance</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?php echo e(route('attendance.summary.index')); ?>" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <?php if( $processLeave <= 0): ?>
               <div class="small-box bg-success">
            <?php else: ?>
                <div class="small-box bg-danger">
            <?php endif; ?>
                <div class="inner">
                    <h3><?php echo e($processLeave); ?></h3>
                    <p>For Process Leave</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?php echo e(route('attendance.leave.index')); ?>" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <?php if( $processPayroll <= 0): ?>
               <div class="small-box bg-success">
            <?php else: ?>
                <div class="small-box bg-danger">
            <?php endif; ?>
                <div class="inner">
                    <h3><?php echo e($processPayroll); ?></h3>
                    <p>For Process Payroll</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo e(route('payroll.payroll.index')); ?>" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <?php if( $processOvertime <= 0): ?>
               <div class="small-box bg-success">
            <?php else: ?>
                <div class="small-box bg-danger">
            <?php endif; ?>
                <div class="inner">
                    <h3><?php echo e($processOvertime); ?></h3>
                    <p>For Process Overtime</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo e(route('earnings.overtime.index')); ?>" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH D:\PAYROLL\PS\adminlte-laravel10\resources\views/components/dashboard.blade.php ENDPATH**/ ?>