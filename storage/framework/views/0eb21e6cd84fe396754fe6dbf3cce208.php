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
    <?php $__env->startSection('title','View Payroll Summary'); ?>
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Payroll Table Period: <?php echo e($cutoffDataSelected); ?></h3>
            <div class="card-tools">
                <a href="<?php echo e(route('payroll.payroll.index')); ?>" class="btn btn-sm btn-info">Back</a>
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
          <form class="needs-validation" novalidate action="<?php echo e(route('admin.category.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="employeenumber" class="form-label">Employee Number:*</label>
                                <input type="text" class="form-control" name="employeenumber" required numeric
                                    value="<?php echo e($data[0]->Employee_Code); ?>" readonly>
                                    <?php if (isset($component)) { $__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>employeenumber <?php echo $__env->renderComponent(); ?>
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
                            <div class="form-group col-lg-4">
                                <label for="employeenumber" class="form-label">Employee Name:*</label>
                                <input type="text" class="form-control" name="employeename" required numeric
                                    value="<?php echo e($data[0]->EmployeeName); ?>" readonly>
                                    <?php if (isset($component)) { $__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>employeenumber <?php echo $__env->renderComponent(); ?>
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

                            <div class="form-group col-lg-4"></div>
                            <div class="form-group col-lg-2">EARNINGS</div>
                            <div class="form-group col-lg-2">HOUR/s</div>
                            <div class="form-group col-lg-2">AMOUNT</div>
                            <div class="form-group col-lg-2">DEDUCTIONS</div>
                            <div class="form-group col-lg-2">HOUR/s</div>
                            <div class="form-group col-lg-2">AMOUNT</div>
                            <div class="form-group col-lg-2">BASIC PAY:</div>
                            <div class="form-group col-lg-2"><?php echo e($data[0]->DailyRate); ?> / day</div>
                            <div class="form-group col-lg-2"><?php echo e($data[0]->BasicPay); ?></div>
                            <div class="form-group col-lg-2">ABSENCES:</div>
                            <div class="form-group col-lg-2"><?php echo e($data[0]->Absent); ?> hrs</div>
                            <div class="form-group col-lg-2"><?php echo e($data[0]->AbsentPay); ?></div>
                            
                            <div class="form-group col-lg-2">Regular OT:</div>
                            <div class="form-group col-lg-2"><?php echo e($data[0]->DailyRate); ?> / day</div>
                            <div class="form-group col-lg-2"><?php echo e($data[0]->BasicPay); ?></div>
                            <div class="form-group col-lg-2">ABSENCES:</div>
                            <div class="form-group col-lg-2"><?php echo e($data[0]->Absent); ?> hrs</div>
                            <div class="form-group col-lg-2"><?php echo e($data[0]->AbsentPay); ?></div>
                        <div class = "form-group col-lg-12">
                                <button type="submit" class="btn btn-primary float-left">Save</button>
                        </div>
            </form>  
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
            </script><?php /**PATH D:\PAYROLL\PS\adminlte-laravel10\resources\views/payroll/summary/view.blade.php ENDPATH**/ ?>