<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e(Route::is('admin.dashboard') ? 'active' : ''); ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.employee.index')); ?>"
                    class="nav-link <?php echo e(Route::is('admin.employee.index') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Employees
                        <span class="badge badge-info right"><?php echo e($EmployeeCount); ?></span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.user.index')); ?>"
                    class="nav-link <?php echo e(Route::is('admin.user.index') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Users
                        <span class="badge badge-info right"><?php echo e($userCount); ?></span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.role.index')); ?>"
                    class="nav-link <?php echo e(Route::is('admin.role.index') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-user-tag"></i>
                    <p>Role
                        <span class="badge badge-success right"><?php echo e($RoleCount); ?></span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.permission.index')); ?>"
                    class="nav-link <?php echo e(Route::is('admin.permission.index') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-hat-cowboy"></i>
                    <p>Permission
                        <span class="badge badge-danger right"><?php echo e($PermissionCount); ?></span>
                    </p>
                </a>
            </li>
            
            
            
            
            <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-building green"></i>
              <p>
                References
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                <a href="<?php echo e(route('admin.civilstatus.index')); ?>"
                    class="nav-link <?php echo e(Route::is('admin.civilstatus.index') ? 'active' : ''); ?>">
                  <i class="nav-icon fas fa-building "></i>
                   <p style = "text-indent:15em;">
                    Civil Status
                   </p>
                </a>
                </li>
               <li class="nav-item">
                <a href="<?php echo e(route('admin.gender.index')); ?>"
                    class="nav-link <?php echo e(Route::is('admin.gender.index') ? 'active' : ''); ?>">
                  <i class="nav-icon fas fa-building "></i>
                   <p style = "text-indent:15em;">
                    Gender
                   </p>
                </a>
                </li>
                <li class="nav-item">
                <a href="<?php echo e(route('admin.position.index')); ?>"
                    class="nav-link <?php echo e(Route::is('admin.position.index') ? 'active' : ''); ?>">
                  <i class="nav-icon fas fa-building "></i>
                   <p style = "text-indent:15em;">
                    Position
                   </p>
                </a>
                </li>
                <li class="nav-item">
                <a href="<?php echo e(route('admin.department.index')); ?>"
                    class="nav-link <?php echo e(Route::is('admin.department.index') ? 'active' : ''); ?>">
                  <i class="nav-icon fas fa-building "></i>
                   <p style = "text-indent:15em;">
                    Department
                   </p>
                </a>
                </li>
                <li class="nav-item">
                <a href="<?php echo e(route('admin.employeestatus.index')); ?>"
                    class="nav-link <?php echo e(Route::is('admin.employeestatus.index') ? 'active' : ''); ?>">
                  <i class="nav-icon fas fa-building "></i>
                   <p style = "text-indent:15em;">
                    Employee Status
                   </p>
                </a>
                </li>
                <li class="nav-item">
                <a href="<?php echo e(route('attendance.leavetype.index')); ?>"
                    class="nav-link <?php echo e(Route::is('attendance.leavetype.index') ? 'active' : ''); ?>">
                  <i class="nav-icon fas fa-building "></i>
                   <p style = "text-indent:15em;">
                    Leave Type
                   </p>
                </a>
                </li>
            </ul>
          </li>
        <?php endif; ?>
        
        <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-building green"></i>
              <p>
                Attendance
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                    <a href="<?php echo e(route('attendance.raw.index')); ?>"
                        class="nav-link <?php echo e(Route::is('attendance.raw.index') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-building "></i>
                    <p style = "text-indent:15em;">
                        Raw Data
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('attendance.summary.index')); ?>"
                        class="nav-link <?php echo e(Route::is('attendance.summary.index') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-building "></i>
                    <p style = "text-indent:15em;">
                        Final Attendance
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('attendance.restday.index')); ?>"
                        class="nav-link <?php echo e(Route::is('attendance.restday.index') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-building "></i>
                    <p style = "text-indent:15em;">
                        Rest Day 
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('attendance.workschedule.index')); ?>"
                        class="nav-link <?php echo e(Route::is('attendance.workschedule.index') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-building "></i>
                    <p style = "text-indent:15em;">
                        Work Schedule
                    </p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="<?php echo e(route('attendance.workschedule.index')); ?>"
                        class="nav-link <?php echo e(Route::is('attendance.workschedule.index') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-building "></i>
                    <p style = "text-indent:15em;">
                        Leave Management
                    </p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('admin.profile.edit')); ?>"
                class="nav-link <?php echo e(Route::is('admin.profile.edit') ? 'active' : ''); ?>">
                <i class="nav-icon fas fa-id-card"></i>
                <p>Profile</p>
            </a>
        </li>

    </ul>
</nav>
<?php /**PATH D:\PAYROLL\PS\adminlte-laravel10\resources\views/components/sidebar.blade.php ENDPATH**/ ?>