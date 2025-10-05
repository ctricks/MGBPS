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
    <?php $__env->startSection('title','Overtime'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Overtime Table</h3>
            <div class="card-tools">
                <a href="<?php echo e(route('earnings.overtime.create')); ?>" class="btn btn-sm btn-info">New</a>
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
            <?php $__sessionArgs = ['failed'];
if (session()->has($__sessionArgs[0])) :
if (isset($value)) { $__sessionPrevious[] = $value; }
$value = session()->get($__sessionArgs[0]); ?>
                <div class="alert alert-danger" role="alert"> 
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
            <table class="table table-striped" id="overtimetypeTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Employee Code</th>
                        <th>Employee</th>
                        <th>Actual IN</th>
                        <th>Actual OUT</th>
                        <th>Schedule OUT</th>
                        <th>Filed OT Hours</th>
                        <th>Approved OT Hours</th>
                        <th>Status</th>
                        <th>Prepared By</th>
                        <th>Approved By</th>
                        <th width="250px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otDet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($otDet->id); ?></td>
                            <td><?php echo e($otDet->OTDate); ?></td>
                            <td><?php echo e($otDet->Description); ?> </td>
                            <td><?php echo e($otDet->EmployeeCode); ?> </td>
                            <td><?php echo e($otDet->EmployeeName); ?> </td>
                            <td><?php echo e($otDet->ActualIN); ?> </td>
                            <td><?php echo e($otDet->ActualOUT); ?> </td>
                            <td><?php echo e($otDet->SchedOUT); ?> </td>
                            <td><?php echo e(number_format($otDet->FiledOTHours,2)); ?> </td>
                            <td><?php echo e(number_format($otDet->OTHoursApproved,2)); ?> </td>
                            <td><?php echo e($otDet->status); ?></td>
                            <td><?php echo e($otDet->CreatedBy); ?> </td>
                            <td><?php echo e($otDet->ApprovedBy); ?> </td>
                            <td>
                                <div style="display:inline-block;margin-right:5px;">
                                <a href="<?php echo e(route('earnings.overtime.edit', encrypt($otDet->id))); ?>"
                                    class="btn btn-sm btn-primary">Edit</a>
                                </div>
                                <div style="display:inline-block;margin-right:5px;">
                                <form action="<?php echo e(route('earnings.overtime.destroy', encrypt($otDet->id))); ?>" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    <?php echo method_field('DELETE'); ?>
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                                </div>
                                <div style="display:inline-block;margin-right:5px;">
                                <form action="<?php echo e(route('earnings.overtime.approve', encrypt($otDet->id))); ?>" method="POST"
                                    onsubmit="return confirm('Are sure want to approve?')">
                                    <?php echo method_field('PATCH'); ?>
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                                </div>
                                <div style="display:inline-block;margin-right:5px;">
                                <form action="<?php echo e(route('earnings.overtime.decline', encrypt($otDet->id))); ?>" method="POST"
                                    onsubmit="return confirm('Are sure want to Decline?')">
                                    <?php echo method_field('PATCH'); ?>
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-warning">Decline</button>
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
                $('#overtimetypeTable').DataTable({
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
    const now = new Date();
    const today = new Date(now.getFullYear(), now.getMonth(), 1);;
    const FirstDate = today.toLocaleDateString('en-CA'); // 'en-CA' uses the yyyy-mm-dd format
    const LastDate = new Date(now.getFullYear(), now.getMonth() + 1, 0);
    const EndDate = LastDate.toLocaleDateString('en-CA'); 
    
    // Set the value of the input field
    document.getElementById('start-date').value = FirstDate;
    document.getElementById('end-date').value = EndDate;
    $("#start-date").change(function(){
    $("#end-date").prop("min", $(this).val());
    $("#end-date").val(""); //clear end date input when start date changes
    });
  </script><?php /**PATH D:\PAYROLL\PS\adminlte-laravel10\resources\views/earnings/overtime/index.blade.php ENDPATH**/ ?>