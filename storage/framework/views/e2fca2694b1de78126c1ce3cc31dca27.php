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
    <?php $__env->startSection('title','Edit Raw Attendance'); ?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Raw Attendance</h3>
                        <div class="card-tools">
                            <a href="<?php echo e(route('attendance.raw.index')); ?>" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="<?php echo e(route('attendance.raw.update',$data)); ?>" method="POST">
                        <?php echo method_field('PUT'); ?>
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
                        <div class="card-body">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="name">Date:</label>
                                    <input type="date" class="form-control" id="firstname" name="firstname"
                                        placeholder="Enter Date" disabled value = <?php echo e($data->date); ?>>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Employee Code:</label>
                                <input type="text" class="form-control" id="empcode" name="empcode"
                                    placeholder="Enter employee code" read-only required value="<?php echo e($data->employee_code); ?>">
                            </div>
                            <?php if (isset($component)) { $__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>empcode <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46)): ?>
<?php $attributes = $__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46; ?>
<?php unset($__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46)): ?>
<?php $component = $__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46; ?>
<?php unset($__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46); ?>
<?php endif; ?>
                            <div class="display:inline-block;col-lg-4">
                                <div class="form-group">
                                    <label for="last">Lastname:</label>
                                    <input type="string" class="form-control" id="lastname" name="lastname"
                                        placeholder="Enter Lastname" disabled value = <?php echo e($employee->lastname); ?>>
                                </div>
                                <div class="form-group">
                                    <label for="first">Firstname:</label>
                                    <input type="string" class="form-control" id="firstname" name="firstname"
                                        placeholder="Enter Firstname" disabled  value = <?php echo e($employee->firstname); ?>>
                                </div>
                                <div class="form-group">
                                    <label for="middle">Middlename:</label>
                                    <input type="string" class="form-control" id="middle" name="middlename"
                                        placeholder="Enter Firstname" disabled  value = <?php echo e($employee->middlename); ?>>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <table>
                                    <th><div class="form-group">
                                            <label for="name">TimeIN:</label>
                                            <?php if($data->in_1 == '' or $data->in_1 == null): ?>
                                            <input 
                                                type="time"  
                                                id="time_in" name="time_in" value="">
                                            <?php else: ?>
                                            <input 
                                                type="time" 
                                                id="time_in" name="time_in"
                                                value="<?php echo e((date('H:i', strtotime($data->in_1)))); ?>" 
                                                class="time-input-style"
                                            >
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">TimeOut:</label>
                                            <?php if($data->out_1 == '' or $data->out_1 == null): ?>
                                            <input 
                                                type="time"  name="time_out"
                                                id="time_out" value="">
                                            <?php else: ?>
                                            <input 
                                                type="time" 
                                                id="time_out" name="time_out"
                                                value="<?php echo e((date('H:i', strtotime($data->out_1)))); ?>" 
                                                class="time-input-style"
                                            >
                                            <?php endif; ?>
                                        </div>
                                    </th>
                                    <th>&nbsp;
                                    </th>
                                    <th><div class="form-group">
                                            <label for="name">TimeIN:</label>
                                            <?php if($data->in_2 == '' or $data->in_2 == null): ?>
                                            <input 
                                                type="time"  name="time_in2"
                                                id="time_in2" value="">
                                            <?php else: ?>
                                            <input 
                                                type="time" 
                                                id="time_in2" name="time_in2"
                                                value="<?php echo e((date('H:i', strtotime($data->in_2)))); ?>" 
                                                class="time-input-style"
                                            >
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">TimeOut:</label>
                                            <?php if($data->out_2 == '' or $data->out_2 == null): ?>
                                            <input 
                                                type="time"  name="time_out2"
                                                id="time_out2" value="">
                                            <?php else: ?>
                                            <input 
                                                type="time" 
                                                id="time_out2" name="time_out2"
                                                value="<?php echo e((date('H:i', strtotime($data->out_2)))); ?>" 
                                                class="time-input-style"
                                            >
                                            <?php endif; ?>
                                        </div>
                                    </th>
                                    <th>&nbsp;
                                    </th>
                                    <th>
                                        <th><div class="form-group">
                                            <label for="name">TimeIN:</label>
                                            <?php if($data->in_3 == '' or $data->in_3 == null): ?>
                                            <input 
                                                type="time"  name="time_in3"
                                                id="time_in3" value="">
                                            <?php else: ?>
                                            <input 
                                                type="time" 
                                                id="time_in3" name="time_in3"
                                                value="<?php echo e((date('H:i', strtotime($data->in_3)))); ?>" 
                                                class="time-input-style"
                                            >
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">TimeOut:</label>
                                            <?php if($data->out_3 == '' or $data->out_3 == null): ?>
                                            <input 
                                                type="time"  name = "time_out3"
                                                id="time_out3" value="">
                                            <?php else: ?>
                                            <input 
                                                type="time" 
                                                id="time_out3" name = "time_out3"
                                                value="<?php echo e((date('H:i', strtotime($data->out_3)))); ?>" 
                                                class="time-input-style"
                                            >
                                            <?php endif; ?>
                                        </div>
                                    </th>
                                    </th>
                                </table>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
<?php /**PATH D:\PAYROLL\PS\adminlte-laravel10\resources\views/attendance/raw/edit.blade.php ENDPATH**/ ?>