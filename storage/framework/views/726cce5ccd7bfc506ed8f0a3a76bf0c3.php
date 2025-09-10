<?php if (isset($component)) { $__componentOriginal2812d824e80b3a65bceda8e6a9bfa7a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2812d824e80b3a65bceda8e6a9bfa7a0 = $attributes; } ?>
<?php $component = App\View\Components\Admin::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Admin::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title','Attendance Summary'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Final Attendance Table</h3>
            <div class="card-tools">
                <a href="<?php echo e(route('attendance.raw.create')); ?>" class="btn btn-sm btn-info">New</a>
            </div>
        </div>
    <div class="card-header">
  
            <?php $__sessionArgs = ['success'];
if (session()->has($__sessionArgs[0])) :
if (isset($value)) { $__sessionPrevious[] = $value; }
$value = session()->get($__sessionArgs[0]); ?>
                <div class="alert alert-success" role="alert"> 
                    <?php echo e($value); ?>

                </div>
            <?php unset($value);
if (isset($__sessionPrevious) && !empty($__sessionPrevious)) { $value = array_pop($__sessionPrevious); }
if (isset($__sessionPrevious) && empty($__sessionPrevious)) { unset($__sessionPrevious); }
endif;
unset($__sessionArgs); ?>
  
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-body">
            Filter:
            <form action="<?php echo e(route('attendance.summaryattendance.list')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="selectmonth">Month:</label>
                            <select name="monthfilter" id="monthfilter" class="form-control" required>
                                <option value="" selected disabled>select month</option>
                                <?php for($month = 1; $month <= 12; $month++): ?>
                                    <?php echo e($monthName = date('F', mktime(0, 0, 0, $month, 1))); ?>

                                    <option value="<?php echo e($month); ?>">
                                        <?php echo e($monthName); ?> </option>
                                <?php endfor; ?>
                            </select>
                            <?php if (isset($component)) { $__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>civilstatus <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46)): ?>
<?php $attributes = $__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46; ?>
<?php unset($__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46)): ?>
<?php $component = $__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46; ?>
<?php unset($__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46); ?>
<?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="civilstatus">Cut-off:</label>
                            <select name="cutoff" id="cutoff" class="form-control" required>
                                <option value="" selected disabled>select cutoff</option>
                                
                            </select>
                            <?php if (isset($component)) { $__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>civilstatus <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46)): ?>
<?php $attributes = $__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46; ?>
<?php unset($__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46)): ?>
<?php $component = $__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46; ?>
<?php unset($__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46); ?>
<?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="employee">Employee:*</label>
                            <select name="employeecode" id="employeecode" class="form-control" required>
                                <option value="" selected disabled>select employee</option>
                            </select>
                            <?php if (isset($component)) { $__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>employeecode <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46)): ?>
<?php $attributes = $__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46; ?>
<?php unset($__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46)): ?>
<?php $component = $__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46; ?>
<?php unset($__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46); ?>
<?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="empname">Status:</label>
                            <input type="text" class="form-control" id="payrollprocess" name="payrollprocess"
                                placeholder="Attendance Summary Status" disabled >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="button-container">
                                <button class="btn btn-success"><i class="fa fa-file"></i> Search</button>
                                <a href="<?php echo e(route('attendance.raw.index')); ?>" class="btn btn-md btn-info">Show All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="rawattendanceTable">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Cutoff</th>
                        <th>Employee Code</th>
                        <th>Employee Name</th>
                        <th>Total Working Hours</th>
                        <th>Total Night Diff Hours</th>
                        <th>Total Overtime Hours</th>
                        <th>Total Leaves</th>
                        <th>Total Absent</th>
                        <th>Total Late</th>
                        <th>Total Undertime</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($data != null): ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empDTR): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($empDTR->Month); ?></td>
                            <td><?php echo e($empDTR->StartDate); ?> to <?php echo e($empDTR->EndDate); ?></td>
                            <td><?php echo e($empDTR->employee_code); ?></td>
                            <td><?php echo e($empDTR->EmployeeName); ?></td>
                            <td><?php echo e($empDTR->WorkingHours); ?></td>
                            <td><?php echo e($empDTR->NDHours); ?></td>
                            <td><?php echo e($empDTR->OTHours); ?></td>
                            <td><?php echo e($empDTR->Leaves); ?></td>
                            <td><?php echo e($empDTR->Absent); ?></td>
                            <td><?php echo e($empDTR->Late); ?></td>
                            <td><?php echo e($empDTR->Undertime); ?></td>
                            <td><a href="<?php echo e(route('admin.category.edit', encrypt(-1))); ?>"
                                    class="btn btn-sm btn-primary">View Details</a></td>
                            <td>
                                
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php $__env->startSection('js'); ?>
        <script>
            $(function() {
                $('#rawattendanceTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2812d824e80b3a65bceda8e6a9bfa7a0)): ?>
<?php $attributes = $__attributesOriginal2812d824e80b3a65bceda8e6a9bfa7a0; ?>
<?php unset($__attributesOriginal2812d824e80b3a65bceda8e6a9bfa7a0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2812d824e80b3a65bceda8e6a9bfa7a0)): ?>
<?php $component = $__componentOriginal2812d824e80b3a65bceda8e6a9bfa7a0; ?>
<?php unset($__componentOriginal2812d824e80b3a65bceda8e6a9bfa7a0); ?>
<?php endif; ?>
<script>
                $(document).ready(function() {
                    // Cutoff Change
                    $('#monthfilter').change(function() {
                        // Cutoff id
                        var id = $(this).val();
                        $('#cutoff').find('option').remove().end();
                        // AJAX request 
                        $.ajax({
                            url: '/get-cutoff/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function(response) {
                                var len = 0;
                                if (response.length > 0) {
                                    response.forEach(response => {
                                        // Create a new option
                                        const newOption = new Option(response.StartDate +
                                            ' to ' + response.EndDate, response.id);
                                        // Append the new option to the dropdown
                                        $('#cutoff').append(newOption);
                                    });
                                }
                            }
                        });
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    // Cutoff Change
                    $('#cutoff').change(function() {
                        // Cutoff id
                        var id = $(this).val();
                        $('#employeecode').find('option').remove().end();
                       
                        if(id > 0)
                        {
                        //$('#employeecode').find('option').remove().end();
                        // AJAX request 
                        $.ajax({
                            url: '/get-dtr-employee/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function(response) {
                                var len = 0;
                                if (response.length > 0) {
                                    response.forEach(response => {
                                        // Create a new option
                                        const newOption = new Option(response.employee_code, response.id);
                                        // Append the new option to the dropdown
                                        $('#employeecode').append(newOption);
                                    });
                                }

                            }
                        });
                        }
                    });
                });
            </script><?php /**PATH D:\PAYROLL\PS\adminlte-laravel10\resources\views/attendance/summary/index.blade.php ENDPATH**/ ?>