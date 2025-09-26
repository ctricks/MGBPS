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
    <?php $__env->startSection('title', 'CUT OFF TABLE'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Cut-off for the Year Table</h3>
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
            <div class="row">
                <div class="col-lg-2 ">
                    <form action="<?php echo e(route('attendance.cutoff.create')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
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
                        <button class="btn btn-success"><i class="fa fa-file"></i>Create</button>
                        <a href="<?php echo e(route('attendance.cutoffconfig.index')); ?>" class="btn btn-md btn-info">Show All</a>
                    </form>
                </div>
            </div>
            <div class="row"></div>
            <div class="card-body">
                <table class="table table-striped" id="cutoffTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Month</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Open By</th>
                            <th>Open Date</th>
                            <th>Closed By</th>
                            <th>Closed Date</th>
                            <th>Status</th>
                            <th width="350px;">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuDet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($cuDet->id); ?></td>
                                <td><?php echo e($cuDet->Month); ?></td>
                                <td><?php echo e(Carbon\Carbon::parse($cuDet->StartDate)->format('m-d-Y')); ?></td>
                                <td><?php echo e(Carbon\Carbon::parse($cuDet->EndDate)->format('m-d-Y')); ?></td>
                                <td><?php echo e($cuDet->OpenName); ?></td>
                                <td><?php echo e($cuDet->OpenDate); ?> </td>
                                <td><?php echo e($cuDet->ClosedName); ?></td>
                                <td><?php echo e($cuDet->ClosedDate); ?></td>
                                <td><?php echo e($cuDet->Status); ?></td>
                                <td>
                                    <div style="display: flex; gap: 10px;">
                                        <form action="<?php echo e(route('attendance.cutoffconfig.open', encrypt($cuDet->id))); ?>"
                                            method="POST" onsubmit="return confirm('Are sure want to Open this Cut-off?')">
                                            <?php echo method_field('PATCH'); ?>
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm btn-success">OPEN</button>
                                        </form>
                                        <form
                                            action="<?php echo e(route('attendance.cutoffconfig.close', encrypt($cuDet->id))); ?>"
                                            method="POST" onsubmit="return confirm('Are sure want to Close this Cut-off?')">
                                            <?php echo method_field('PATCH'); ?>
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm btn-warning">CLOSE</button>
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
                        $('#cutoffTable').DataTable({
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
<?php /**PATH D:\PAYROLL\PS\adminlte-laravel10\resources\views/cutoff/index.blade.php ENDPATH**/ ?>