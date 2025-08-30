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
    <?php $__env->startSection('title','Raw Attendance'); ?>
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
                    <a href="<?php echo e(route('attendance.rawattendance.downloadtemplate')); ?>" class="btn btn-primary">Download Template</a>
                </div>
                
                
            </form>    
        </div>
        <div class="card-body">
            <table class="table table-striped" id="rawattendanceTable">
                <thead>
                    <tr>
                        <th>Employee Code</th>
                        <th>Date</th>
                        <th>Day</th>
                        <th>Name</th>
                        <th>In_1</th>
                        <th>Out_1</th>
                        <th>In_2</th>
                        <th>Out_2</th>
                        <th>In_3</th>
                        <th>Out_3</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empDTR): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($empDTR->employee_code); ?></td>
                            <td><?php echo e($empDTR->date); ?></td>
                            <td><?php echo e($empDTR->day); ?></td>
                            <td><?php echo e($empDTR->Employee); ?></td>
                            <td><?php echo e($empDTR->in_1); ?></td>
                            <td><?php echo e($empDTR->out_1); ?></td>
                            <td><?php echo e($empDTR->in_2); ?></td>
                            <td><?php echo e($empDTR->out_2); ?></td>
                            <td><?php echo e($empDTR->in_3); ?></td>
                            <td><?php echo e($empDTR->out_3); ?></td>
                            <td><a href="<?php echo e(route('admin.category.edit', encrypt($empDTR->id))); ?>"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td>
                                <form action="<?php echo e(route('admin.category.destroy', encrypt($empDTR->id))); ?>" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    <?php echo method_field('DELETE'); ?>
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
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