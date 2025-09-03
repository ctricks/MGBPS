<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        @role('admin')
            <li class="nav-item">
                <a href="{{ route('admin.employee.index') }}"
                    class="nav-link {{ Route::is('admin.employee.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Employees
                        <span class="badge badge-info right">{{ $EmployeeCount }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.user.index') }}"
                    class="nav-link {{ Route::is('admin.user.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Users
                        <span class="badge badge-info right">{{ $userCount }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.role.index') }}"
                    class="nav-link {{ Route::is('admin.role.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-tag"></i>
                    <p>Role
                        <span class="badge badge-success right">{{ $RoleCount }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.permission.index') }}"
                    class="nav-link {{ Route::is('admin.permission.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-hat-cowboy"></i>
                    <p>Permission
                        <span class="badge badge-danger right">{{ $PermissionCount }}</span>
                    </p>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a href="{{ route('admin.category.index') }}"
                    class="nav-link {{ Route::is('admin.category.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list-alt"></i>
                    <p>Category
                        <span class="badge badge-warning right">{{ $CategoryCount }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.subcategory.index') }}"
                    class="nav-link {{ Route::is('admin.subcategory.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>Sub Category
                        <span class="badge badge-secondary right">{{ $SubCategoryCount }}</span>
                    </p>
                </a>
            </li> --}}
            {{-- <li class="nav-item">
                <a href="{{ route('admin.collection.index') }}"
                    class="nav-link {{ Route::is('admin.collection.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file-pdf"></i>
                    <p>Collection
                        <span class="badge badge-primary right">{{ $CollectionCount }}</span>
                    </p>
                </a>
            </li> --}}
            {{-- <li class="nav-item">
                <a href="{{ route('admin.product.index') }}"
                    class="nav-link {{ Route::is('admin.product.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Products
                        <span class="badge badge-warning right">{{ $ProductCount }}</span>
                    </p>
                </a>
            </li> --}}
            {{-- For Dropdown menu --}}
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
                <a href="{{ route('admin.civilstatus.index') }}"
                    class="nav-link {{ Route::is('admin.civilstatus.index') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-building "></i>
                   <p style = "text-indent:15em;">
                    Civil Status
                   </p>
                </a>
                </li>
               <li class="nav-item">
                <a href="{{ route('admin.gender.index') }}"
                    class="nav-link {{ Route::is('admin.gender.index') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-building "></i>
                   <p style = "text-indent:15em;">
                    Gender
                   </p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{ route('admin.position.index') }}"
                    class="nav-link {{ Route::is('admin.position.index') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-building "></i>
                   <p style = "text-indent:15em;">
                    Position
                   </p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{ route('admin.department.index') }}"
                    class="nav-link {{ Route::is('admin.department.index') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-building "></i>
                   <p style = "text-indent:15em;">
                    Department
                   </p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{ route('admin.employeestatus.index') }}"
                    class="nav-link {{ Route::is('admin.employeestatus.index') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-building "></i>
                   <p style = "text-indent:15em;">
                    Employee Status
                   </p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{ route('attendance.leavetype.index') }}"
                    class="nav-link {{ Route::is('attendance.leavetype.index') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-building "></i>
                   <p style = "text-indent:15em;">
                    Leave Type
                   </p>
                </a>
                </li>
            </ul>
          </li>
        @endrole
        {{-- For Dropdown menu --}}
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
                    <a href="{{ route('attendance.raw.index') }}"
                        class="nav-link {{ Route::is('attendance.raw.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-building "></i>
                    <p style = "text-indent:15em;">
                        Raw Data
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attendance.summary.index') }}"
                        class="nav-link {{ Route::is('attendance.summary.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-building "></i>
                    <p style = "text-indent:15em;">
                        Final Attendance
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attendance.restday.index') }}"
                        class="nav-link {{ Route::is('attendance.restday.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-building "></i>
                    <p style = "text-indent:15em;">
                        Rest Day 
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attendance.workschedule.index') }}"
                        class="nav-link {{ Route::is('attendance.workschedule.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-building "></i>
                    <p style = "text-indent:15em;">
                        Work Schedule
                    </p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="{{ route('attendance.leave.index') }}"
                        class="nav-link {{ Route::is('attendance.leave.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-building "></i>
                    <p style = "text-indent:15em;">
                        Leave Management
                    </p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.profile.edit') }}"
                class="nav-link {{ Route::is('admin.profile.edit') ? 'active' : '' }}">
                <i class="nav-icon fas fa-id-card"></i>
                <p>Profile</p>
            </a>
        </li>

    </ul>
</nav>
