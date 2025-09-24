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
    <?php $__env->startSection('title','DTR Correction'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DTR Correction Table</h3>
            <div class="card-tools">
                <a href="<?php echo e(route('attendance.dtrcorrection.create')); ?>" class="btn btn-sm btn-info">New</a>
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
         <div class="col-lg-3">
            <form action="<?php echo e(route('attendance.dtrcorrection.list')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="selectmonth">Month:</label>
                            <select name="monthfilter" id="monthfilter" class="form-control" required>
                                <?php if($monthfilter == 0): ?>
                                    <option value="" selected disabled>select month</option>
                                    <?php for($month = 1; $month <= 12; $month++): ?>
                                        <?php echo e($monthName = date('F', mktime(0, 0, 0, $month, 1))); ?>

                                        <option value="<?php echo e($month); ?>">
                                            <?php echo e($monthName); ?> </option>
                                    <?php endfor; ?>
                                <?php else: ?>
                                    <?php for($month = 1; $month <= 12; $month++): ?>
                                        <?php echo e($monthName = date('F', mktime(0, 0, 0, $month, 1))); ?>

                                        <?php if($month == $monthfilter): ?>
                                            <option value="<?php echo e($month); ?>" selected>
                                                <?php echo e($monthName); ?> </option>
                                        <?php else: ?>
                                            <option value="<?php echo e($month); ?>">
                                                <?php echo e($monthName); ?> </option>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                <?php endif; ?>
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
<?php $component->withAttributes([]); ?>monthfilter <?php echo $__env->renderComponent(); ?>
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
                        <button class="btn btn-success" name = "search" id="search">Search</button>
                        
                    </div>
                </form>
        <div class="card-body">
            <table class="table table-striped" id="dtrCorTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee Code</th>
                        <th>Employee Name</th>
                        <th>Date</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Day Type</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Approved By</th>
                        <th width = "250px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ltDet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><a href="<?php echo e(route('attendance.dtrcorrection.view', encrypt($ltDet->id))); ?>"><?php echo e($ltDet->id); ?></a></td>
                            <td><?php echo e($ltDet->employeenumber); ?></td>
                            <td><?php echo e($ltDet->Employee); ?></td>
                            <td><?php echo e($ltDet->date); ?></td>
                            <td><?php echo e($ltDet->IN); ?></td>
                            <td><?php echo e($ltDet->OUT); ?></td>
                            <td><?php echo e($ltDet->DType); ?></td>
                            <?php if($ltDet->Status == "Declined"): ?>
                                <td style="color:red;"><?php echo e($ltDet->Status); ?></td>
                            <?php else: ?>
                                <td><?php echo e($ltDet->Status); ?></td>
                            <?php endif; ?>
                            <td><?php echo e($ltDet->CreatedBy); ?></td>
                            <td><?php echo e($ltDet->ApprovedBy); ?></td>
                            
                            
                            <td><div style="display:inline-block;margin-right:5px;"><a href="<?php echo e(route('attendance.dtrcorrection.edit', encrypt($ltDet->id))); ?>"
                                    class="btn btn-sm btn-primary">Edit</a></div>
                                <div style="display:inline-block;margin-right:5px;">
                                <form action="<?php echo e(route('attendance.dtrcorrection.destroy', encrypt($ltDet->id))); ?>" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    <?php echo method_field('DELETE'); ?>
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                                </div>
                                <div style="display:inline-block;margin-right:5px;">
                                <form action="<?php echo e(route('attendance.dtrcorrection.approve', encrypt($ltDet->id))); ?>" method="POST"
                                    onsubmit="return confirm('Are sure want to approve?')">
                                    <?php echo method_field('PATCH'); ?>
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                                </div>
                                <div style="display:inline-block;margin-right:5px;">
                                <form action="<?php echo e(route('attendance.dtrcorrection.decline', encrypt($ltDet->id))); ?>" method="POST"
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
                $('#dtrCorTable').DataTable({
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
        // Get references to the dropdown and button
        const dropdown = document.getElementById('monthfilter');
        const button = document.getElementById('search');

        // Attach the change event listener to the dropdown
        dropdown.addEventListener('change', function () {
            // Trigger the button click programmatically
            button.click();
        });
    </script><?php /**PATH D:\PAYROLL\PS\adminlte-laravel10\resources\views/attendance/dtrcorrection/index.blade.php ENDPATH**/ ?>