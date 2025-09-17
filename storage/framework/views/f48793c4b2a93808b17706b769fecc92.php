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
    <?php $__env->startSection('title','View Attendance Summary'); ?>
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Final Attendance Table</h3>
            <div class="card-tools">
                <a href="<?php echo e(route('attendance.summary.index')); ?>" class="btn btn-sm btn-info">Back</a>
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
            <table class="table table-striped" id="rawattendanceTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Day</th>
                        <th>EmpCode</th>
                        <th>In_1</th>
                        <th>Out_1</th>
                        <th>In_2</th>
                        <th>Out_2</th>
                        <th>In_3</th>
                        <th>Out_3</th>
                        <th>DType</th>
                        <th>F.In</th>
                        <th>F.Out</th>
                        <th>Work</th>
                        <th>ND</th>
                        
                        <th>OT</th>
                        <th>Leave</th>
                        <th>Abs</th>
                        <th>Late</th>
                        <th>Utime</th>
                        
                        
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
                            <td><?php echo e($empDTR->RestDay); ?></td>
                            <td><?php echo e($empDTR->Final_IN); ?></td>
                            <td><?php echo e($empDTR->Final_OUT); ?></td>
                            <?php if($empDTR->WorkingHours < 8 && $empDTR->RestDay <> 'RD'): ?>
                                <td style="color:red;"><?php echo e(number_format($empDTR->WorkingHours,2)); ?></td>
                            <?php else: ?>
                                <td><?php echo e(number_format($empDTR->WorkingHours,2)); ?></td>
                            <?php endif; ?>                  
                            <td><?php echo e(number_format($empDTR->NDHours,2)); ?></td>
                            <td><?php echo e(number_format($empDTR->OTHours,2)); ?></td>
                            <td><?php echo e(number_format($empDTR->Leave,2)); ?></td>
                            <?php if($empDTR->Absent == 8): ?>
                                <td style="color:red;"><?php echo e($empDTR->Absent); ?></td>
                            <?php else: ?>
                                <td><?php echo e($empDTR->Absent); ?></td>
                            <?php endif; ?>
                            <?php if($empDTR->Late > 0): ?>
                                <td style="color:red;"><?php echo e(number_format($empDTR->Late,2)); ?></td>
                            <?php else: ?>
                                <td><?php echo e(number_format($empDTR->Late,2)); ?></td>
                            <?php endif; ?>
                            <?php if($empDTR->Undertime > 0): ?>
                                <td style="color:red;"><?php echo e(number_format($empDTR->Undertime,2)); ?></td>
                            <?php else: ?>
                                <td><?php echo e(number_format($empDTR->Undertime,2)); ?></td>
                            <?php endif; ?>
                            
                            
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
            </script><?php /**PATH D:\PAYROLL\PS\adminlte-laravel10\resources\views/attendance/summary/view.blade.php ENDPATH**/ ?>