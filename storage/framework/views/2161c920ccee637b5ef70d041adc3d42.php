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
    <?php $__env->startSection('title','SSS TABLE Management'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">SSS Table</h3>
            <div class="card-tools">
                
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
            <form action="<?php echo e(route('attendance.ssstable.import')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="file" name="file" class="form-control" style="margin-right:30px;">
                <p></p>
                <div class="button-container">
                    <button class="btn btn-success"><i class="fa fa-file"></i> Import User Data</button>
                    <a href="<?php echo e(route('attendance.sssreference.downloadtemplate')); ?>" class="btn btn-primary">Download Template</a>
                </div>
                
                
            </form>    
        </div>
        <div class="card-body">
            <table class="table table-striped" id="HolidayTable">
                <thead>
                    <tr align = "center">
                        <th>Comphensation Range From</th>
                        <th>Comphensation Range To</th>
                        <th>Monthly Salary Credit(EC)</th>
                        <th>Monthly Salary Credit(MPF)</th>
                        <th>Total</th>
                        <th>Employer Reg SS</th>
                        <th>Employer MPF</th>
                        <th>Employer EC</th>
                        <th>Total</th>
                        <th>Employee Reg SS</th>
                        <th>Employee MPF</th>
                        <th>Employee EC</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th><?php echo e(number_format($sd->StartRangeComp,2)); ?></th>
                            <th><?php echo e(number_format($sd->EndRangeComp,2)); ?></th>
                            <th><?php echo e(number_format($sd->EC,2)); ?></th>
                            <th><?php echo e(number_format($sd->MPF,2)); ?></th>
                            <th><?php echo e(number_format($sd->MSCTOTAL,2)); ?></th>
                            <th><?php echo e(number_format($sd->EMPLOYERREGSSS,2)); ?></th>
                            <th><?php echo e(number_format($sd->EMPLOYERMPF,2)); ?></th>
                            <th><?php echo e(number_format($sd->EMPLOYEREC,2)); ?></th>
                            <th><?php echo e(number_format($sd->EMPLOYERTOTAL,2)); ?></th>
                            <th><?php echo e(number_format($sd->EMPLOYEEREGSS,2)); ?></th>
                            <th><?php echo e(number_format($sd->EMPLOYEEMPF,2)); ?></th>
                            <th><?php echo e(number_format($sd->EMPLOYEETOTAL,2)); ?></th>
                            <th><?php echo e(number_format($sd->TOTAL,2)); ?></th>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php $__env->startSection('js'); ?>
        <script>
            $(function() {
                $('#HolidayTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                    pageLength: 25,
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
<?php /**PATH D:\PAYROLL\PS\adminlte-laravel10\resources\views/admin/ssstable/index.blade.php ENDPATH**/ ?>