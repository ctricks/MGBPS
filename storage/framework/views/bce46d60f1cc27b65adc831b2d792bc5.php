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
    <?php $__env->startSection('title', 'Raw Attendance'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Raw Attendance Table</h3>
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

            <form action="<?php echo e(route('attendance.rawattendance.import')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="file" name="file" class="form-control" style="margin-right:30px;">
                <p></p>
                <div class="button-container">
                    <button class="btn btn-success"><i class="fa fa-file"></i> Import User Data</button>
                    <a href="<?php echo e(route('attendance.rawattendance.downloadtemplate')); ?>" class="btn btn-primary">Download
                        Template</a>
                </div>
            </form>
        </div>
        <div class="card-body">
            Filter:
            <form action="<?php echo e(route('attendance.rawattendance.list')); ?>" method="POST">
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
                                placeholder="" disabled value=<?php echo e($ProcessStatus); ?>>
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
                        <th>ID</th>
                        <th>Date</th>
                        <th>Day</th>
                        <th>EmployeeCode</th>
                        <th>In_1</th>
                        <th>Out_1</th>
                        <th>In_2</th>
                        <th>Out_2</th>
                        <th>In_3</th>
                        <th>Out_3</th>
                        <th>Fin In</th>
                        <th>Fin Out</th>
                        <th>W Hrs</th>
                        <th>ND</th>
                        
                        <th>OT</th>
                        
                        <th>Absent</th>
                        <th>Late</th>
                        <th>Utime</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empDTR): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($empDTR->id); ?></td>
                            <td><?php echo e($empDTR->date); ?></td>
                            <td><?php echo e($empDTR->Day); ?></td>
                            <td><?php echo e($empDTR->employee_code); ?></td>
                            <td><?php echo e($empDTR->TimeIN); ?></td>
                            <td><?php echo e($empDTR->TimeOUT); ?></td>
                            <td><?php echo e($empDTR->TimeIN_2); ?></td>
                            <td><?php echo e($empDTR->TimeOUT_2); ?></td>
                            <td><?php echo e($empDTR->TimeIN_3); ?></td>
                            <td><?php echo e($empDTR->TimeOUT_3); ?></td>
                            <td><?php echo e($empDTR->Final_IN); ?></td>
                            <td><?php echo e($empDTR->Final_OUT); ?></td>
                            <td><?php echo e($empDTR->WorkingHours); ?></td>
                            <td><?php echo e($empDTR->NDHours); ?></td>
                            <td><?php echo e($empDTR->OTHours); ?></td>
                            <td><?php echo e($empDTR->Absent); ?></td>
                            <td><?php echo e($empDTR->Late); ?></td>
                            <td><?php echo e($empDTR->Undertime); ?></td>
                            
                            
                            <td><div style = "flex; justify-content: center; gap: 1px;">
                                <a href="<?php echo e(route('attendance.raw.edit', encrypt($empDTR->id))); ?>"
                                    class="btn btn-sm btn-primary">Edit</a>
                                </div>
                            </td>
                            <td>
                                <div>
                                <form action="<?php echo e(route('attendance.raw.index', encrypt($empDTR->id))); ?>" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    <?php echo method_field('DELETE'); ?>
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                            </td>
                            
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        pageLength: 15,
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    // Cutoff Change
                    $('#monthfilter').change(function() {
                        // Cutoff id
                        var id = $(this).val();
                        //$('#employeecode').find('option').remove().end();
                        // AJAX request 
                        $.ajax({
                            url: '/get-cutoff/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function(response) {
                                var len = 0;
                                if (response.length > 0) {
                                    $('#cutoff').find('option').remove().end();
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
                        //$('#employeecode').find('option').remove().end();
                        // AJAX request 
                        $.ajax({
                            url: '/get-dtr-employee/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function(response) {
                                var len = 0;
                                if (response[0].employee_code != null) {
                                    len = response[0].employee_code.length;
                                }
                                if (len > 0) {
                                    const selectElement = document.getElementById('employeecode');
                                    $('#employeecode').find('option').remove().end();
                                    // Loop through the data and create <option> elements
                                    response.forEach(response => {
                                        const option = document.createElement('option');
                                        option.value = response
                                        .employee_code; // Set the value attribute
                                        option.textContent = response
                                        .employee_code; // Set the display text
                                        selectElement.appendChild(
                                        option); // Append the option to the select
                                    });
                                }

                            }
                        });
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
<?php /**PATH D:\PAYROLL\PS\adminlte-laravel10\resources\views/attendance/raw/index.blade.php ENDPATH**/ ?>